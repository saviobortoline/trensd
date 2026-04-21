<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use Config\Database;

class Admin extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $db;
    protected bool $galleryColumnReady = false;
    protected bool $categoryImageColumnReady = false;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->db = db_connect();
        $this->ensureProductGalleryColumn();
        $this->ensureCategoryImageColumn();
    }

    public function login(): string
    {
        if (session()->get('is_admin_authenticated')) {
            return redirect()->to(base_url('admin/dashboard'));
        }

        return view('admin/login', [
            'title' => 'Login Admin',
        ]);
    }

    public function doLogin()
    {
        $login = trim((string) $this->request->getPost('login'));
        $password = (string) $this->request->getPost('password');

        $expectedLogin = env('admin.auth.login') ?: 'Guitrensd';
        $expectedPassword = env('admin.auth.password') ?: '27c/Xegoh2n7';

        if ($login !== $expectedLogin || $password !== $expectedPassword) {
            return redirect()->back()->withInput()->with('auth_error', 'Login ou senha inválidos.');
        }

        session()->set([
            'is_admin_authenticated' => true,
            'admin_user' => $login,
        ]);

        return redirect()->to(base_url('admin/dashboard'));
    }

    public function logout()
    {
        session()->remove(['is_admin_authenticated', 'admin_user']);
        return redirect()->to(base_url('admin/login'));
    }

    protected function ensureProductGalleryColumn(): void
    {
        if ($this->galleryColumnReady) {
            return;
        }

        if ($this->db->fieldExists('gallery', 'products')) {
            $this->galleryColumnReady = true;
            return;
        }

        $forge = Database::forge($this->db);
        $forge->addColumn('products', [
            'gallery' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'image',
            ],
        ]);

        $this->galleryColumnReady = true;
    }

    protected function ensureCategoryImageColumn(): void
    {
        if ($this->categoryImageColumnReady) {
            return;
        }

        if ($this->db->fieldExists('image', 'categories')) {
            $this->categoryImageColumnReady = true;
            return;
        }

        $forge = Database::forge($this->db);
        $forge->addColumn('categories', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'description',
            ],
        ]);

        $this->categoryImageColumnReady = true;
    }

    protected function productUploadDir(): string
    {
        return rtrim(FCPATH, "\\/") . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'products';
    }

    protected function productUploadPath(string $filename): string
    {
        return 'images/products/' . $filename;
    }

    protected function ensureProductUploadDir(): void
    {
        $dir = $this->productUploadDir();
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    protected function deleteStoredFile(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $relativePath = str_replace('\\', '/', $relativePath);
        if (!str_starts_with($relativePath, 'images/products/') && !str_starts_with($relativePath, 'images/categories/')) {
            return;
        }

        $absolutePath = rtrim(FCPATH, "\\/") . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath);
        if (is_file($absolutePath)) {
            @unlink($absolutePath);
        }
    }

    protected function categoryUploadDir(): string
    {
        return rtrim(FCPATH, "\\/") . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'categories';
    }

    protected function categoryUploadPath(string $filename): string
    {
        return 'images/categories/' . $filename;
    }

    protected function ensureCategoryUploadDir(): void
    {
        $dir = $this->categoryUploadDir();
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    protected function uploadSingleProductImage($file): ?string
    {
        if (!$file || (method_exists($file, 'getError') && $file->getError() === UPLOAD_ERR_NO_FILE)) {
            return null;
        }

        if (!$file->isValid()) {
            throw new \RuntimeException('Não foi possível enviar a imagem do produto.');
        }

        $extension = strtolower((string) $file->getClientExtension());
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
            throw new \RuntimeException('A imagem do produto deve ser JPG, PNG, GIF ou WEBP.');
        }

        $this->ensureProductUploadDir();
        $newName = $file->getRandomName();
        $file->move($this->productUploadDir(), $newName);

        return $this->productUploadPath($newName);
    }

    protected function uploadSingleCategoryImage($file): ?string
    {
        if (!$file || (method_exists($file, 'getError') && $file->getError() === UPLOAD_ERR_NO_FILE)) {
            return null;
        }

        if (!$file->isValid()) {
            throw new \RuntimeException('Não foi possível enviar a imagem da categoria.');
        }

        $extension = strtolower((string) $file->getClientExtension());
        if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
            throw new \RuntimeException('A imagem da categoria deve ser JPG, PNG, GIF ou WEBP.');
        }

        $this->ensureCategoryUploadDir();
        $newName = $file->getRandomName();
        $file->move($this->categoryUploadDir(), $newName);

        return $this->categoryUploadPath($newName);
    }

    protected function uploadGalleryImages(array $files): array
    {
        $paths = [];

        try {
            foreach ($files as $file) {
                if (!$file || (method_exists($file, 'getError') && $file->getError() === UPLOAD_ERR_NO_FILE)) {
                    continue;
                }

                if (!$file->isValid()) {
                    throw new \RuntimeException('Não foi possível enviar uma das imagens da galeria.');
                }

                $extension = strtolower((string) $file->getClientExtension());
                if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
                    throw new \RuntimeException('As imagens da galeria devem ser JPG, PNG, GIF ou WEBP.');
                }

                $this->ensureProductUploadDir();
                $newName = $file->getRandomName();
                $file->move($this->productUploadDir(), $newName);
                $paths[] = $this->productUploadPath($newName);
            }
        } catch (\RuntimeException $e) {
            foreach ($paths as $path) {
                $this->deleteStoredFile($path);
            }
            throw $e;
        }

        return $paths;
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

    protected function enrichCategory(object $category): object
    {
        $category->image_url = !empty($category->image) ? base_url($category->image) : null;
        return $category;
    }

    protected function enrichProducts(array $products): array
    {
        return array_map(fn ($product) => $this->enrichProduct($product), $products);
    }

    // PRODUTOS
    public function products(): string
    {
        $products = $this->enrichProducts($this->productModel->findAll());
        $categories = $this->categoryModel->findAll();

        $data = [
            'title' => 'Gerenciar Produtos',
            'products' => $products,
            'categories' => $categories,
        ];

        return view('admin/products/index', $data);
    }

    public function createProduct(): string
    {
        $categories = $this->categoryModel->findAll();

        $data = [
            'title' => 'Novo Produto',
            'categories' => $categories,
        ];

        return view('admin/products/create', $data);
    }

    public function storeProduct()
    {
        $validation = $this->validate([
            'category_id' => 'required|integer',
            'name' => 'required|min_length[3]',
            'slug' => 'required|is_unique[products.slug]',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $imagePath = $this->uploadSingleProductImage($this->request->getFile('image'));
            $galleryPaths = $this->uploadGalleryImages($this->request->getFileMultiple('gallery') ?? []);
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('errors', ['upload' => $e->getMessage()]);
        }

        $productData = [
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $imagePath,
            'stock' => $this->request->getPost('stock'),
            'status' => 'active',
        ];

        if ($this->galleryColumnReady) {
            $productData['gallery'] = !empty($galleryPaths) ? json_encode($galleryPaths) : null;
        }

        $this->productModel->save($productData);

        return redirect()->to('/admin/products')->with('success', 'Produto criado com sucesso!');
    }

    public function editProduct($id = null): string
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw new \Exception('Produto não encontrado');
        }

        $product = $this->enrichProduct($product);

        $categories = $this->categoryModel->findAll();

        $data = [
            'title' => 'Editar Produto',
            'product' => $product,
            'categories' => $categories,
        ];

        return view('admin/products/edit', $data);
    }

    public function updateProduct($id = null)
    {
        $product = $this->productModel->find($id);
        if (!$product) {
            throw new \Exception('Produto não encontrado');
        }

        $validation = $this->validate([
            'category_id' => 'required|integer',
            'name' => 'required|min_length[3]',
            'slug' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $existingGallery = $this->decodeGallery($product->gallery ?? null);

        try {
            $newImagePath = $this->uploadSingleProductImage($this->request->getFile('image'));
            $galleryPaths = $this->uploadGalleryImages($this->request->getFileMultiple('gallery') ?? []);
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('errors', ['upload' => $e->getMessage()]);
        }

        if ($newImagePath) {
            $this->deleteStoredFile($product->image ?? null);
        } else {
            $newImagePath = $product->image ?? null;
        }

        $galleryPaths = array_merge($existingGallery, $galleryPaths);

        $productData = [
            'category_id' => $this->request->getPost('category_id'),
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'image' => $newImagePath,
            'stock' => $this->request->getPost('stock'),
            'status' => $this->request->getPost('status') ?? 'active',
        ];

        if ($this->galleryColumnReady) {
            $productData['gallery'] = !empty($galleryPaths) ? json_encode($galleryPaths) : null;
        }

        $this->productModel->update($id, $productData);

        return redirect()->to('/admin/products')->with('success', 'Produto atualizado com sucesso!');
    }

    public function deleteProduct($id = null)
    {
        $product = $this->productModel->find($id);
        if ($product) {
            $this->deleteStoredFile($product->image ?? null);
            foreach ($this->decodeGallery($product->gallery ?? null) as $galleryPath) {
                $this->deleteStoredFile($galleryPath);
            }
        }

        $this->productModel->delete($id);
        return redirect()->to('/admin/products')->with('success', 'Produto deletado com sucesso!');
    }

    // CATEGORIAS
    public function categories(): string
    {
        $categories = array_map(fn ($category) => $this->enrichCategory($category), $this->categoryModel->findAll());

        $data = [
            'title' => 'Gerenciar Categorias',
            'categories' => $categories,
        ];

        return view('admin/categories/index', $data);
    }

    public function createCategory(): string
    {
        $data = [
            'title' => 'Nova Categoria',
        ];

        return view('admin/categories/create', $data);
    }

    public function storeCategory()
    {
        $validation = $this->validate([
            'name' => 'required|min_length[3]',
            'slug' => 'required|is_unique[categories.slug]',
            'description' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $imagePath = $this->uploadSingleCategoryImage($this->request->getFile('image'));
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('errors', ['upload' => $e->getMessage()]);
        }

        $categoryData = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->categoryImageColumnReady) {
            $categoryData['image'] = $imagePath;
        }

        $this->categoryModel->save($categoryData);

        return redirect()->to('/admin/categories')->with('success', 'Categoria criada com sucesso!');
    }

    public function editCategory($id = null): string
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            throw new \Exception('Categoria não encontrada');
        }

        $category = $this->enrichCategory($category);

        $data = [
            'title' => 'Editar Categoria',
            'category' => $category,
        ];

        return view('admin/categories/edit', $data);
    }

    public function updateCategory($id = null)
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            throw new \Exception('Categoria não encontrada');
        }

        $validation = $this->validate([
            'name' => 'required|min_length[3]',
            'slug' => 'required',
            'description' => 'required',
        ]);

        if (!$validation) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        try {
            $newImagePath = $this->uploadSingleCategoryImage($this->request->getFile('image'));
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('errors', ['upload' => $e->getMessage()]);
        }

        if ($newImagePath) {
            $this->deleteStoredFile($category->image ?? null);
        } else {
            $newImagePath = $category->image ?? null;
        }

        $categoryData = [
            'name' => $this->request->getPost('name'),
            'slug' => $this->request->getPost('slug'),
            'description' => $this->request->getPost('description'),
        ];

        if ($this->categoryImageColumnReady) {
            $categoryData['image'] = $newImagePath;
        }

        $this->categoryModel->update($id, $categoryData);

        return redirect()->to('/admin/categories')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function deleteCategory($id = null)
    {
        $category = $this->categoryModel->find($id);
        if ($category) {
            $this->deleteStoredFile($category->image ?? null);
        }

        $this->categoryModel->delete($id);
        return redirect()->to('/admin/categories')->with('success', 'Categoria deletada com sucesso!');
    }

    public function dashboard(): string
    {
        $products = $this->enrichProducts($this->productModel->orderBy('created_at', 'DESC')->findAll(20));
        $categories = $this->categoryModel->findAll();

        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category->id] = $category->name;
        }

        $data = [
            'title' => 'Painel de Itens',
            'products' => $products,
            'categories' => $categories,
            'category_map' => $categoryMap,
            'total_products' => $this->productModel->countAll(),
        ];

        return view('admin/dashboard', $data);
    }
}
