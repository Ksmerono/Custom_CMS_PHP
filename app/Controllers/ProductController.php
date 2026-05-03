<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;

class ProductController
{
    public function index(): void
    {
        $products = Product::getActive();

        View::render('products/index', [
            'title' => 'Catálogo de productos',
            'products' => $products,
        ]);
    }

    public function show(string $slug): void
    {
        $product = Product::findBySlug($slug);

        if (!$product) {
            http_response_code(404);
            die('Producto no encontrado.');
        }

        View::render('products/show', [
            'title' => $product['name'],
            'product' => $product,
        ]);
    }
}