# 🚗 MotoCar Rentals - Guía Completa de Instalación en WordPress (Hostinger)

> **Versión actualizada** con: cards con precios COP/USD, modal de cotización WhatsApp, galería de Rincones de Antioquia, tipografías Anton + Antic Didone, botones rectangulares redondeados.

---

## 📋 Estructura de archivos del tema

```
motocar-theme/
├── style.css                   ← Identificación del tema WP
├── functions.php               ← CPT Vehículos, taxonomía, meta boxes, AJAX
├── front-page.php              ← Template landing page completo (680 líneas)
├── index.php                   ← Fallback requerido por WP
├── screenshot.png              ← Vista previa del tema (1200x900 px)
└── assets/
    ├── css/
    │   └── custom.css          ← Todos los estilos (~1725 líneas)
    ├── js/
    │   └── main.js             ← Sliders, modal, filtros, WhatsApp (~380 líneas)
    └── img/                    ← Imágenes del tema (ver lista abajo)
        ├── logo.png
        ├── flag-es.png / flag-en.png
        ├── slide-1.jpg ... slide-4.jpg
        ├── santa-fe.jpg, guatape.jpg, jardin.jpg, jerico.jpg
        ├── brand-renault.png, brand-kia.png, etc.
        └── placeholder.jpg
```

### Archivos que NO se suben a WordPress:
- `preview.html` → Solo para previsualización local
- `GUIA-INSTALACION.md` → Esta guía
- Carpeta `Imágenes/` → Las fotos de vehículos se suben desde el admin de WP

---

## 🖼️ PASO 1: Preparar las imágenes del tema

Las imágenes del tema van en `motocar-theme/assets/img/`. Las fotos de vehículos **NO** van aquí (se suben desde WordPress).

### 1.1 Imágenes obligatorias

| Archivo | Qué es | Tamaño recomendado | De dónde sacarla |
|---------|--------|--------------------|--------------------|
| `logo.png` | Logo MotoCar (fondo transparente) | 200×60 px | Pide versión PNG con transparencia al diseñador |
| `flag-es.png` | Bandera Colombia para selector idioma | 24×16 px | Buscar "flag icon Colombia 24px" |
| `flag-en.png` | Bandera USA para selector idioma | 24×16 px | Buscar "flag icon USA 24px" |
| `slide-1.jpg` | Hero slide 1 | 1920×900 px | Foto de un vehículo en paisaje antioqueño |
| `slide-2.jpg` | Hero slide 2 | 1920×900 px | Otra foto atractiva |
| `slide-3.jpg` | Hero slide 3 | 1920×900 px | Puede ser moto en carretera |
| `slide-4.jpg` | Hero slide 4 | 1920×900 px | Paisaje con vehículo |
| `santa-fe.jpg` | Santa Fé de Antioquia | 600×400 px | Foto del pueblo o puente de occidente |
| `guatape.jpg` | Guatapé | 600×400 px | Piedra del Peñol o zócalos |
| `jardin.jpg` | Jardín | 600×400 px | Parque o paisaje |
| `jerico.jpg` | Jericó | 600×400 px | Vista del pueblo |
| `brand-renault.png` | Logo Renault | 120×60 px | Google "Renault logo PNG transparent" |
| `brand-kia.png` | Logo KIA | 120×60 px | Google "KIA logo PNG transparent" |
| `brand-volkswagen.png` | Logo Volkswagen | 120×60 px | Igual |
| `brand-yamaha.png` | Logo Yamaha | 120×60 px | Igual |
| `placeholder.jpg` | Imagen por defecto | 600×400 px | Foto genérica de carro gris |

### 1.2 Mejores prácticas para imágenes

