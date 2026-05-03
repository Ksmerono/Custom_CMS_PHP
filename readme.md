# 🧩 Proyecto Catálogo de Productos (PHP MVC simple)

Este proyecto es una aplicación web desarrollada en **PHP puro**, siguiendo una arquitectura **MVC ligera** (sin framework), con un panel de administración para gestionar productos.

---

## ⚙️ Cómo funciona la aplicación

### 🔁 Flujo de una petición

Ejemplo: acceder al listado de productos


URL → public/index.php
→ Controller (ProductController)
→ Model (Product)
→ Base de datos
→ View (products/index.php)
→ Layout (main.php)
→ HTML final


---

# 🧩 Proyecto Catálogo de Productos (PHP MVC simple)

Aplicación web desarrollada en **PHP puro**, siguiendo una arquitectura **MVC ligera (sin framework)**, con un panel de administración para gestionar productos.

---


## 🏗️ Estructura del proyecto

```bash
pagina_productos/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Core/
│   └── Services/
├── config/
├── public/
│   ├── index.php
│   ├── producto.php
│   ├── admin/
│   └── uploads/
├── views/
│   ├── layouts/
│   ├── products/
│   └── admin/
├── bootstrap.php
└── database.sql
```

---

## ⚙️ Flujo de la aplicación

```txt
URL → public/index.php
    → Controller
        → Model
            → DB
        → View
            → Layout
                → HTML
```

---

## 🧠 Arquitectura

- **Controllers** → lógica
- **Models** → base de datos
- **Views** → HTML
- **Core** → utilidades
- **Services** → lógica reusable

---

## 📦 Panel Admin

Ruta:

```
/admin/
```

Funciones:

- CRUD de productos
- Subida de imágenes
- Activar/desactivar

---

## 🖼️ Imágenes

- Carpeta: `public/uploads/products/`
- Guardado en DB: `uploads/products/...`
- Reemplazo automático al editar

---

## 🌐 Acceso local

```
http://localhost/pagina_productos/public/
```

---

## 🔜 Próximas mejoras

- Login con roles
- URLs limpias
- Categorías
- Buscador

---

## 👨‍💻 Autor

Proyecto base MVC en PHP sin frameworks.
