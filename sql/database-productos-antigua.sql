CREATE DATABASE IF NOT EXISTS productos_php
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE productos_php;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(180) NOT NULL,
  slug VARCHAR(180) NOT NULL UNIQUE,
  description TEXT,
  price DECIMAL(10,2) DEFAULT 0.00,
  image VARCHAR(255),
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO products (name, slug, description, price, image, is_active)
VALUES
('Silla Nórdica', 'silla-nordica', 'Silla de estilo nórdico para salón o comedor.', 59.90, NULL, 1),
('Mesa de Roble', 'mesa-roble', 'Mesa de comedor fabricada en madera de roble.', 249.00, NULL, 1),
('Sofá Gris', 'sofa-gris', 'Sofá cómodo de tres plazas en color gris.', 399.00, NULL, 1);