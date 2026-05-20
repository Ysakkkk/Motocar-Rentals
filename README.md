# MotoCar Rentals — Tema WordPress

Tema de WordPress desarrollado a medida para **MotoCar Rentals**, empresa de alquiler de carros y motos con sede en Antioquia, Colombia. El sitio combina una landing page completa con un sistema de blog, permitiendo a los clientes explorar la flota disponible, descubrir los destinos turísticos de la región, cotizar directamente por WhatsApp y leer contenido editorial del negocio.

![WordPress](https://img.shields.io/badge/WordPress-6.x-21759B?logo=wordpress)
![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![License](https://img.shields.io/badge/Licencia-GPL--2.0-blue)

---

## Vista previa

Para ver el sitio sin necesidad de tener WordPress instalado, abre `preview.html` directamente en tu navegador. Este archivo es solo para previsualización local y no se sube al servidor.

---

## Qué incluye

### Landing page (`front-page.php`)
- **Hero slider** de 4 imágenes rotativas con texto animado y CTA de cotización.
- **Catálogo de vehículos** con filtro dinámico por tipo (carro / moto), rango de precio y disponibilidad por fechas y horarios.
- **Modal de cotización** integrado con WhatsApp: selección de vehículo, fechas, horarios y lugar de entrega/devolución generan un mensaje prellenado listo para enviar. El administrador recibe notificación por correo.
- **Galería de destinos** turísticos de Antioquia con slider horizontal.
- **Reseñas** de clientes.
- **Sección Nosotros** con misión y valores.
- **Preguntas frecuentes** expandible con 25 preguntas comunes sobre el servicio.
- **Marcas aliadas:** Renault, KIA, Volkswagen, Yamaha, Toyota y Suzuki.
- **Topbar** con dirección, correo, redes sociales, selector de idioma (ES/EN) y modo oscuro.

### SEO
- Meta etiquetas `description` y `canonical` optimizadas.
- Open Graph completo para compartir en redes sociales.
- Twitter Card con imagen grande.
- Datos estructurados JSON-LD: `AutoRental + LocalBusiness` y `FAQPage` (Schema.org).

### Blog (`archive.php` / `single.php`)
- Cuadrícula de artículos con imagen, categoría, fecha y extracto.
- Filtro por categoría mediante pills de navegación.
- Paginación nativa de WordPress.
- Vista de post individual con hero (imagen destacada de fondo), tiempo de lectura estimado, tags, navegación entre entradas y CTA de cotización al pie.

### Páginas genéricas (`page.php`)
- Plantilla universal para páginas de WordPress (Aviso legal, Contacto, etc.) con hero y contenido tipográfico.

### Sistema de traducción
- Bilingüe español / inglés con conmutador en el topbar. Toda la interfaz client-side es traducible mediante `translations.js`.

### Modo oscuro
- Activable desde el topbar. Persiste en `localStorage` y se aplica antes de la carga del CSS para evitar destellos (FOUC).

---

## Estructura del proyecto

```
Motocar-Rentals/
├── README.md                    ← Este archivo
├── GUIA-INSTALACION.md          ← Instrucciones completas de instalación en WordPress
├── preview.html                 ← Vista previa local (no se sube al servidor)
├── Imágenes/                    ← Recursos gráficos originales de referencia
└── motocar-theme/               ← Tema de WordPress (comprimir en .zip para subir)
    ├── style.css                ← Metadatos del tema (nombre, versión, autor)
    ├── functions.php            ← CPT, taxonomías, meta boxes, AJAX, enqueue de assets
    ├── front-page.php           ← Landing page (autónoma, no usa header/footer global)
    ├── header.php               ← Cabecera global (topbar + nav) para blog y páginas
    ├── footer.php               ← Pie de página global + botón WhatsApp flotante
    ├── archive.php              ← Listado del blog (cuadrícula + filtros + paginación)
    ├── single.php               ← Post individual del blog
    ├── page.php                 ← Páginas genéricas de WordPress
    ├── index.php                ← Fallback requerido por WordPress
    ├── BLOG-README.md           ← Guía técnica del sistema de blog
    └── assets/
        ├── css/
        │   └── custom.css       ← Todos los estilos del tema (~3.300 líneas)
        ├── js/
        │   ├── main.js          ← Sliders, filtros, modal, cálculo de días, WhatsApp
        │   └── translations.js  ← Traducciones español / inglés
        └── img/
            └── IMAGENES-NECESARIAS.md  ← Lista de imágenes requeridas por el tema
```

> **Nota:** `front-page.php` es completamente autónomo: tiene su propio `<head>` con SEO, topbar, nav y footer incrustados directamente. Los archivos `header.php` y `footer.php` son exclusivos del blog y las páginas secundarias, y no afectan la landing page.

---

## Instalación rápida

**Requisitos:** WordPress 6.x · PHP 7.4+ · Hosting con soporte WordPress (ej. Hostinger)

1. Comprime la carpeta `motocar-theme/` en un `.zip`.
2. En WordPress ve a **Apariencia → Temas → Añadir nuevo → Subir tema**, sube el `.zip` y actívalo.
3. Ve a **Ajustes → Lectura**, selecciona "Una página estática", elige `Inicio` como página de inicio y `Blog` como página de entradas.
4. Ve a **Ajustes → Enlaces permanentes**, selecciona "Nombre de la entrada" y guarda **dos veces**.
5. Crea los vehículos desde **Vehículos → Añadir nuevo** en el menú lateral de WordPress.

Para instrucciones detalladas paso a paso, consulta `GUIA-INSTALACION.md`.  
Para configurar el blog (categorías, imágenes destacadas, ajustes), consulta `motocar-theme/BLOG-README.md`.

---

## Tecnologías utilizadas

| Tecnología | Versión | Uso |
|---|---|---|
| WordPress | 6.x | CMS, administración de contenido y rutas |
| PHP | 7.4+ | Custom Post Types, meta boxes, AJAX handlers |
| CSS3 | — | Variables CSS (`--mc-*`), Grid, Flexbox, animaciones |
| JavaScript (vanilla) | ES6+ | Sliders, filtros, modal, traducción, integración WhatsApp |
| Flatpickr | 4.6 | Selector de fechas y horas para alquiler |
| Font Awesome | 6.5 | Iconografía en toda la interfaz |
| Google Fonts | — | Anton · Antic Didone · Poppins · Playfair Display |

---

## Paleta de colores

| Rol | Variable CSS | Valor |
|---|---|---|
| Primario (naranja) | `--mc-primary` | `#F5A623` |
| Primario oscuro | `--mc-primary-dark` | `#E09000` |
| Primario claro | `--mc-primary-light` | `#FFD080` |
| Secundario (negro) | `--mc-secondary` | `#1A1A1A` |
| Dark base | `--mc-dark` | `#111111` |
| Blanco | `--mc-white` | `#FFFFFF` |
| Escala de grises | `--mc-gray-100` … `--mc-gray-900` | `#f0f0f0` … `#1a1a1a` |

Para cambiar la identidad visual del sitio basta con modificar `--mc-primary` y `--mc-primary-dark` en el bloque `:root` de `custom.css`.

---

## Endpoints AJAX registrados

| Acción | Función PHP | Descripción |
|---|---|---|
| `get_category_vehicles` | `motocar_get_category_vehicles` | Devuelve los vehículos de una categoría |
| `get_category_data` | `motocar_get_category_data` | Devuelve datos completos de una categoría |
| `check_categories_availability` | `motocar_check_categories_availability` | Verifica disponibilidad por fechas |
| `quote_notify` | `motocar_quote_notify` | Envía notificación por email al administrador al cotizar |

---

## Diseño responsive

| Breakpoint | Comportamiento |
|---|---|
| Escritorio (>992px) | Catálogo en 3 columnas, slider horizontal de destinos |
| Tablet (≤992px) | 2 columnas, layouts reorganizados |
| Móvil (≤768px) | 1 columna, menú hamburguesa, modal a pantalla completa |

---

## Contacto

| Canal | Enlace |
|---|---|
| WhatsApp | [+57 320 216 1156](https://wa.me/573202161156) |
| Email | motocarrentals@gmail.com |
| Instagram | [@motocar_rentals](https://www.instagram.com/motocar_rentals/) |
| Facebook | [MotoCar Rentals](https://www.facebook.com/p/MotoCar-Rentals-61558707917054/) |
| TikTok | [@motocar.rentals](https://www.tiktok.com/@motocar.rentals) |

---

## Licencia

Distribuido bajo la [GNU General Public License v2.0](https://www.gnu.org/licenses/gpl-2.0.html).
