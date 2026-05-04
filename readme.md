# 🧩 Proyecto Catálogo de Productos (PHP MVC)

Aplicación web desarrollada en **PHP puro** con arquitectura **MVC ligera**, incluyendo un sistema de gestión de contenidos (CMS) personalizado.

---

## 🏗️ Estructura del proyecto

```
pagina_productos/
├── app/
│   ├── Controllers/
│   │   ├── ContentController.php      # Controlador público
│   │   ├── AdminContentController.php # Admin de contenidos
│   │   └── AdminContentTypeController.php # Admin de tipos
│   ├── Models/
│   │   ├── Content.php                # Contenidos
│   │   ├── ContentType.php            # Tipos de contenido
│   │   └── ImageUploadService.php     # Subida de imágenes
│   ├── Core/
│   │   ├── Database.php               # Conexión BD
│   │   ├── View.php                  # Render de vistas
│   │   └── Router.php                 # Router de URLs limpias
├── config/
│   └── config.php                     # Configuración BD
├── public/
│   ├── index.php                      # Punto de entrada (router)
│   ├── admin/                         # Panel de administración
│   └── uploads/                       # Imágenes
├── views/
│   ├── layouts/main.php               # Layout principal
│   ├── contents/                      # Vistas públicas
│   └── admin/                         # Vistas del admin
├── sql/
│   └── content_system.sql             # Esquema de BD
├── bootstrap.php
└── .gitignore
```

---

## ⚙️ Cómo funciona

### Sistema de Contenidos

El proyecto implementa un **CMS flexible** donde puedes crear cualquier tipo de contenido:

1. **Tipos de Contenido** → Definen un grupo (productos, noticias, eventos...)
2. **Campos** → Cada tipo tiene campos personalizables (texto, número, imagen, etc.)
3. **Contenidos** → Las entradas reales de cada tipo

### Flujo de una petición

```
URL limpia (/productos, /producto/mi-producto)
    → public/index.php
    → Router (analiza URL)
    → Controller
    → Model (Content/ContentType)
    → View (contents/index.php, contents/show.php)
    → HTML
```

### URLs limpias

- `/` → Página de inicio (lista de tipos de contenido)
- `/productos` → Lista de contenidos del tipo "productos"
- `/producto/mi-producto` → Detalle de un contenido

---

## 📋 Base de datos

Tablas del sistema:

- **content_types** → Tipos de contenido (name, slug, route, description)
- **content_fields** → Campos de cada tipo (name, slug, field_type, required, options)
- **contents** → Contenidos (title, slug, is_active)
- **content_field_values** → Valores de los campos

### SQL inicial

Ejecutar `sql/content_system.sql` para crear las tablas e insertar tipos por defecto.

---

## 🖥️ Panel de Administración

Ruta: `/admin/`

### Contenidos
- `contents.php` → Lista de tipos de contenido
- `contents.php?type=1` → Lista de contenidos de un tipo
- `content-create.php?type=1` → Crear contenido
- `content-edit.php?id=1` → Editar contenido

### Tipos de Contenido
- `content-types.php` → Lista de tipos
- `content-type-create.php` → Crear tipo
- `content-type-edit.php?id=1` → Editar tipo y gestionar campos

---

## 🔧 Admin - Gestionar Tipos de Contenido

1. Ir a **Tipos de Contenido**
2. Crear tipo (ej: "Producto")
3. Definir la **ruta pública** (ej: "productos")
4. Agregar campos:
   - **Nombre** (slug interno)
   - **Tipo**: texto, textarea, número, fecha, imagen, boolean, select
   - **Obligatorio**: sí/no
   - **Opciones**: para tipo "select" (una por línea)

### Ejemplo: Tipo "Producto"

| Campo | Tipo | Obligatorio |
|-------|------|-------------|
| Descripción | textarea | Sí |
| Precio | number | Sí |
| Imagen | image | No |
| Destacado | boolean | No |
| Categoría | select | No |

---

## 🌍 Acceso local

```bash
# Con XAMPP
http://pagina-productos.local/
```

El archivo `.htaccess` redirige todas las peticiones a `index.php`.

---

## 🌐 Rutas públicas

| URL | Descripción |
|-----|-------------|
| `/` | Página de inicio (lista de tipos) |
| `/productos` | Lista de productos |
| `/noticias` | Lista de noticias |
| `/producto/mi-producto` | Detalle de producto |
| `/noticia/mi-noticia` | Detalle de noticia |

---

## 📦 Características

- ✅ URLs limpias (sin .php)
- ✅ Sistema de contenidos configurable
- ✅ Campos personalizados por tipo
- ✅ Soporte para imágenes
- ✅ Panel de administración
- ✅ Activar/desactivar contenidos

---

## 👨‍💻 Autor

Proyecto PHP MVC con CMS personalizado.