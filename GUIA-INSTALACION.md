# MotoCar Rentals — Guía de instalación en WordPress (Hostinger)

Esta guía cubre todo el proceso de instalación del tema en un hosting WordPress con Hostinger, desde la preparación de los archivos hasta la verificación final del sitio.

---

## Estructura de archivos del tema

```
motocar-theme/
├── style.css                   ← Identificación del tema para WordPress
├── functions.php               ← CPT Vehículos, taxonomía, meta boxes, AJAX
├── front-page.php              ← Template de la landing page
├── index.php                   ← Fallback requerido por WordPress
├── screenshot.png              ← Vista previa del tema (1200×900 px)
└── assets/
    ├── css/
    │   └── custom.css          ← Estilos completos del tema
    ├── js/
    │   ├── main.js             ← Sliders, modal, filtros, integración WhatsApp
    │   └── translations.js     ← Traducciones español/inglés
    └── img/                    ← Imágenes del tema (ver detalle abajo)
        ├── logo.png
        ├── flag-es.png / flag-en.png
        ├── slide-1.jpg ... slide-4.jpg
        ├── santa-fe.jpg, guatape.jpg, jardin.jpg, jerico.jpg
        ├── brand-renault.png, brand-kia.png, brand-volkswagen.png
        ├── brand-yamaha.png, brand-toyota.png, brand-suzuki.png
        └── placeholder.jpg
```

**Archivos que NO se suben a WordPress:**
- `preview.html` — Solo sirve para previsualización local en el navegador.
- `GUIA-INSTALACION.md` — Esta guía.
- `README.md` — Documentación del proyecto.
- Carpeta `Imágenes/` — Los recursos originales. Las fotos de vehículos se suben directamente desde el panel de WordPress.

---

## Paso 1 — Preparar las imágenes del tema

Todas las imágenes del tema van dentro de `motocar-theme/assets/img/`. Las fotos de cada vehículo no van aquí; esas se suben después desde el administrador de WordPress.

### 1.1 Imágenes necesarias

| Archivo | Descripción | Tamaño recomendado |
|---------|-------------|-------------------|
| `logo.png` | Logo de MotoCar con fondo transparente | 200×60 px |
| `flag-es.png` | Bandera de Colombia para el selector de idioma | 24×16 px |
| `flag-en.png` | Bandera de Estados Unidos para el selector de idioma | 24×16 px |
| `slide-1.jpg` a `slide-4.jpg` | Fotos para el hero slider | 1920×900 px |
| `santa-fe.jpg` | Santa Fe de Antioquia | 600×400 px |
| `guatape.jpg` | Guatapé | 600×400 px |
| `jardin.jpg` | Jardín | 600×400 px |
| `jerico.jpg` | Jericó | 600×400 px |
| `brand-renault.png` | Logo de Renault | 120×60 px |
| `brand-kia.png` | Logo de KIA | 120×60 px |
| `brand-volkswagen.png` | Logo de Volkswagen | 120×60 px |
| `brand-yamaha.png` | Logo de Yamaha | 120×60 px |
| `brand-toyota.png` | Logo de Toyota | 120×60 px |
| `brand-suzuki.png` | Logo de Suzuki | 120×60 px |
| `placeholder.jpg` | Imagen por defecto cuando un vehículo no tiene foto | 600×400 px |

### 1.2 Recomendaciones para las imágenes