| Aspecto | Recomendación |
|---------|---------------|
| **Formato** | `.webp` o `.jpg` para fotos, `.png` para logos con transparencia |
| **Compresión** | Usa [TinyPNG](https://tinypng.com/) o [Squoosh](https://squoosh.app/) |
| **Hero slides** | Máximo 200-300 KB cada una después de comprimir |
| **Fotos de vehículos** | Máximo 150 KB, formato `.webp` preferido |
| **Logos de marcas** | Máximo 20 KB |
| **Nombres** | Siempre en **minúsculas**, sin espacios, sin tildes |
| **Resolución** | 72 DPI es suficiente para web |

### 1.3 Imagen de captura del tema (`screenshot.png`)

WordPress necesita un `screenshot.png` en la raíz del tema para mostrar la vista previa:
- **Tamaño**: 1200×900 px exacto
- **Formato**: PNG
- Toma una captura de pantalla de tu `preview.html` y redimensiónala
- Guárdala como `motocar-theme/screenshot.png`

---

## 📦 PASO 2: Crear el archivo ZIP

1. Verifica que la carpeta `motocar-theme/` tiene **todas** las imágenes en `assets/img/`
2. **Clic derecho** en la carpeta `motocar-theme` → **Comprimir en archivo ZIP**
3. El archivo debe llamarse `motocar-theme.zip`
4. ⚠️ **Importante**: Al abrir el ZIP, la primera carpeta debe ser `motocar-theme/`, no los archivos sueltos

### Verificar estructura del ZIP:
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
        └── img/(todas las imágenes)
```

---

## 🚀 PASO 3: Subir e instalar el tema en Hostinger

### 3.1 Acceder al admin de WordPress
1. Ve a **Hostinger Panel** → **Websites** → tu sitio → **Admin Panel**
   - O ve directamente a `https://tudominio.com/wp-admin`
2. Inicia sesión con tus credenciales

### 3.2 Subir el tema
1. Ve a **Apariencia** → **Temas**
2. Clic en **Añadir nuevo tema** (botón arriba)
3. Clic en **Subir tema**
4. Clic en **Seleccionar archivo** → elige `motocar-theme.zip`
5. Clic en **Instalar ahora**
6. Espera a que termine → Clic en **Activar**

### 3.3 Si el ZIP es muy grande para subir (>2MB)
Usar el **Administrador de archivos de Hostinger**:
1. Ve a **Hostinger Panel** → **Administrador de archivos**
2. Navega a `public_html/wp-content/themes/`
3. Sube `motocar-theme.zip` ahí
4. Clic derecho → **Extraer**
5. Vuelve a WP Admin → **Apariencia** → **Temas** → Activa "MotoCar Rentals"

---

## ⚙️ PASO 4: Configuración inicial de WordPress

### 4.1 Configurar página de inicio (CRÍTICO)
1. Crea una página: ve a **Páginas** → **Añadir nueva** → Título: "Inicio" → **Publicar** (puede estar vacía)
2. Ve a **Ajustes** → **Lectura**
3. Selecciona **"Una página estática"**
4. En **"Página de inicio"**: selecciona "Inicio"
5. Clic en **Guardar cambios**

> 💡 El tema usa `front-page.php` que WordPress carga automáticamente cuando hay una página estática configurada.

### 4.2 Configurar el Logo
1. Ve a **Apariencia** → **Personalizar**
2. Clic en **Identidad del sitio**
3. Sube tu logo en **Logo del sitio**
4. También puedes subir un **Icono del sitio (favicon)** aquí
5. Clic en **Publicar**

### 4.3 Configurar los enlaces permanentes
1. Ve a **Ajustes** → **Enlaces permanentes**
2. Selecciona **"Nombre de la entrada"**
3. Clic en **Guardar cambios**
4. ⚠️ **Haz esto dos veces** (guardar dos veces) para que WordPress regenere las reglas de reescritura y el menú "Vehículos" aparezca.

---

## 🚗 PASO 5: Crear los tipos de vehículo (taxonomías)

Antes de crear vehículos, crea las categorías:

1. Ve a **Vehículos** → **Tipos de Vehículo** (en el menú lateral)
2. Crea **"Carro"**:
   - Nombre: `Carro`
   - Slug: `carro` (se genera automático)
   - Clic en **Añadir nuevo Tipo de Vehículo**
3. Crea **"Moto"**:
   - Nombre: `Moto`
   - Slug: `moto`
   - Clic en **Añadir nuevo Tipo de Vehículo**

> 💡 Los slugs `carro` y `moto` son los que usa el filtro toggle en la landing page. Deben ser exactamente así.

---

## 🚙 PASO 6: Agregar vehículos (el corazón del sitio)

En el admin de WP verás un nuevo menú **"Vehículos"** con ícono de carro 🚗.

### 6.1 Para cada vehículo:

1. Ve a **Vehículos** → **Agregar Vehículo**
2. **Título**: Nombre del vehículo (ej: "KIA Sportage")
3. **Contenido/Descripción**: Escribe una descripción atractiva del vehículo (1-2 párrafos). Esta aparece en el modal al hacer clic.
4. **Imagen destacada** (columna derecha): Sube la foto principal del vehículo
5. **Tipo de Vehículo** (columna derecha): Marca "Carro" o "Moto"
6. **Datos del Vehículo** (debajo del editor): Llena TODOS los campos:

| Campo | Ejemplo Carro | Ejemplo Moto | Notas |
|-------|--------------|--------------|-------|
| Precio por día (COP) | `135000` | `75000` | Solo número, sin puntos ni $ |
| Precio anterior (COP) | `180000` | `100000` | Para mostrar descuento (opcional) |
| Modelo | `Sportage` | `FZ-250` | Nombre del modelo |
| Año | `2025` | `2024` | Año del vehículo |
| Transmisión | `automatica` | `manual` | Seleccionar del dropdown |
| Pasajeros | `5` | `2` | Número de personas |
| Combustible | `gasolina` | `gasolina` | Seleccionar del dropdown |
| Aire Acondicionado | `si` | `no` | En motos muestra "ABS" en vez de "Aire" |
| Cilindraje (CC) | `2000` | `250` | Solo número |

7. Clic en **Publicar**

### 6.2 Vehículos sugeridos para empezar

| # | Nombre | Tipo | Precio/día | Año | Transmisión | Pasajeros | Motor | Aire/ABS |
|---|--------|------|-----------|-----|-------------|-----------|-------|----------|
| 1 | Kia Sportage | Carro | 135000 | 2025 | automatica | 5 | 2000 | si |
| 2 | Volkswagen Gol | Carro | 135000 | 2024 | manual | 5 | 1600 | si |
| 3 | Renault Logan | Carro | 95000 | 2023 | manual | 5 | 1600 | si |
| 4 | Yamaha FZ-250 | Moto | 75000 | 2024 | manual | 2 | 250 | si |
| 5 | Yamaha Aerox 155 | Moto | 55000 | 2024 | automatica | 2 | 155 | si |

### 6.3 Mejores prácticas para fotos de vehículos

| Aspecto | Recomendación |
|---------|---------------|
| **Ángulo** | Foto ¾ frontal (muestra frente y costado) |
| **Fondo** | Fondo blanco o transparente (`.png`) es ideal |
| **Tamaño** | 800×600 px mínimo, 1200×800 px ideal |
| **Formato** | `.webp` (mejor compresión) o `.jpg` |
| **Peso** | Máximo 150 KB después de comprimir |
| **Consistencia** | Todas las fotos con estilo similar (misma perspectiva) |

> 💡 **Truco**: Usa [remove.bg](https://www.remove.bg/) para quitar el fondo de las fotos de vehículos y guardar como PNG con transparencia. Se ve mucho más profesional en las tarjetas.

---

## 📱 PASO 7: Configurar WhatsApp y datos de contacto

### 7.1 Número de WhatsApp

Debes cambiar el número placeholder `573001234567` por tu número real en **DOS lugares**:

**Archivo `assets/js/main.js`** — Busca esta línea:
```javascript
const phone = '573001234567';
```
Cámbiala por tu número real con código de país (sin +, sin espacios):
```javascript
const phone = '57300XXXXXXX';
```

**Archivo `front-page.php`** — Busca el botón flotante de WhatsApp (cerca del final):
```html
<a href="https://wa.me/573001234567?text=..."
```
Cambia `573001234567` por tu número real.

### 7.2 Datos de contacto

En `front-page.php`, busca y cambia:

| Buscar | Cambiar por |
|--------|-------------|
| `motocarrentals@gmail.com` | Tu email real |
| `+57 300 123 4567` | Tu teléfono real |
| `info@motocarrentals.com` | Tu email del footer |
| Links de redes sociales (`href="#"`) | URLs reales de Facebook, Instagram, TikTok |

### 7.3 Tasa de cambio USD

En `front-page.php`, el precio en USD se calcula automáticamente:
```php
$precio_usd = number_format($precio_dia / 3690, 2, ',', '.');
```
Si necesitas actualizar la tasa de cambio, busca `3690` y cámbialo por la tasa actual.

---

## 🎨 PASO 8: Personalización visual

### 8.1 Cambiar colores
En `assets/css/custom.css`, modifica las variables CSS al inicio:
```css
:root {
    --mc-primary: #F5A623;      /* Naranja principal */
    --mc-primary-dark: #E09000; /* Naranja hover */
    --mc-secondary: #1A1A1A;   /* Negro */
}
```

### 8.2 Cambiar textos del Hero
En `front-page.php`, busca:
```html
<h1 class="mc-hero__title">
    ¡Alquila la emoción,<br>
    vive la experiencia!
</h1>
```

### 8.3 Agregar o quitar slides del Hero
En `front-page.php`, puedes agregar más `<div class="mc-hero__slide">` y sus correspondientes dots. También actualiza el contador en `main.js`.

### 8.4 Cambiar los lugares de Antioquia
En `front-page.php`, sección `mc-lugares`, cambia los nombres, descripciones e imágenes de cada slide.

---

## ⚡ PASO 9: Optimización para Hostinger (Mejores Prácticas)

### 9.1 Caché con LiteSpeed (Hostinger incluye esto)
1. Ve a **Hostinger Panel** → **Rendimiento** → **Caché**
2. Activa **LiteSpeed Cache**
3. En WP Admin instala el plugin **LiteSpeed Cache** si no está instalado
4. Ve a **LiteSpeed Cache** → **General** → Activa todo
5. Ve a **LiteSpeed Cache** → **Caché** → Activa "Habilitar caché"

### 9.2 SSL (HTTPS)
1. Ve a **Hostinger Panel** → **Seguridad** → **SSL**
2. Activa SSL gratuito (Let's Encrypt)
3. Activa "Forzar HTTPS"

### 9.3 Plugins recomendados (solo los necesarios)
| Plugin | Para qué |
|--------|----------|
| **LiteSpeed Cache** | Caché y optimización (viene con Hostinger) |
| **UpdraftPlus** | Backups automáticos |
| **Wordfence** o **Sucuri** | Seguridad básica |
| **WPForms Lite** | Si necesitas formulario de contacto adicional |

> ⚠️ **NO instales**: plugins de slider (ya tienes sliders propios), page builders (el tema ya tiene todo), plugins de SEO pesados al inicio.

### 9.4 Optimización de imágenes automática
1. Instala **ShortPixel** o **Imagify** (versión gratuita)
2. Comprime automáticamente todas las imágenes que subas
3. Activa conversión a WebP

---

## 🔧 PASO 10: Verificación final (Checklist)

Después de instalar, verifica que todo funcione:

- [ ] La landing page carga correctamente
- [ ] El logo aparece en el header
- [ ] El hero slider cambia automáticamente (cada 5 segundos)
- [ ] Los dots del hero funcionan al hacer clic
- [ ] El menú de navegación funciona (scroll suave a cada sección)
- [ ] El menú hamburguesa funciona en móvil
- [ ] El toggle Carro/Moto filtra las tarjetas
- [ ] Las tarjetas de vehículos muestran precio COP y USD
- [ ] Al hacer clic en "Reserva Ahora" se abre el modal
- [ ] El modal muestra la foto, specs y formulario de cotización
- [ ] El botón "Ir a Cotizar" abre WhatsApp con los datos prellenados
- [ ] La galería de Rincones de Antioquia funciona (flechas + dots)
- [ ] El auto-avance de la galería funciona (cada 6 segundos)
- [ ] El botón flotante de WhatsApp funciona
- [ ] Las redes sociales apuntan a los links correctos
- [ ] El sitio se ve bien en móvil (probar en celular real)
- [ ] Las imágenes cargan rápidamente
- [ ] HTTPS está activo (candado verde en el navegador)

---

## 💡 CÓMO FUNCIONA EL FLUJO DEL USUARIO

```
1. Usuario llega al sitio
   ↓
2. Ve el Hero Slider con las 4 fotos rotando (5 seg)
   ↓
3. Puede filtrar: Toggle Carro/Moto + Transmisión + Disponibilidad
   ↓
4. Ve las tarjetas de vehículos con:
   • Badge de pasajeros (esquina superior)
   • Foto del vehículo
   • Precio en COP y USD por día
   • Specs (Motor | Caja | Aire/ABS)
   ↓
5. Hace clic en "Reserva Ahora"
   ↓
6. Se abre el MODAL con:
   • Nombre + Año del vehículo (título Anton)
   • Foto grande + Descripción
   • Barra de specs (Motor, ABS, Pasajeros, Tipo)
   • Formulario: Fechas, Lugar entrega/devolución, Horas
   ↓
7. Hace clic en "Ir a Cotizar" con ícono WhatsApp
   ↓
8. Se abre WhatsApp con mensaje prellenado:
   "🚗 *COTIZACIÓN MOTOCAR RENTALS*
    Vehículo: KIA Sportage
    Fechas: 2025-01-15
    Lugar Entrega: Aeropuerto
    ..."
```

### Sin vehículos creados en WP:
La landing muestra **5 vehículos demo** hardcodeados. Cuando publiques vehículos desde el admin, **automáticamente reemplazarán** los demo.

---

## 🆘 Solución de problemas comunes

| Problema | Solución |
|----------|----------|
| "No se ve el menú Vehículos" | Ve a **Ajustes → Enlaces permanentes** y dale **Guardar** dos veces |
| "Las imágenes no cargan" | Verifica que los nombres en `assets/img/` coincidan exactamente (minúsculas, sin espacios) |
| "El filtro no funciona" | Asegúrate de haber creado las taxonomías "Carro" y "Moto" con slugs `carro` y `moto` |
| "El modal no muestra datos" | Verifica que llenaste TODOS los campos meta del vehículo |
| "Error 500 al activar tema" | Verifica que tu Hostinger tenga PHP 7.4+ (idealmente 8.0+) |
| "Página en blanco" | Ve a **Ajustes → Lectura** y configura "Una página estática" |
| "Las fuentes no cargan" | Verifica conexión a internet, las fuentes vienen de Google Fonts |
| "WhatsApp no abre" | Verifica que el número tenga formato correcto: `57XXXXXXXXXX` sin + ni espacios |
| "Los cards demo no desaparecen" | Necesitas publicar al menos 1 vehículo para que WP_Query reemplace los demo |

---

## 📂 Archivos para editar según lo que necesites

| Quiero cambiar... | Archivo a editar |
|-------------------|-----------------|
| Textos, secciones, estructura HTML | `front-page.php` |
| Colores, tamaños, tipografía, animaciones | `assets/css/custom.css` |
| Sliders, modal, filtros, WhatsApp | `assets/js/main.js` |
| Campos de vehículos, funciones PHP | `functions.php` |
| Imágenes del hero/lugares/logos | `assets/img/` (reemplazar archivos) |
| Fotos de vehículos | Desde WP Admin → Vehículos → Imagen destacada |

---

**¡Listo! Tu sitio MotoCar Rentals está preparado para subir a WordPress.** 🎉
