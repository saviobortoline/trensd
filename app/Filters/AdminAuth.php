<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $path = trim((string) $request->getUri()->getPath(), '/');
        $normalizedPath = preg_replace('#^index\.php/#', '', $path) ?? $path;

        if ($normalizedPath === 'admin/login') {
            return;
        }

        if (!session()->get('is_admin_authenticated')) {
            return redirect()->to(base_url('admin/login'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // no-op
    }
}