- Usa `.webp` o `.jpg` para fotografías y `.png` para logos con transparencia.
- Comprime todas las imágenes antes de subirlas con herramientas como [TinyPNG](https://tinypng.com/) o [Squoosh](https://squoosh.app/).
- Los slides del hero no deberían superar los 200–300 KB cada uno después de comprimir.
- Las fotos de vehículos idealmente deben pesar menos de 150 KB en formato `.webp`.
- Los logos de marcas no deberían pasar de 20 KB.
- Los nombres de archivo deben estar en minúsculas, sin espacios y sin tildes.
- Una resolución de 72 DPI es suficiente para web.

### 1.3 Captura del tema (screenshot.png)

WordPress usa un archivo `screenshot.png` en la raíz del tema para mostrar una vista previa en el panel de administración. Si no lo tienes, toma una captura de pantalla de `preview.html`, redimensiónala a exactamente **1200×900 px**, guárdala como PNG y colócala en `motocar-theme/screenshot.png`.

---

## Paso 2 — Crear el archivo ZIP

1. Asegúrate de que la carpeta `motocar-theme/` contiene todas las imágenes en `assets/img/`.
2. Haz clic derecho sobre la carpeta `motocar-theme` y selecciona "Comprimir en archivo ZIP".
3. Nómbralo `motocar-theme.zip`.

Al abrir el ZIP, la estructura debe verse así (la carpeta `motocar-theme/` como raíz, no los archivos sueltos):

```
motocar-theme.zip
└── motocar-theme/
    ├── style.css
    ├── functions.php
    ├── front-page.php
    ├── index.php
    ├── screenshot.png
    └── assets/
        ├── css/custom.css
        ├── js/main.js
        ├── js/translations.js
        └── img/(todas las imágenes)
```

---

## Paso 3 — Subir e instalar el tema en Hostinger

### 3.1 Acceder al panel de WordPress

Entra al panel de administración desde **Hostinger Panel → Websites → tu sitio → Admin Panel**, o directamente desde `https://tudominio.com/wp-admin`.

### 3.2 Subir el tema

1. Ve a **Apariencia → Temas**.
2. Haz clic en **Añadir nuevo tema** y luego en **Subir tema**.
3. Selecciona el archivo `motocar-theme.zip` y haz clic en **Instalar ahora**.
4. Cuando termine la instalación, haz clic en **Activar**.

### 3.3 Si el archivo es demasiado grande para subir (más de 2 MB)

En ese caso puedes usar el administrador de archivos de Hostinger:

1. Ve a **Hostinger Panel → Administrador de archivos**.
2. Navega hasta `public_html/wp-content/themes/`.
3. Sube `motocar-theme.zip` y extráelo ahí (clic derecho → Extraer).
4. Vuelve a WordPress, ve a **Apariencia → Temas** y activa "MotoCar Rentals".

---

## Paso 4 — Configuración inicial de WordPress

### 4.1 Configurar la página de inicio

Este paso es fundamental para que WordPress use el template `front-page.php` del tema:

1. Ve a **Páginas → Añadir nueva**, ponle de título "Inicio" y publícala (puede estar vacía, el contenido lo genera el tema).
2. Ve a **Ajustes → Lectura** y selecciona "Una página estática".
3. En "Página de inicio" elige la página "Inicio" que acabas de crear.
4. Guarda los cambios.

### 4.2 Configurar el logo

1. Ve a **Apariencia → Personalizar → Identidad del sitio**.
2. Sube el logo en "Logo del sitio".
3. Opcionalmente sube también un favicon en "Icono del sitio".
4. Haz clic en **Publicar**.

### 4.3 Configurar los enlaces permanentes

1. Ve a **Ajustes → Enlaces permanentes** y selecciona "Nombre de la entrada".
2. Guarda los cambios **dos veces** (sí, dos). Esto hace que WordPress regenere las reglas de reescritura y que el menú "Vehículos" aparezca correctamente en el panel lateral.

---

## Paso 5 — Crear los tipos de vehículo

Antes de agregar vehículos hay que crear las categorías del filtro:

1. Ve a **Vehículos → Tipos de Vehículo** en el menú lateral.
2. Crea la categoría "Carro" (el slug `carro` se genera automáticamente).
3. Crea la categoría "Moto" (slug: `moto`).

Es importante que los slugs sean exactamente `carro` y `moto` porque el filtro en la landing page depende de esos valores.

---

## Paso 6 — Agregar vehículos

Al activar el tema aparece un nuevo menú **Vehículos** en el panel de administración.

### 6.1 Cómo agregar un vehículo

1. Ve a **Vehículos → Agregar Vehículo**.
2. Escribe el nombre del vehículo como título (por ejemplo: "KIA Sportage").
3. En el campo de contenido, redacta una descripción breve del vehículo (1–2 párrafos). Este texto aparece en el modal cuando el usuario hace clic en "Reserva Ahora".
4. En la columna derecha, sube la foto principal como **Imagen destacada** y marca el **Tipo de Vehículo** correspondiente (Carro o Moto).
5. Debajo del editor aparece la sección **Datos del Vehículo**. Completa todos los campos:

| Campo | Ejemplo (Carro) | Ejemplo (Moto) | Nota |
|-------|-----------------|-----------------|------|
| Precio por día (COP) | 135000 | 75000 | Solo el número, sin puntos ni símbolo $ |
| Precio anterior (COP) | 180000 | 100000 | Opcional, para mostrar descuento |
| Modelo | Sportage | FZ-250 | Nombre del modelo |
| Año | 2025 | 2024 | — |
| Transmisión | automatica | manual | Seleccionar del dropdown |
| Pasajeros | 5 | 2 | — |
| Combustible | gasolina | gasolina | Seleccionar del dropdown |
| Aire Acondicionado | si | no | En motos se muestra como "ABS" |
| Cilindraje (CC) | 2000 | 250 | Solo el número |

6. Haz clic en **Publicar**.

### 6.2 Flota inicial sugerida

| Nombre | Tipo | Precio/día COP | Año | Transmisión | Pasajeros | Motor | Aire/ABS |
|--------|------|----------------|-----|-------------|-----------|-------|----------|
| Kia Sportage | Carro | 135.000 | 2025 | Automática | 5 | 2000 cc | Sí |
| Volkswagen Gol | Carro | 135.000 | 2024 | Manual | 5 | 1600 cc | Sí |
| Renault Logan | Carro | 95.000 | 2023 | Manual | 5 | 1600 cc | Sí |
| Yamaha FZ-250 | Moto | 75.000 | 2024 | Manual | 2 | 250 cc | Sí |
| Yamaha Aerox 155 | Moto | 55.000 | 2024 | Automática | 2 | 155 cc | Sí |

Mientras no haya al menos un vehículo publicado en WordPress, la landing muestra vehículos de demostración. Estos desaparecen automáticamente cuando se publican vehículos reales.

### 6.3 Consejos para las fotos de vehículos

- Usa un ángulo ¾ frontal que muestre tanto el frente como el costado del vehículo.
- Un fondo blanco o transparente (PNG) se integra mucho mejor con el diseño de las tarjetas. Puedes usar [remove.bg](https://www.remove.bg/) para quitar fondos.
- Tamaño mínimo de 800×600 px (ideal 1200×800 px).
- Formato `.webp` cuando sea posible, o `.jpg` como alternativa.
- Comprime cada foto para que no supere los 150 KB.
- Procura que todas las fotos tengan un estilo visual consistente.

---

## Paso 7 — Configurar WhatsApp y datos de contacto

### 7.1 Número de WhatsApp

El número de WhatsApp debe actualizarse en dos archivos:

En `assets/js/main.js`, busca esta línea y reemplaza el número:
```javascript
const phone = '573001234567';
```
Usa tu número real con código de país, sin el signo + y sin espacios (ejemplo: `573202161156`).

En `front-page.php`, busca el botón flotante de WhatsApp que aparece cerca del final del archivo:
```html
<a href="https://wa.me/573001234567?text=..."
```
Cambia el número por el mismo que usaste arriba.

### 7.2 Datos de contacto

En `front-page.php` encontrarás los datos de contacto que puedes personalizar: correo electrónico, teléfono, enlaces a redes sociales (Facebook, Instagram, TikTok) y dirección.

### 7.3 Tasa de cambio USD

El precio en dólares se calcula automáticamente a partir del precio en pesos. En `front-page.php`, busca el valor `3690` en esta línea:
```php
$precio_usd = number_format($precio_dia / 3690, 2, ',', '.');
```
Actualízalo a la tasa de cambio vigente cuando lo necesites.

---

## Paso 8 — Personalización visual

### 8.1 Cambiar colores

Los colores principales del sitio se controlan con variables CSS al inicio de `assets/css/custom.css`:
```css
:root {
    --mc-primary: #F5A623;      /* Naranja principal */
    --mc-primary-dark: #E09000; /* Naranja en hover */
    --mc-secondary: #1A1A1A;   /* Negro */
}
```
Basta con cambiar estos valores para que el color se aplique en todo el sitio.

### 8.2 Cambiar textos del hero

En `front-page.php`, busca la sección del hero y modifica el título:
```html
<h1 class="mc-hero__title">
    ¡Alquila la emoción,<br>
    vive la experiencia!
</h1>
```
La versión en inglés se controla desde `assets/js/translations.js`, buscando la clave `hero_title`.

### 8.3 Modificar slides del hero

Para agregar o quitar slides, edita la sección `mc-hero` en `front-page.php`. Cada slide es un `<div class="mc-hero__slide">` con su imagen de fondo. Recuerda agregar también el dot correspondiente y, si cambias la cantidad total, actualizar la lógica en `main.js`.

### 8.4 Cambiar los lugares de Antioquia

La galería de lugares turísticos está en la sección `mc-lugares` de `front-page.php`. Puedes cambiar los nombres, las descripciones y las imágenes de cada slide. Las traducciones al inglés de estos textos están en `translations.js`.

---

## Paso 9 — Optimización del sitio en Hostinger

### 9.1 Caché con LiteSpeed

Hostinger incluye soporte para LiteSpeed Cache. Para activarlo:

1. Ve a **Hostinger Panel → Rendimiento → Caché** y actívalo.
2. En WordPress, instala el plugin **LiteSpeed Cache** si no está ya instalado.
3. Desde **LiteSpeed Cache → General**, activa todas las opciones disponibles.
4. En **LiteSpeed Cache → Caché**, habilita la opción de caché.

### 9.2 Certificado SSL

1. En **Hostinger Panel → Seguridad → SSL**, activa el certificado gratuito de Let's Encrypt.
2. Marca la opción de forzar HTTPS para que todo el tráfico vaya cifrado.

### 9.3 Plugins recomendados

Estos son los únicos plugins que realmente necesitas al inicio:

| Plugin | Función |
|--------|---------|
| LiteSpeed Cache | Caché y optimización de rendimiento (ya viene con Hostinger) |
| UpdraftPlus | Copias de seguridad automáticas |
| Wordfence o Sucuri | Seguridad básica |
| ShortPixel o Imagify | Compresión automática de imágenes y conversión a WebP |

No instales plugins de slider, page builder ni plugins de SEO pesados. El tema ya trae todo lo necesario para funcionar.

---

## Paso 10 — Verificación final

Después de instalar y configurar todo, recorre esta lista para confirmar que el sitio funciona correctamente:

- [ ] La landing page carga sin errores
- [ ] El logo aparece en el header
- [ ] El hero slider rota automáticamente cada 5 segundos y los dots funcionan
- [ ] El menú de navegación hace scroll suave a cada sección
- [ ] El menú hamburguesa funciona correctamente en móvil
- [ ] El toggle Carro/Moto filtra las tarjetas de vehículos
- [ ] Las tarjetas muestran precio en COP y USD
- [ ] Al hacer clic en "Reserva Ahora" se abre el modal con la información del vehículo
- [ ] El botón "Ir a Cotizar" abre WhatsApp con el mensaje prellenado
- [ ] La galería de lugares de Antioquia funciona (flechas, dots y avance automático)
- [ ] La sección de marcas muestra los 6 logos (Renault, KIA, Volkswagen, Yamaha, Toyota, Suzuki)
- [ ] El botón flotante de WhatsApp funciona
- [ ] Los enlaces de redes sociales apuntan a las cuentas correctas
- [ ] El sitio se ve bien en un celular (probar en un dispositivo real)
- [ ] Las imágenes cargan rápidamente
- [ ] El candado verde de HTTPS está activo en el navegador
- [ ] El selector de idioma cambia correctamente entre español e inglés

---

## Flujo del usuario en el sitio

```
1. El usuario llega a la página
2. Ve el hero slider con 4 fotos que rotan automáticamente
3. Puede filtrar vehículos por tipo (Carro/Moto), precio y disponibilidad
4. Explora las tarjetas de vehículos con foto, precio (COP y USD) y especificaciones
5. Hace clic en "Reserva Ahora" y se abre un modal con:
   - Detalle completo del vehículo (foto, descripción, specs)
   - Formulario para elegir fechas, lugar de entrega/devolución y horarios
6. Al hacer clic en "Ir a Cotizar", se abre WhatsApp con un mensaje
   prellenado con todos los datos de la cotización
```

Mientras no haya vehículos publicados en WordPress, la landing muestra 5 vehículos de demostración. Cuando se publique al menos un vehículo real desde el administrador, los demo se reemplazan automáticamente.

---

## Solución de problemas

| Problema | Solución |
|----------|----------|
| No aparece el menú "Vehículos" en el panel | Ve a **Ajustes → Enlaces permanentes** y guarda dos veces |
| Las imágenes no cargan | Revisa que los nombres en `assets/img/` sean exactamente iguales (minúsculas, sin espacios) |
| El filtro no funciona | Verifica que las taxonomías "Carro" y "Moto" existan con slugs `carro` y `moto` |
| El modal no muestra datos del vehículo | Asegúrate de haber completado todos los campos en "Datos del Vehículo" |
| Error 500 al activar el tema | Confirma que el hosting tenga PHP 7.4 o superior (idealmente 8.0+) |
| Página en blanco | Ve a **Ajustes → Lectura** y configura una página estática como inicio |
| Las fuentes no cargan | Las tipografías se sirven desde Google Fonts; verifica la conexión a internet |
| WhatsApp no abre | Revisa que el número tenga el formato correcto: `57XXXXXXXXXX` sin + ni espacios |
| Los vehículos demo no desaparecen | Publica al menos un vehículo real desde el administrador |
| "El modal no muestra datos" | Verifica que llenaste TODOS los campos meta del vehículo |
| "Error 500 al activar tema" | Verifica que tu Hostinger tenga PHP 7.4+ (idealmente 8.0+) |
| "Página en blanco" | Ve a **Ajustes → Lectura** y configura "Una página estática" |
| "Las fuentes no cargan" | Verifica conexión a internet, las fuentes vienen de Google Fonts |
| "WhatsApp no abre" | Verifica que el número tenga formato correcto: `57XXXXXXXXXX` sin + ni espacios |
| "Los cards demo no desaparecen" | Necesitas publicar al menos 1 vehículo para que WP_Query reemplace los demo |

---

## Referencia rápida de archivos

| Necesitas cambiar... | Archivo |
|---------------------|---------|
| Textos, estructura HTML, secciones | `front-page.php` |
| Colores, tamaños, tipografía, animaciones | `assets/css/custom.css` |
| Sliders, modal, filtros, lógica de WhatsApp | `assets/js/main.js` |
| Traducciones al inglés | `assets/js/translations.js` |
| Campos de vehículos, funciones de WordPress | `functions.php` |
| Imágenes del hero, lugares o logos de marcas | `assets/img/` (reemplazar archivos) |
| Fotos de vehículos | Desde el panel de WordPress → Vehículos → Imagen destacada |

---

Con esto el sitio de MotoCar Rentals queda listo para funcionar en WordPress.
