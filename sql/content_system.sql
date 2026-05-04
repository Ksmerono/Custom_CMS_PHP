-- Tabla de tipos de contenido (noticias, productos, etc.)
CREATE TABLE content_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    route VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de campos para cada tipo de contenido
CREATE TABLE content_fields (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content_type_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL,
    field_type ENUM('text', 'textarea', 'number', 'date', 'image', 'boolean', 'select') NOT NULL DEFAULT 'text',
    required TINYINT(1) DEFAULT 0,
    options JSON,
    field_order INT DEFAULT 0,
    FOREIGN KEY (content_type_id) REFERENCES content_types(id) ON DELETE CASCADE
);

-- Tabla de contenidos
CREATE TABLE contents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content_type_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (content_type_id) REFERENCES content_types(id) ON DELETE CASCADE
);

-- Tabla de valores de campos
CREATE TABLE content_field_values (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content_id INT NOT NULL,
    field_id INT NOT NULL,
    value TEXT,
    FOREIGN KEY (content_id) REFERENCES contents(id) ON DELETE CASCADE,
    FOREIGN KEY (field_id) REFERENCES content_fields(id) ON DELETE CASCADE
);

-- Insertar tipo de contenido "producto" por defecto
INSERT INTO content_types (name, slug, route, description) VALUES ('Producto', 'producto', 'productos', 'Contenido de tipo producto');

-- Insertar tipo de contenido "noticia" por defecto
INSERT INTO content_types (name, slug, route, description) VALUES ('Noticia', 'noticia', 'noticias', 'Contenido de tipo noticia');