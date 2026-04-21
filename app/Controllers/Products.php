<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Products extends BaseController
{
    protected CategoryModel $categoryModel;
    protected ProductModel $productModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
        $this->productModel = new ProductModel();
    }

    protected function decodeGallery(?string $gallery): array
    {
        if (!$gallery) {
            return [];
        }

        $decoded = json_decode($gallery, true);
        return is_array($decoded) ? array_values(array_filter($decoded)) : [];
    }

    protected function enrichProduct(object $product): object
    {
        $product->image_url = !empty($product->image) ? base_url($product->image) : null;
        $product->gallery_images = array_map(
            static fn ($path) => base_url($path),
            $this->decodeGallery($product->gallery ?? null)
        );

        return $product;
    }

    protected function enrichProducts(array $products): array
    {
        return array_map(fn ($product) => $this->enrichProduct($product), $products);
    }

    protected function normalizeSearchTerm(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return '';
        }

        $lower = function_exists('mb_strtolower') ? mb_strtolower($value, 'UTF-8') : strtolower($value);
        $ascii = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $lower);
        if ($ascii !== false) {
            $lower = $ascii;
        }

        return preg_replace('/[^a-z0-9\s]/i', ' ', $lower) ?? '';
    }

    protected function containsNormalized(string $needle, ?string ...$fields): bool
    {
        if ($needle === '') {
            return false;
        }

        foreach ($fields as $field) {
            $haystack = $this->normalizeSearchTerm((string) ($field ?? ''));
            if ($haystack !== '' && str_contains($haystack, $needle)) {
                return true;
            }
        }

        return false;
    }

    protected function repairBrokenText(?string $value): string
    {
        $text = (string) ($value ?? '');
        if ($text === '' || !str_contains($text, '?')) {
            return $text;
        }

        $replacements = [
            'Lumin?rias' => 'Luminárias',
            'lumin?rias' => 'luminárias',
            'Miniaturas 3DPe?as' => 'Miniaturas 3D Peças',
            'Placas 3DPlacas' => 'Placas 3D Placas',
            'Trof?us' => 'Troféus',
            'trof?us' => 'troféus',
            'Pe?as' => 'Peças',
            'pe?as' => 'peças',
            'ilumina??o' => 'iluminação',
            'decora??o' => 'decoração',
            'produ??o' => 'produção',
        ];

        return strtr($text, $replacements);
    }

    public function index(): string
    {
        $products = $this->enrichProducts($this->productModel->getActive());
        $categories = $this->categoryModel->getAllActive();

        $data = [
            'title' => 'Loja - Todos os Produtos',
            'products' => $products,
            'categories' => $categories,
        ];
        return view('products/index', $data);
    }

    public function category($category = null): string
    {
        $categoryModel = $this->categoryModel->getBySlug($category);
        if (!$categoryModel) {
            throw PageNotFoundException::forPageNotFound('Categoria não encontrada');
        }

        $products = $this->enrichProducts($this->productModel->where('status', 'active')
            ->where('category_id', $categoryModel->id)
            ->orderBy('created_at', 'DESC')
            ->findAll());

        $data = [
            'title' => $categoryModel->name . ' - Trens de',
            'category' => $categoryModel,
            'products' => $products,
        ];
        return view('products/category', $data);
    }

    public function detail($id = null): string
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw PageNotFoundException::forPageNotFound('Produto não encontrado');
        }

        $product = $this->enrichProduct($product);

        $category = $this->categoryModel->find($product->category_id);
        $relatedProducts = $this->enrichProducts($this->productModel->where('status', 'active')
            ->where('category_id', $product->category_id)
            ->where('id !=', $product->id)
            ->orderBy('created_at', 'DESC')
            ->findAll(4));

        $data = [
            'title' => $product->name . ' - Trens de',
            'product' => $product,
            'category' => $category,
            'related_products' => $relatedProducts,
        ];
        return view('products/detail', $data);
    }

    public function search(): string
    {
        $term = trim((string) $this->request->getGet('q'));
        $normalizedTerm = $this->normalizeSearchTerm($term);

        $products = [];
        $categories = [];

        if ($term !== '') {
            $allProducts = $this->productModel->where('status', 'active')
                ->orderBy('created_at', 'DESC')
                ->findAll();
            $allCategories = $this->categoryModel->orderBy('name', 'ASC')->findAll();

            $products = array_values(array_filter($allProducts, function ($product) use ($normalizedTerm) {
                return $this->containsNormalized(
                    $normalizedTerm,
                    $product->name ?? '',
                    $product->description ?? ''
                );
            }));

            $categories = array_values(array_filter($allCategories, function ($category) use ($normalizedTerm) {
                return $this->containsNormalized(
                    $normalizedTerm,
                    $category->name ?? '',
                    $category->description ?? ''
                );
            }));

            $products = $this->enrichProducts($products);
        }

        foreach ($categories as $category) {
            $category->name = $this->repairBrokenText($category->name ?? '');
            $category->description = $this->repairBrokenText($category->description ?? '');
            $category->image_url = !empty($category->image) ? base_url($category->image) : null;
        }

        return view('search', [
            'title' => $term !== '' ? 'Busca: ' . $term . ' - Trens de' : 'Busca - Trens de',
            'term' => $term,
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function suggestions()
    {
        $term = trim((string) $this->request->getGet('q'));
        $normalizedTerm = $this->normalizeSearchTerm($term);

        if ($normalizedTerm === '' || strlen($normalizedTerm) < 2) {
            return $this->response->setJSON([
                'term' => $term,
                'products' => [],
                'categories' => [],
            ]);
        }

        $allProducts = $this->productModel->where('status', 'active')
            ->orderBy('created_at', 'DESC')
            ->findAll();
        $allCategories = $this->categoryModel->orderBy('name', 'ASC')->findAll();

        $products = array_values(array_filter($allProducts, function ($product) use ($normalizedTerm) {
            return $this->containsNormalized(
                $normalizedTerm,
                $product->name ?? '',
                $product->description ?? ''
            );
        }));
        $products = array_slice($this->enrichProducts($products), 0, 5);

        $categories = array_values(array_filter($allCategories, function ($category) use ($normalizedTerm) {
            return $this->containsNormalized(
                $normalizedTerm,
                $category->name ?? '',
                $category->description ?? ''
            );
        }));
        $categories = array_slice($categories, 0, 5);

        $productItems = array_map(function ($product) {
            return [
                'type' => 'product',
                'name' => $this->repairBrokenText($product->name ?? ''),
                'url' => base_url('produto/' . $product->id),
                'subtitle' => 'R$ ' . number_format((float) $product->price, 2, ',', '.'),
                'image_url' => $product->image_url ?? null,
            ];
        }, $products);

        $categoryItems = array_map(function ($category) {
            $imageUrl = !empty($category->image) ? base_url($category->image) : null;

            return [
                'type' => 'category',
                'name' => $this->repairBrokenText($category->name ?? ''),
                'url' => base_url('categoria/' . $category->slug),
                'subtitle' => $this->repairBrokenText($category->description ?: 'Categoria'),
                'image_url' => $imageUrl,
            ];
        }, $categories);

        return $this->response->setJSON([
            'term' => $term,
            'products' => $productItems,
            'categories' => $categoryItems,
        ]);
    }
}
