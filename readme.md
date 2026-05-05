# 🧩 CMS Flexible (PHP MVC)

Aplicación web desarrollada en **PHP puro** con arquitectura **MVC ligera**, implementando un sistema de gestión de contenidos (CMS) totalmente configurable.

La idea central es simple: **creas tipos de contenido y a partir de ellos generas lo que necesites** (productos, noticias, eventos, galerías, etc.).

---

## 🏗️ Estructura del proyecto

```
pagina_productos/
├── app/
│   ├── Controllers/
│   │   ├── ContentController.php          # Controlador público
│   │   ├── AdminContentController.php     # Admin de contenidos
│   │   └── AdminContentTypeController.php # Admin de tipos
│   ├── Models/
│   │   ├── Content.php                    # Contenidos
│   │   ├── ContentType.php                # Tipos de contenido
│   │   └── ImageUploadService.php         # Subida de imágenes
│   ├── Core/
│   │   ├── Database.php                   # Conexión BD
│   │   ├── View.php                       # Render de vistas
│   │   └── Router.php                     # Router de URLs limpias
├── config/
│   └── config.php                         # Configuración BD
├── public/
│   ├── index.php                          # Punto de entrada (router)
│   ├── admin/                             # Panel de administración
│   └── uploads/                           # Imágenes subidas
├── views/
│   ├── layouts/main.php                   # Layout principal
│   ├── contents/                          # Vistas públicas
│   └── admin/                             # Vistas del admin
├── sql/
│   └── content_system.sql                 # Esquema de BD
├── bootstrap.php
└── .gitignore
```

---

## ⚙️ Cómo funciona

### Filosofía del sistema

El CMS se basa en un concepto flexible:

1. **Tipos de Contenido** → Defines qué quieres gestionar (productos, noticias, eventos, recetas...)
2. **Campos** → Cada tipo tiene sus propios campos personalizables (texto, número, imagen, fecha, booleano, select)
3. **Contenidos** → Creas las entradas reales usando los campos definidos

No estás limitado a un catálogo de productos. El sistema se adapta a lo que necesites.

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

- `/` → Página de inicio (lista de tipos de contenido disponibles)
- `/productos` → Lista de contenidos del tipo "productos"
- `/producto/mi-producto` → Detalle de un contenido

---

## 📋 Base de datos

Tablas del sistema:

- **content_types** → Tipos de contenido (name, slug, route, description)
- **content_fields** → Campos de cada tipo (name, slug, field_type, required, options)
- **contents** → Contenidos (title, slug, is_active)
- **content_field_values** → Valores de los campos
- **users** → Usuarios del sistema (username, email, password, role, is_active)

### SQL inicial

Ejecutar `sql/content_system.sql` para crear las tablas e insertar tipos por defecto.
Ejecutar `sql/users.sql` para crear la tabla de usuarios.

---

## 🔐 Sistema de Login

El panel de administración está protegido con autenticación.

### Acceso
- **URL:** `/admin/login.php`
- **Usuario:** admin
- **Contraseña:** admin123

### Características
- ✅ Passwords encriptadas con bcrypt
- ✅ Solo admins pueden gestionar usuarios
- ✅ No se puede eliminar el propio usuario
- ✅ Registro de usuarios solo desde el panel admin
- ✅ Roles: admin (gestiona usuarios) / editor (solo contenidos)

### Gestionar Usuarios
- `users.php` → Lista de usuarios
- `user-create.php` → Crear usuario
- `user-edit.php?id=1` → Editar usuario
- `user-delete.php?id=1` → Eliminar usuario

---

## 🖥️ Panel de Administración

Ruta: `/admin/` (requiere login)

### Dashboard
- Vista general con acceso rápido a las secciones

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

## 🔧 Cómo crear un nuevo tipo de contenido

1. Ir a **Tipos de Contenido** en el panel admin
2. Crear un nuevo tipo (ej: "Receta")
3. Definir la **ruta pública** (ej: "recetas")
4. Agregar los campos que necesites:
   - **Nombre** (slug interno)
   - **Tipo**: texto, textarea, número, fecha, imagen, boolean, select
   - **Obligatorio**: sí/no
   - **Opciones**: para tipo "select" (una por línea)

### Ejemplo: Tipo "Receta"

| Campo | Tipo | Obligatorio |
|-------|------|-------------|
| Ingredientes | textarea | Sí |
| Tiempo preparación | number | Sí |
| Imagen | image | No |
| Dificultad | select | No |
| Destacada | boolean | No |

---

## 🌍 Acceso local

```bash
# Con XAMPP
http://pagina-cms.local/
```

El archivo `.htaccess` redirige todas las peticiones a `index.php`.

---

## 🌐 Rutas públicas (ejemplo)

| URL | Descripción |
|-----|-------------|
| `/` | Página de inicio (lista de tipos) |
| `/productos` | Lista de productos |
| `/noticias` | Lista de noticias |
| `/productos/mi-producto` | Detalle de producto |
| `/noticias/mi-noticia` | Detalle de noticia |

---

## 📦 Características

- ✅ URLs limpias (sin .php)
- ✅ Sistema de contenidos 100% configurable
- ✅ Campos personalizados por tipo
- ✅ Soporte para imágenes
- ✅ Panel de administración con login
- ✅ Sistema de usuarios con roles (admin/editor)
- ✅ Activar/desactivar contenidos

---

## 👨‍💻 Autor

Proyecto PHP MVC con CMS flexible y configurable.
