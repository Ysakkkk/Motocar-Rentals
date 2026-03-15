# 🚗 MotoCar Rentals — Tema WordPress

Tema personalizado de WordPress para **MotoCar Rentals**, empresa de alquiler de carros y motos en Antioquia, Colombia.

![WordPress](https://img.shields.io/badge/WordPress-6.x-21759B?logo=wordpress)
![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![License](https://img.shields.io/badge/Licencia-GPL--2.0-blue)

---

## 📸 Vista previa

> Abre `preview.html` en tu navegador para ver la landing page sin necesidad de WordPress.

---

## ✨ Características

- **Landing page completa** con hero slider, catálogo de vehículos, lugares de interés y sección de servicios
- **Reservas por WhatsApp** — formulario de cotización que envía mensaje directo con datos del vehículo
- **Filtro de vehículos** por tipo (carro/moto), precio y disponibilidad
- **Diseño responsive** optimizado para escritorio, tablet y móvil
- **Custom Post Type** `vehiculo` con taxonomía personalizada y meta boxes
- **Selector de idioma** (español / inglés)
- **Flatpickr** para selección de fechas de alquiler
- **Secciones preparadas** para Google Reviews e Instagram embeds

---

## 🗂️ Estructura del proyecto

```
Motocar Rentals/
├── README.md                    ← Este archivo
├── GUIA-INSTALACION.md          ← Guía paso a paso para instalar en WordPress
├── preview.html                 ← Vista previa local (no se sube a WP)
├── Imágenes/                    ← Archivos fuente de imágenes
└── motocar-theme/               ← 📦 Tema de WordPress (esto se sube como .zip)
    ├── style.css                ← Metadatos del tema
    ├── functions.php            ← CPT, taxonomías, meta boxes, AJAX, enqueue
    ├── front-page.php           ← Template de la página principal
    ├── index.php                ← Fallback requerido por WordPress
    └── assets/
        ├── css/
        │   └── custom.css       ← Estilos del tema (~1900 líneas)
        ├── js/
        │   └── main.js          ← Sliders, filtros, modal, WhatsApp (~510 líneas)
        └── img/                 ← Imágenes del tema (logos, slides, íconos, etc.)
```

---

## 🚀 Instalación en WordPress

### Requisitos

- WordPress 6.x
- PHP 7.4 o superior
- Hosting con soporte WordPress (ej. Hostinger)

### Pasos rápidos

1. Comprime la carpeta `motocar-theme/` en un archivo `.zip`
2. En WordPress: **Apariencia → Temas → Añadir nuevo → Subir tema**
3. Sube el `.zip` y actívalo
4. Configura la página de inicio: **Ajustes → Lectura → Página estática**

> 📖 Para instrucciones detalladas (imágenes, vehículos, menús), consulta [GUIA-INSTALACION.md](GUIA-INSTALACION.md)

---

## 🛠️ Tecnologías

| Tecnología | Uso |
|---|---|
| **WordPress** | CMS y backend |
| **PHP** | Custom Post Types, taxonomías, AJAX |
| **CSS3** | Variables CSS, Grid, Flexbox, animaciones |
| **JavaScript** | Sliders, filtros dinámicos, modal, integración WhatsApp |
| **Flatpickr** | Selector de fechas |
| **Font Awesome 6** | Iconografía |
| **Google Fonts** | Anton, Antic Didone, Poppins, Playfair Display |

---

## 🎨 Paleta de colores

| Color | Variable | Hex |
|---|---|---|
| Naranja (primario) | `--mc-primary` | `#F5A623` |
| Negro (secundario) | `--mc-secondary` | `#1A1A1A` |
| Blanco | `--mc-white` | `#FFFFFF` |
| Gris claro (fondo) | `--mc-gray-50` | `#F8F8F8` |

---

## 📱 Responsive

El tema incluye breakpoints optimizados:

- **Desktop**: 3 columnas de vehículos, slider horizontal de lugares
- **Tablet** (≤992px): 2 columnas, layout adaptado
- **Móvil** (≤768px): 1 columna, menú hamburguesa, modal a pantalla completa

---

## 📞 Contacto

- **WhatsApp**: [+57 320 216 1156](https://wa.me/573202161156)
- **Instagram**: [@motocar_rentals](https://www.instagram.com/motocar_rentals/)
- **Facebook**: [MotoCar Rentals](https://www.facebook.com/p/MotoCar-Rentals-61558707917054/)
- **TikTok**: [@motocar.rentals](https://www.tiktok.com/@motocar.rentals)
- **Email**: motocarrentals@gmail.com

---

## 📄 Licencia

Este tema está licenciado bajo la [GNU General Public License v2.0](https://www.gnu.org/licenses/gpl-2.0.html).
