# MotoCar Rentals — Tema WordPress

Tema de WordPress desarrollado a medida para **MotoCar Rentals**, empresa de alquiler de carros y motos con sede en Antioquia, Colombia. El sitio funciona como una landing page completa donde los clientes pueden explorar la flota disponible, conocer los lugares turísticos de la región y realizar su cotización directamente por WhatsApp.

![WordPress](https://img.shields.io/badge/WordPress-6.x-21759B?logo=wordpress)
![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)
![License](https://img.shields.io/badge/Licencia-GPL--2.0-blue)

---

## Vista previa

Para ver el sitio sin necesidad de tener WordPress instalado, abre `preview.html` directamente en tu navegador. Este archivo es solo para previsualización local y no se sube al servidor.

---

## Qué incluye

- Landing page con hero slider de 4 imágenes rotativas, sección de vehículos, galería de lugares de interés en Antioquia y bloque de servicios.
- Sistema de cotización integrado con WhatsApp: el usuario selecciona un vehículo, llena fechas y lugar y se genera un mensaje prellenado listo para enviar.
- Filtro dinámico por tipo de vehículo (carro o moto), rango de precio y fechas de disponibilidad.
- Bilingüe español/inglés con sistema de traducción client-side (`translations.js`).
- Diseño responsive adaptado a escritorio, tablet y móvil.
- Custom Post Type `vehiculo` con taxonomía propia, meta boxes y ordenamiento automático por subcategoría y precio.
- Selector de fechas con Flatpickr.
- Sección de marcas aliadas: Renault, KIA, Volkswagen, Yamaha, Toyota y Suzuki.
- Sección de preguntas frecuentes con 25 preguntas comunes sobre el servicio de alquiler.
- Preparado para integrar reseñas de Google y embeds de Instagram.

---

## Estructura del proyecto

```
Motocar Rentals/
├── README.md                   ← Este archivo
├── GUIA-INSTALACION.md         ← Instrucciones completas para instalar en WordPress
├── preview.html                ← Vista previa local (no se sube al servidor)
├── Imágenes/                   ← Recursos gráficos originales de referencia
└── motocar-theme/              ← Tema de WordPress (se comprime en .zip para subir)
    ├── style.css               ← Metadatos del tema para WordPress
    ├── functions.php           ← CPT, taxonomías, meta boxes, AJAX y enqueue de assets
    ├── front-page.php          ← Template principal de la landing page
    ├── index.php               ← Fallback requerido por WordPress
    └── assets/
        ├── css/
        │   └── custom.css      ← Estilos del tema
        ├── js/
        │   ├── main.js         ← Sliders, filtros, modal e integración WhatsApp
        │   └── translations.js ← Traducciones español/inglés
        └── img/                ← Imágenes del tema (logos, slides, íconos, marcas)
```

---

## Instalación rápida

**Requisitos:** WordPress 6.x, PHP 7.4 o superior, hosting con soporte WordPress (ej. Hostinger).

1. Comprime la carpeta `motocar-theme/` en un `.zip`.
2. En WordPress ve a **Apariencia → Temas → Añadir nuevo → Subir tema**, sube el archivo y actívalo.
3. Crea una página llamada "Inicio" (puede estar vacía) y en **Ajustes → Lectura** selecciona "Una página estática" con esa página como inicio.
4. Ve a **Ajustes → Enlaces permanentes**, selecciona "Nombre de la entrada" y guarda **dos veces**.

Para instrucciones detalladas paso a paso, consulta `GUIA-INSTALACION.md`.

---

## Tecnologías utilizadas

| Tecnología | Uso |
|---|---|
| WordPress | CMS y administración de contenido |
| PHP | Custom Post Types, taxonomías, meta boxes, AJAX |
| CSS3 | Variables CSS, Grid, Flexbox, animaciones y transiciones |
| JavaScript (vanilla) | Sliders, filtros dinámicos, modal, sistema de traducción, integración WhatsApp |
| Flatpickr | Selección de rango de fechas para alquiler |
| Font Awesome 6 | Íconos en toda la interfaz |
| Google Fonts | Tipografías: Anton, Antic Didone, Poppins, Playfair Display |

---

## Paleta de colores

| Color | Variable CSS | Hex |
|---|---|---|
| Naranja (primario) | `--mc-primary` | `#F5A623` |
| Negro (secundario) | `--mc-secondary` | `#1A1A1A` |
| Blanco | `--mc-white` | `#FFFFFF` |
| Gris claro (fondos) | `--mc-gray-50` | `#F8F8F8` |

Estos valores se pueden ajustar desde las variables CSS en `custom.css`.

---

## Diseño responsive

El sitio se adapta a tres breakpoints principales:

- **Escritorio:** catálogo en 3 columnas, slider horizontal para lugares turísticos.
- **Tablet (≤992px):** 2 columnas, layout reorganizado.
- **Móvil (≤768px):** 1 columna, menú hamburguesa y modal a pantalla completa.

---

## Contacto

- **WhatsApp:** [+57 320 216 1156](https://wa.me/573202161156)
- **Email:** motocarrentals@gmail.com
- **Instagram:** [@motocar_rentals](https://www.instagram.com/motocar_rentals/)
- **Facebook:** [MotoCar Rentals](https://www.facebook.com/p/MotoCar-Rentals-61558707917054/)
- **TikTok:** [@motocar.rentals](https://www.tiktok.com/@motocar.rentals)

---

## Licencia

Distribuido bajo la [GNU General Public License v2.0](https://www.gnu.org/licenses/gpl-2.0.html).
