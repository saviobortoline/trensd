<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;

class Home extends BaseController
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
            static fn($path) => base_url($path),
            $this->decodeGallery($product->gallery ?? null)
        );

        return $product;
    }

    protected function enrichProducts(array $products): array
    {
        return array_map(fn($product) => $this->enrichProduct($product), $products);
    }

    protected function enrichCategories(array $categories): array
    {
        $total = count($categories);

        return array_map(function ($category, $index) use ($total) {
            $category->image_url = !empty($category->image) ? base_url($category->image) : null;

            $products = $this->productModel->where('status', 'active')
                ->where('category_id', $category->id)
                ->orderBy('created_at', 'DESC')
                ->findAll();

            $coverProduct = null;
            foreach ($products as $product) {
                if (!empty($product->image)) {
                    $coverProduct = $this->enrichProduct($product);
                    break;
                }
            }

            if (!$coverProduct && !empty($products[0])) {
                $coverProduct = $this->enrichProduct($products[0]);
            }

            $category->product_count = count($products);
            $category->cover_image_url = $category->image_url ?? ($coverProduct->image_url ?? null);
            $category->catalog_variant = ($index === $total - 1 && ($total % 3) === 1) ? 'full' : 'standard';

            return $category;
        }, $categories, array_keys($categories));
    }

    public function index(): string
    {
        $categories = $this->enrichCategories($this->categoryModel->getAllActive());
        $featuredProducts = $this->enrichProducts($this->productModel->getFeatured(8));
        $carouselSlides = array_slice(array_map(static function ($category) {
            return [
                'title' => $category->name,
                'subtitle' => $category->description ?: 'Itens criados no painel administrativo.',
                'image_url' => $category->cover_image_url ?? null,
                'url' => base_url('categoria/' . $category->slug),
                'badge' => (int) ($category->product_count ?? 0) . ' itens',
            ];
        }, $categories), 0, 5);

        return view('home', [
            'title' => 'Início',
            'categories' => $categories,
            'featured_products' => $featuredProducts,
            'carousel_slides' => $carouselSlides,
        ]);
    }

    public function about(): string
    {
        return view('about', [
            'title' => 'Sobre Nós',
        ]);
    }

    public function refundPolicy(): string
    {
        return view('refund_policy', [
            'title' => 'Política de Reembolso, Devolução e Troca',
        ]);
    }

    public function privacyPolicy(): string
    {
        return view('privacy_policy', [
            'title' => 'Política de Privacidade',
        ]);
    }

    public function contact(): string
    {
        return view('contact', [
            'title' => 'Contato',
        ]);
    }

    public function sendContact()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[120]',
            'email' => 'required|valid_email|max_length[150]',
            'phone' => 'permit_empty|max_length[30]',
            'subject' => 'required|in_list[Dúvidas,Reclamações,Sugestões,Elogios,Outro]',
            'message' => 'required|min_length[10]|max_length[3000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $name = trim((string) $this->request->getPost('name'));
        $emailAddress = trim((string) $this->request->getPost('email'));
        $phone = trim((string) $this->request->getPost('phone'));
        $subject = trim((string) $this->request->getPost('subject'));
        $message = trim((string) $this->request->getPost('message'));
        $whatsapp = $this->request->getPost('whatsapp') ? 'Sim' : 'Não';

        $email = service('email');
        $emailConfig = config('Email');
        $fromEmail = !empty($emailConfig->fromEmail) ? $emailConfig->fromEmail : 'no-reply@trensde.com.br';
        $fromName = !empty($emailConfig->fromName) ? $emailConfig->fromName : 'Trens Dê';

        $email->setFrom($fromEmail, $fromName);
        $email->setTo('contato@trensde.com.br');
        $email->setReplyTo($emailAddress, $name);
        $email->setSubject('[Contato Trens Dê] ' . $subject);
        $email->setMessage(
            "Nova mensagem enviada pelo formulário de contato.\n\n"
            . "Nome: {$name}\n"
            . "E-mail: {$emailAddress}\n"
            . "Telefone: {$phone}\n"
            . "Whatsapp: {$whatsapp}\n"
            . "Assunto: {$subject}\n\n"
            . "Mensagem:\n{$message}\n"
        );

        if (!$email->send()) {
            return redirect()->back()->withInput()->with(
                'contact_error',
                'Não foi possível enviar sua mensagem agora. Tente novamente em alguns minutos.'
            );
        }

        return redirect()->to(base_url('contato'))->with(
            'contact_success',
            'Mensagem enviada com sucesso. Obrigado pelo contato!'
        );
    }
}
