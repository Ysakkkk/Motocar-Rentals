# BLOG-README — Motocar Rentals Theme

Guía para el desarrollador que continúe este proyecto.

---

## Archivos creados para el blog

| Archivo | Propósito |
|---|---|
| `header.php` | Cabecera HTML global (topbar + nav) usada por todas las páginas del blog |
| `footer.php` | Pie de página global (footer + botón WhatsApp flotante) |
| `archive.php` | Listado de entradas del blog (cuadrícula de tarjetas + filtro de categorías + paginación) |
| `single.php` | Vista individual de una entrada (hero, contenido, navegación entre posts, CTA) |
| `page.php` | Plantilla genérica para "Páginas" de WordPress (Aviso legal, Contacto, etc.) |

> **Importante:** `front-page.php` es completamente independiente.  
> Tiene su propio `<head>`, `<body>` y `<footer>` incrustados, y **no** llama a `get_header()` ni `get_footer()`.  
> Los archivos del blog no lo afectan en absoluto.

---

## Configuración inicial en WP Admin

### 1. Activar el blog

1. Ve a **Apariencia → Tema** y confirma que el tema activo es `motocar-theme`.
2. Ve a **Páginas → Añadir nueva** y crea dos páginas:
   - **Nombre:** `Inicio` (puede estar vacía; solo sirve de referencia)
   - **Nombre:** `Blog` (también puede estar vacía)
3. Ve a **Ajustes → Lectura**:
   - "La página de inicio muestra" → **Una página estática**
   - "Página de inicio" → `Inicio`
   - "Página de entradas" → `Blog`
4. Guarda los cambios.

Desde este momento, la URL `/blog/` mostrará la cuadrícula de artículos.

---

## Categorías recomendadas

Crea estas categorías en **Entradas → Categorías**:

| Nombre | Descripción sugerida |
|---|---|
| Destinos | Guías de lugares para visitar en Antioquia |
| Tips de viaje | Consejos prácticos para viajeros |
| Cuidado del vehículo | Mantenimiento y buenas prácticas |
| Novedades | Noticias y actualizaciones de Motocar Rentals |

---

## Crear una entrada del blog

1. **Entradas → Añadir nueva**
2. Escribe el título y el contenido.
3. Asigna al menos una **Categoría** (columna derecha).
4. Sube una **Imagen destacada** (columna derecha) — se mostrará como hero en `single.php` y como miniatura en `archive.php`.
5. Publica.

---

## Imagen destacada (featured image)

- Tamaño recomendado: **1200 × 630 px** mínimo.
- Formato: JPG o WebP.
- Si no se asigna imagen, `archive.php` muestra un placeholder con ícono de cámara y `single.php` usa el gradiente oscuro por defecto.

---

## Header en el blog vs. en la página de inicio

| Contexto | Comportamiento del header |
|---|---|
| `front-page.php` | El header es transparente y se superpone al slider hero. Está definido directamente en ese archivo. |
| Blog / páginas | El header usa la clase `.mc-header--blog`, que lo hace **sticky** y le da fondo blanco sólido (oscuro en dark mode). |

El modificador `.mc-header--blog` se aplica automáticamente desde `header.php`.

---

## Variables CSS disponibles

El diseño usa propiedades personalizadas definidas en `assets/css/custom.css`.  
Las más relevantes para el blog:

```css
--mc-primary        /* Color principal (naranja/rojo) */
--mc-dark           /* Color oscuro base */
--mc-white          /* Blanco */
--mc-gray-50        /* Gris muy claro (fondos) */
--mc-gray-100
--mc-gray-200       /* Bordes suaves */
--mc-gray-300
--mc-gray-400       /* Texto secundario */
--mc-gray-500
--mc-gray-600
--mc-gray-700       /* Texto de cuerpo */
--mc-dark-surface   /* Fondo de tarjetas en dark mode */
```

---

## Clases CSS principales del blog

### archive.php

| Clase | Elemento |
|---|---|
| `.mc-blog-hero` | Banner superior de la página de blog |
| `.mc-blog-cats` | Contenedor de filtros de categoría |
| `.mc-blog-cats__btn` | Botón de categoría (añadir `.active` para resaltar) |
| `.mc-blog-grid` | Grid de tarjetas (CSS Grid auto-fill) |
| `.mc-blog-card` | Tarjeta de artículo |
| `.mc-blog-card__img` | Imagen de la tarjeta |
| `.mc-blog-card__cat` | Badge de categoría |
| `.mc-blog-pagination` | Contenedor de paginación |
| `.mc-blog-empty` | Estado vacío (sin posts) |

### single.php

| Clase | Elemento |
|---|---|
| `.mc-post-hero` | Hero del post (con o sin imagen destacada) |
| `.mc-post-hero--has-img` | Modificador cuando hay imagen destacada |
| `.mc-post-content` | Wrapper del contenido del post (tipografía de lectura) |
| `.mc-post-tags` | Contenedor de etiquetas |
| `.mc-post-nav` | Navegación anterior/siguiente |
| `.mc-post-cta` | CTA final del post |
| `.mc-btn--whatsapp` | Botón verde de WhatsApp |

### page.php

| Clase | Elemento |
|---|---|
| `.mc-page-hero` | Banner de la página |
| `.mc-page-content` | Sección de contenido |
| `.mc-page-body` | Wrapper de texto (ancho máximo, tipografía cuidada) |

---

## Cómo extender las plantillas

### Añadir sidebar
En `archive.php` o `single.php`, cambia `.mc-post-layout` a un grid de dos columnas y agrega `get_sidebar()` al lado.

### Añadir comentarios en posts
Actualmente los comentarios están desactivados por diseño.  
Para habilitarlos, agrega esto en `single.php` justo antes del `mc-post-nav`:
```php
<?php if (comments_open() || get_comments_number()) : ?>
    <div class="mc-post-comments">
        <?php comments_template(); ?>
    </div>
<?php endif; ?>
```

### Cambiar la URL del botón WhatsApp
Busca el número `573202161156` en `single.php` y `footer.php` y reemplázalo por el nuevo número en formato internacional (sin `+`).

### Añadir campos personalizados a los posts
Usa Advanced Custom Fields (ACF) o agrega meta boxes en `functions.php` siguiendo el patrón de los meta boxes de vehículos ya existentes.

---

## Estructura final del tema

```
motocar-theme/
  front-page.php     ← Página de inicio (autónoma, no usa header/footer)
  header.php         ← Cabecera para blog y páginas
  footer.php         ← Pie de página para blog y páginas
  archive.php        ← Listado del blog
  single.php         ← Post individual
  page.php           ← Páginas genéricas
  index.php          ← Fallback (no debería usarse en producción)
  functions.php      ← Configuración del tema, AJAX, meta boxes
  style.css          ← Cabecera del tema (nombre, versión, autor)
  assets/
    css/
      custom.css     ← Todos los estilos (front-page + blog)
    js/
      main.js        ← Lógica del front-page (filtros, cotizador, slider...)
      translations.js← Textos ES/EN
    img/             ← Imágenes locales
```

---

*Última actualización: junio 2025*
