<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Product;

class AdminProductController
{
    public function index(): void
    {
        $products = Product::getAll();

        View::render('admin/products/index', [
            'title' => 'Administrar productos',
            'products' => $products,
        ]);
    }

    public function create(): void
    {
        View::render('admin/products/create', [
            'title' => 'Crear producto',
        ]);
    }

    public function store(array $data): void
    {
        Product::create([
            'name' => trim($data['name'] ?? ''),
            'slug' => trim($data['slug'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'price' => (float) ($data['price'] ?? 0),
            'image' => trim($data['image'] ?? ''),
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ]);

        header('Location: products.php');
        exit;
    }

    public function edit(int $id): void
    {
        $product = Product::find($id);

        if (!$product) {
            http_response_code(404);
            die('Producto no encontrado.');
        }

        View::render('admin/products/edit', [
            'title' => 'Editar producto',
            'product' => $product,
        ]);
    }

    public function update(int $id, array $data): void
    {
        $product = Product::find($id);

        if (!$product) {
            http_response_code(404);
            die('Producto no encontrado.');
        }

        Product::update($id, [
            'name' => trim($data['name'] ?? ''),
            'slug' => trim($data['slug'] ?? ''),
            'description' => trim($data['description'] ?? ''),
            'price' => (float) ($data['price'] ?? 0),
            'image' => trim($data['image'] ?? ''),
            'is_active' => isset($data['is_active']) ? 1 : 0,
        ]);

        header('Location: products.php');
        exit;
    }

    public function delete(int $id): void
    {
        Product::delete($id);

        header('Location: products.php');
        exit;
    }
}