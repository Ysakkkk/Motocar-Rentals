<?php
/**
 * MotoCar Rentals - functions.php
 * Tema personalizado para alquiler de vehículos
 */

// ==========================================
// CONFIGURACIÓN INICIAL DEL TEMA
// ==========================================
function motocar_setup() {
    // Soporte para título dinámico
    add_theme_support('title-tag');

    // Soporte para imágenes destacadas
    add_theme_support('post-thumbnails');

    // Soporte para logo personalizado
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Registrar menú de navegación
    register_nav_menus(array(
        'primary' => __('Menú Principal', 'motocar-rentals'),
    ));

    // Soporte HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'motocar_setup');

// ==========================================
// CARGAR ESTILOS Y SCRIPTS
// ==========================================
function motocar_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Antic+Didone&family=Anton&display=swap', array(), null);

    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');

    // Flatpickr
    wp_enqueue_style('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css', array(), '4.6.13');
    wp_enqueue_script('flatpickr', 'https://cdn.jsdelivr.net/npm/flatpickr', array(), '4.6.13', true);
    wp_enqueue_script('flatpickr-es', 'https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js', array('flatpickr'), '4.6.13', true);

    // Estilo principal del tema
    wp_enqueue_style('motocar-style', get_stylesheet_uri(), array(), '1.0');

    // CSS personalizado
    wp_enqueue_style('motocar-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0');

    // JavaScript personalizado
    wp_enqueue_script('motocar-translations', get_template_directory_uri() . '/assets/js/translations.js', array(), '1.0', true);
    wp_enqueue_script('motocar-main', get_template_directory_uri() . '/assets/js/main.js', array('motocar-translations'), '1.0', true);

    // Pasar datos de PHP a JS
    wp_localize_script('motocar-main', 'motocarData', array(
        'ajaxUrl'  => admin_url('admin-ajax.php'),
        'themeUrl' => get_template_directory_uri(),
        'siteUrl'  => home_url(),
        'nonce'    => wp_create_nonce('motocar_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'motocar_scripts');

// ==========================================
// DESACTIVAR ESTILOS DE BLOQUES DE WORDPRESS
// (Evita conflictos con el diseño personalizado)
// ==========================================
function motocar_dequeue_block_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'motocar_dequeue_block_styles', 100);

// ==========================================
// CUSTOM POST TYPE: VEHÍCULOS
// ==========================================
function motocar_register_vehicles() {
    $labels = array(
        'name'               => 'Vehículos',
        'singular_name'      => 'Vehículo',
        'menu_name'          => 'Vehículos',
        'add_new'            => 'Agregar Vehículo',
        'add_new_item'       => 'Agregar Nuevo Vehículo',
        'edit_item'          => 'Editar Vehículo',
        'new_item'           => 'Nuevo Vehículo',
        'view_item'          => 'Ver Vehículo',
        'search_items'       => 'Buscar Vehículos',
        'not_found'          => 'No se encontraron vehículos',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => false,
        'menu_icon'          => 'dashicons-car',
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => true,
    );

    register_post_type('vehiculo', $args);

    // Taxonomía: Categoría de vehículo
    register_taxonomy('categoria_vehiculo', 'vehiculo', array(
        'labels' => array(
            'name'          => 'Categoría de Vehículo',
            'singular_name' => 'Categoría',
            'menu_name'     => 'Categorías',
            'all_items'     => 'Todas las Categorías',
            'edit_item'     => 'Editar Categoría',
            'add_new_item'  => 'Agregar Categoría',
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
    ));
}
add_action('init', 'motocar_register_vehicles');

// ==========================================
// CREAR CATEGORÍAS POR DEFECTO AL ACTIVAR TEMA
// ==========================================
function motocar_create_default_categories() {
    $categories = array(
        'economy'  => array('name' => 'Hatchback',     'desc' => 'Volkswagen Gol o similar'),
        'compact'  => array('name' => 'Sedan',          'desc' => 'Renault Logan o similar'),
        'suv'      => array('name' => 'SUV Compacto',   'desc' => 'Kia Seltos o similar'),
        'suv7'     => array('name' => 'SUV 7 Puestos',  'desc' => 'Toyota Fortuner o similar'),
        'motos'    => array('name' => 'Motocicletas',   'desc' => 'Yamaha FZ 150 o similar'),
    );
    foreach ($categories as $slug => $cat) {
        $existing_term = get_term_by('slug', $slug, 'categoria_vehiculo');
        if (!$existing_term) {
            wp_insert_term($cat['name'], 'categoria_vehiculo', array(
                'slug'        => $slug,
                'description' => $cat['desc'],
            ));
            continue;
        }

        $needs_name_update = $existing_term->name !== $cat['name'];
        $needs_desc_update = $existing_term->description !== $cat['desc'];

        if ($needs_name_update || $needs_desc_update) {
            wp_update_term($existing_term->term_id, 'categoria_vehiculo', array(
                'name'        => $cat['name'],
                'description' => $cat['desc'],
            ));
        }
    }
}
add_action('after_switch_theme', 'motocar_create_default_categories');
// Also run on init to ensure categories exist
add_action('init', function() {
    if (did_action('after_switch_theme')) return;
    motocar_create_default_categories();
}, 20);

// ==========================================
// META BOXES PARA VEHÍCULOS
// ==========================================
function motocar_vehicle_meta_boxes() {
    add_meta_box(
        'vehicle_category_info',
        '⚠️ IMPORTANTE — Categoría del Vehículo',
        'motocar_category_info_callback',
        'vehiculo',
        'side',
        'high'
    );
    add_meta_box(
        'vehicle_details',
        '🚗 Detalles del Vehículo',
        'motocar_vehicle_meta_callback',
        'vehiculo',
        'normal',
        'high'
    );
    add_meta_box(
        'vehicle_gallery',
        '📸 Galería de Imágenes',
        'motocar_gallery_meta_callback',
        'vehiculo',
        'normal',
        'high'
    );
    add_meta_box(
        'vehicle_availability',
        '📅 Fechas No Disponibles',
        'motocar_availability_meta_callback',
        'vehiculo',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'motocar_vehicle_meta_boxes');

// Info box para categoría
function motocar_category_info_callback($post) {
    ?>
    <div style="background: #fff3cd; border: 1px solid #ffc107; border-radius: 6px; padding: 12px; margin-bottom: 10px;">
        <p style="margin: 0 0 8px; font-weight: 700; color: #856404;">⚠️ Asigna una categoría al vehículo</p>
        <p style="margin: 0; font-size: 12px; color: #856404;">
            Selecciona la categoría en el panel <strong>"Categoría de Vehículo"</strong> de la derecha.
            <br><br>
            <strong>Categorías disponibles:</strong><br>
            • <strong>Economy Car</strong> — Vehículos económicos<br>
            • <strong>Compact Car</strong> — Sedanes compactos<br>
            • <strong>Compact SUV</strong> — Camionetas y SUVs<br>
            • <strong>Motorcycles</strong> — Motos
        </p>
    </div>
    <div style="background: #d1ecf1; border: 1px solid #17a2b8; border-radius: 6px; padding: 12px;">
        <p style="margin: 0 0 8px; font-weight: 700; color: #0c5460;">📸 Requisitos de Imágenes</p>
        <p style="margin: 0; font-size: 12px; color: #0c5460;">
            <strong>Imagen Destacada (obligatoria):</strong><br>
            • Resolución mínima: 800×500px<br>
            • Fondo transparente (PNG) recomendado<br>
            • Vista lateral del vehículo<br><br>
            <strong>Galería (2-4 imágenes):</strong><br>
            • Interior, ángulo frontal, trasero<br>
            • Resolución mínima: 600×400px<br>
            • Formatos: JPG, PNG, WebP
        </p>
    </div>
    <?php
}

function motocar_vehicle_meta_callback($post) {
    wp_nonce_field('motocar_vehicle_nonce', 'motocar_vehicle_nonce_field');

    $precio_dia = get_post_meta($post->ID, '_precio_dia', true);
    $precio_anterior = get_post_meta($post->ID, '_precio_anterior', true);
    $modelo = get_post_meta($post->ID, '_modelo', true);
    $ano = get_post_meta($post->ID, '_ano', true);
    $transmision = get_post_meta($post->ID, '_transmision', true);
    $pasajeros = get_post_meta($post->ID, '_pasajeros', true);
    $combustible = get_post_meta($post->ID, '_combustible', true);
    $aire_acondicionado = get_post_meta($post->ID, '_aire_acondicionado', true);
    $cilindrada = get_post_meta($post->ID, '_cilindrada', true);
    $maletas = get_post_meta($post->ID, '_maletas', true);
    ?>
    <style>
        .vehicle-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .vehicle-meta-field { margin-bottom: 10px; }
        .vehicle-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; }
        .vehicle-meta-field input, .vehicle-meta-field select { width: 100%; padding: 8px; }
        .vehicle-meta-field .field-hint { font-size: 11px; color: #666; margin-top: 3px; }
    </style>
    <div class="vehicle-meta-grid">
        <div class="vehicle-meta-field">
            <label>💲 Precio por día (COP) *</label>
            <input type="number" name="precio_dia" value="<?php echo esc_attr($precio_dia); ?>" placeholder="Ej: 135000" required>
            <p class="field-hint">Precio actual que se muestra al cliente</p>
        </div>
        <div class="vehicle-meta-field">
            <label>💲 Precio anterior (COP) — tachado:</label>
            <input type="number" name="precio_anterior" value="<?php echo esc_attr($precio_anterior); ?>" placeholder="Ej: 180000">
            <p class="field-hint">Déjalo vacío si no hay descuento</p>
        </div>
        <div class="vehicle-meta-field">
            <label>🚘 Modelo:</label>
            <input type="text" name="modelo" value="<?php echo esc_attr($modelo); ?>" placeholder="Ej: Sportage">
        </div>
        <div class="vehicle-meta-field">
            <label>📅 Año:</label>
            <input type="number" name="ano" value="<?php echo esc_attr($ano); ?>" placeholder="Ej: 2024">
        </div>
        <div class="vehicle-meta-field">
            <label>⚙️ Transmisión *</label>
            <select name="transmision">
                <option value="">— Seleccionar —</option>
                <option value="manual" <?php selected($transmision, 'manual'); ?>>Manual</option>
                <option value="automatica" <?php selected($transmision, 'automatica'); ?>>Automatic</option>
            </select>
        </div>
        <div class="vehicle-meta-field">
            <label>👥 Pasajeros *</label>
            <input type="number" name="pasajeros" value="<?php echo esc_attr($pasajeros); ?>" placeholder="Ej: 5" min="1" max="12">
        </div>
        <div class="vehicle-meta-field">
            <label>⛽ Combustible:</label>
            <select name="combustible">
                <option value="gasolina" <?php selected($combustible, 'gasolina'); ?>>Gasolina</option>
                <option value="diesel" <?php selected($combustible, 'diesel'); ?>>Diésel</option>
                <option value="electrico" <?php selected($combustible, 'electrico'); ?>>Eléctrico</option>
                <option value="hibrido" <?php selected($combustible, 'hibrido'); ?>>Híbrido</option>
            </select>
        </div>
        <div class="vehicle-meta-field">
            <label>❄️ Aire Acondicionado:</label>
            <select name="aire_acondicionado">
                <option value="si" <?php selected($aire_acondicionado, 'si'); ?>>Sí</option>
                <option value="no" <?php selected($aire_acondicionado, 'no'); ?>>No</option>
            </select>
        </div>
        <div class="vehicle-meta-field">
            <label>🔧 Motor / Cilindraje:</label>
            <input type="text" name="cilindrada" value="<?php echo esc_attr($cilindrada); ?>" placeholder="Ej: 2000 cc ó 250 cc">
            <p class="field-hint">Para carros: 1600cc, 2000cc. Para motos: 150cc, 250cc</p>
        </div>
        <div class="vehicle-meta-field">
            <label>🧳 Capacidad Maletas:</label>
            <input type="text" name="maletas" value="<?php echo esc_attr($maletas); ?>" placeholder="Ej: 2 large, 1 medium">
            <p class="field-hint">Descripción de capacidad de equipaje</p>
        </div>
    </div>
    <?php
}

// Gallery meta box
function motocar_gallery_meta_callback($post) {
    wp_enqueue_media();
    $gallery = get_post_meta($post->ID, '_vehicle_gallery', true);
    $gallery_ids = !empty($gallery) ? explode(',', $gallery) : array();
    ?>
    <style>
        .gallery-preview { display: flex; flex-wrap: wrap; gap: 10px; margin: 10px 0; }
        .gallery-preview .gallery-thumb { width: 120px; height: 80px; object-fit: cover; border-radius: 6px; border: 2px solid #ddd; }
        .gallery-preview .gallery-item { position: relative; }
        .gallery-preview .gallery-remove { position: absolute; top: -6px; right: -6px; background: #dc3545; color: #fff; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; font-size: 12px; line-height: 1; }
    </style>
    <div style="background: #f0f6fc; border: 1px solid #0073aa; border-radius: 6px; padding: 12px; margin-bottom: 14px;">
        <p style="margin: 0; font-size: 12px; color: #0c5460;">
            📸 Agrega 2-4 imágenes adicionales del vehículo (interior, otros ángulos, detalles).<br>
            Estas imágenes aparecerán en el carrusel de la categoría y en el detalle del vehículo.<br>
            <strong>La Imagen Destacada</strong> (panel derecho) será la imagen principal del vehículo.
        </p>
    </div>
    <input type="hidden" name="vehicle_gallery" id="vehicle_gallery" value="<?php echo esc_attr($gallery); ?>">
    <div class="gallery-preview" id="galleryPreview">
        <?php foreach ($gallery_ids as $img_id) :
            $img_url = wp_get_attachment_image_url(intval($img_id), 'thumbnail');
            if ($img_url) : ?>
            <div class="gallery-item" data-id="<?php echo esc_attr($img_id); ?>">
                <img src="<?php echo esc_url($img_url); ?>" class="gallery-thumb">
                <button type="button" class="gallery-remove" onclick="mcRemoveGalleryImage(this)">×</button>
            </div>
        <?php endif; endforeach; ?>
    </div>
    <button type="button" class="button button-secondary" id="addGalleryImages">+ Add Gallery Images</button>
    <script>
    (function() {
        var frame;
        document.getElementById('addGalleryImages').addEventListener('click', function(e) {
            e.preventDefault();
            if (frame) { frame.open(); return; }
            frame = wp.media({ title: 'Select Gallery Images', multiple: true, library: { type: 'image' } });
            frame.on('select', function() {
                var attachments = frame.state().get('selection').toJSON();
                var input = document.getElementById('vehicle_gallery');
                var preview = document.getElementById('galleryPreview');
                var ids = input.value ? input.value.split(',') : [];
                attachments.forEach(function(att) {
                    if (ids.indexOf(String(att.id)) === -1) {
                        ids.push(att.id);
                        var div = document.createElement('div');
                        div.className = 'gallery-item';
                        div.setAttribute('data-id', att.id);
                        var url = att.sizes && att.sizes.thumbnail ? att.sizes.thumbnail.url : att.url;
                        div.innerHTML = '<img src="' + url + '" class="gallery-thumb"><button type="button" class="gallery-remove" onclick="mcRemoveGalleryImage(this)">×</button>';
                        preview.appendChild(div);
                    }
                });
                input.value = ids.join(',');
            });
            frame.open();
        });
    })();
    function mcRemoveGalleryImage(btn) {
        var item = btn.parentElement;
        var id = item.getAttribute('data-id');
        var input = document.getElementById('vehicle_gallery');
        var ids = input.value.split(',').filter(function(i) { return i !== id; });
        input.value = ids.join(',');
        item.remove();
    }
    </script>
    <?php
}

function motocar_availability_meta_callback($post) {
    $fechas_no_disponibles = get_post_meta($post->ID, '_fechas_no_disponibles', true);
    if (!is_array($fechas_no_disponibles)) {
        $fechas_no_disponibles = array();
    }
    ?>
    <style>
        .fechas-nd-container { margin-top: 10px; }
        .fecha-nd-row { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; padding: 8px 12px; background: #f9f9f9; border-radius: 6px; }
        .fecha-nd-row label { font-weight: 600; min-width: 50px; }
        .fecha-nd-row input[type="date"] { padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; }
        .fecha-nd-row input[type="text"] { padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; flex: 1; }
        .fecha-nd-remove { background: #dc3545; color: #fff; border: none; border-radius: 4px; padding: 6px 12px; cursor: pointer; font-size: 13px; }
        .fecha-nd-remove:hover { background: #c82333; }
        #addFechaND { background: #0073aa; color: #fff; border: none; border-radius: 4px; padding: 8px 16px; cursor: pointer; margin-top: 8px; font-size: 13px; }
        #addFechaND:hover { background: #005a87; }
    </style>
    <p style="color: #666; margin-bottom: 10px;">Agrega los rangos de fechas en que este vehículo NO estará disponible (reservas, mantenimiento, etc.).</p>
    <div class="fechas-nd-container" id="fechasNDContainer">
        <?php foreach ($fechas_no_disponibles as $i => $rango) : ?>
        <div class="fecha-nd-row">
            <label>Desde:</label>
            <input type="date" name="fecha_nd_inicio[]" value="<?php echo esc_attr($rango['inicio']); ?>">
            <label>Hasta:</label>
            <input type="date" name="fecha_nd_fin[]" value="<?php echo esc_attr($rango['fin']); ?>">
            <label>Motivo:</label>
            <input type="text" name="fecha_nd_motivo[]" value="<?php echo esc_attr($rango['motivo'] ?? ''); ?>" placeholder="Ej: Reservado, Mantenimiento">
            <button type="button" class="fecha-nd-remove" onclick="this.parentElement.remove();">✕</button>
        </div>
        <?php endforeach; ?>
    </div>
    <button type="button" id="addFechaND">+ Agregar rango de fechas</button>
    <script>
    document.getElementById('addFechaND').addEventListener('click', function() {
        var row = document.createElement('div');
        row.className = 'fecha-nd-row';
        row.innerHTML = '<label>Desde:</label>' +
            '<input type="date" name="fecha_nd_inicio[]">' +
            '<label>Hasta:</label>' +
            '<input type="date" name="fecha_nd_fin[]">' +
            '<label>Motivo:</label>' +
            '<input type="text" name="fecha_nd_motivo[]" placeholder="Ej: Reservado, Mantenimiento">' +
            '<button type="button" class="fecha-nd-remove" onclick="this.parentElement.remove();">✕</button>';
        document.getElementById('fechasNDContainer').appendChild(row);
    });
    </script>
    <?php
}

function motocar_save_vehicle_meta($post_id) {
    if (!isset($_POST['motocar_vehicle_nonce_field']) || !wp_verify_nonce($_POST['motocar_vehicle_nonce_field'], 'motocar_vehicle_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    $fields = array('precio_dia', 'precio_anterior', 'modelo', 'ano', 'transmision', 'pasajeros', 'combustible', 'aire_acondicionado', 'cilindrada', 'maletas');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }

    // Gallery
    if (isset($_POST['vehicle_gallery'])) {
        update_post_meta($post_id, '_vehicle_gallery', sanitize_text_field($_POST['vehicle_gallery']));
    }

    // Guardar fechas no disponibles
    if (isset($_POST['fecha_nd_inicio']) && is_array($_POST['fecha_nd_inicio'])) {
        $fechas = array();
        $inicios = $_POST['fecha_nd_inicio'];
        $fines = $_POST['fecha_nd_fin'];
        $motivos = $_POST['fecha_nd_motivo'];
        for ($i = 0; $i < count($inicios); $i++) {
            $inicio = sanitize_text_field($inicios[$i]);
            $fin = sanitize_text_field($fines[$i]);
            if (!empty($inicio) && !empty($fin)) {
                $fechas[] = array(
                    'inicio' => $inicio,
                    'fin'    => $fin,
                    'motivo' => sanitize_text_field($motivos[$i] ?? ''),
                );
            }
        }
        update_post_meta($post_id, '_fechas_no_disponibles', $fechas);
    } else {
        update_post_meta($post_id, '_fechas_no_disponibles', array());
    }
}
add_action('save_post_vehiculo', 'motocar_save_vehicle_meta');

// ==========================================
// TAXONOMY META: CATEGORÍA DE VEHÍCULO
// ==========================================
function motocar_categoria_edit_fields($term) {
    $tid         = $term->term_id;
    $precio_dia  = get_term_meta($tid, '_precio_dia',  true);
    $descripcion = get_term_meta($tid, '_descripcion', true);
    $motor       = get_term_meta($tid, '_motor',       true);
    $transmision = get_term_meta($tid, '_transmision', true);
    $pasajeros   = get_term_meta($tid, '_pasajeros',   true);
    $abs         = get_term_meta($tid, '_abs',         true);
    $maletas     = get_term_meta($tid, '_maletas',     true);
    ?>
    <tr class="form-field">
        <th><label for="cat_precio_dia">💲 Precio por día (COP)</label></th>
        <td><input type="number" id="cat_precio_dia" name="cat_precio_dia" value="<?php echo esc_attr($precio_dia); ?>" placeholder="Ej: 135000"></td>
    </tr>
    <tr class="form-field">
        <th><label for="cat_descripcion">📝 Descripción (modal)</label></th>
        <td><textarea id="cat_descripcion" name="cat_descripcion" rows="3" placeholder="Breve descripción para el modal"><?php echo esc_textarea($descripcion); ?></textarea></td>
    </tr>
    <tr class="form-field">
        <th><label for="cat_motor">⚙️ Motor / Cilindraje</label></th>
        <td><input type="text" id="cat_motor" name="cat_motor" value="<?php echo esc_attr($motor); ?>" placeholder="Ej: 2000 cc"></td>
    </tr>
    <tr class="form-field">
        <th><label for="cat_transmision">🔧 Transmisión</label></th>
        <td>
            <select id="cat_transmision" name="cat_transmision">
                <option value="">— Seleccionar —</option>
                <option value="Manual" <?php selected($transmision, 'Manual'); ?>>Manual</option>
                <option value="Automática" <?php selected($transmision, 'Automática'); ?>>Automática</option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th><label for="cat_pasajeros">👥 Pasajeros</label></th>
        <td><input type="number" id="cat_pasajeros" name="cat_pasajeros" value="<?php echo esc_attr($pasajeros); ?>" placeholder="Ej: 5" min="1" max="20"></td>
    </tr>
    <tr class="form-field">
        <th><label for="cat_abs">🛑 ABS</label></th>
        <td>
            <select id="cat_abs" name="cat_abs">
                <option value="">— Seleccionar —</option>
                <option value="Sí" <?php selected($abs, 'Sí'); ?>>Sí</option>
                <option value="No" <?php selected($abs, 'No'); ?>>No</option>
            </select>
        </td>
    </tr>
    <tr class="form-field">
        <th><label for="cat_maletas">🧳 Maletas</label></th>
        <td><input type="text" id="cat_maletas" name="cat_maletas" value="<?php echo esc_attr($maletas); ?>" placeholder="Ej: 2 grandes, 1 mediana"></td>
    </tr>
    <?php
}
add_action('categoria_vehiculo_edit_form_fields', 'motocar_categoria_edit_fields', 10, 1);

function motocar_save_categoria_meta($term_id) {
    $fields = array('precio_dia', 'descripcion', 'motor', 'transmision', 'pasajeros', 'abs', 'maletas');
    foreach ($fields as $f) {
        if (isset($_POST['cat_' . $f])) {
            update_term_meta($term_id, '_' . $f, sanitize_text_field($_POST['cat_' . $f]));
        }
    }
}
add_action('edited_categoria_vehiculo', 'motocar_save_categoria_meta');

// ==========================================
// AJAX: OBTENER VEHÍCULOS POR CATEGORÍA
// ==========================================
function motocar_get_category_vehicles() {
    check_ajax_referer('motocar_nonce', 'nonce');

    $category_slug = sanitize_text_field($_POST['category'] ?? '');
    if (empty($category_slug)) {
        wp_send_json_error('Missing category');
    }

    $args = array(
        'post_type'      => 'vehiculo',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'tax_query'      => array(
            array(
                'taxonomy' => 'categoria_vehiculo',
                'field'    => 'slug',
                'terms'    => $category_slug,
            ),
        ),
        'meta_key'       => '_precio_dia',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
    );

    $query = new WP_Query($args);
    $vehicles = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $thumbnail = get_the_post_thumbnail_url($id, 'large');
            $gallery_raw = get_post_meta($id, '_vehicle_gallery', true);
            $gallery_images = array();
            if (!empty($gallery_raw)) {
                $gids = explode(',', $gallery_raw);
                foreach ($gids as $gid) {
                    $url = wp_get_attachment_image_url(intval($gid), 'medium');
                    if ($url) $gallery_images[] = $url;
                }
            }

            $vehicles[] = array(
                'id'              => $id,
                'nombre'          => html_entity_decode(get_the_title(), ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                'descripcion'     => wp_strip_all_tags(apply_filters('the_content', get_the_content())),
                'imagen'          => $thumbnail ?: '',
                'gallery'         => $gallery_images,
                'precio_dia'      => get_post_meta($id, '_precio_dia', true),
                'precio_anterior' => get_post_meta($id, '_precio_anterior', true),
                'modelo'          => get_post_meta($id, '_modelo', true),
                'ano'             => get_post_meta($id, '_ano', true),
                'transmision'     => get_post_meta($id, '_transmision', true),
                'pasajeros'       => get_post_meta($id, '_pasajeros', true),
                'combustible'     => get_post_meta($id, '_combustible', true),
                'aire'            => get_post_meta($id, '_aire_acondicionado', true),
                'cilindrada'      => get_post_meta($id, '_cilindrada', true),
                'maletas'         => get_post_meta($id, '_maletas', true),
                'fechas_no_disponibles' => (array) (get_post_meta($id, '_fechas_no_disponibles', true) ?: array()),
            );
        }
        wp_reset_postdata();
    }

    wp_send_json_success($vehicles);
}
add_action('wp_ajax_get_category_vehicles', 'motocar_get_category_vehicles');
add_action('wp_ajax_nopriv_get_category_vehicles', 'motocar_get_category_vehicles');

// ==========================================
// AJAX: OBTENER DATOS DE CATEGORÍA (modal)
// ==========================================
function motocar_get_category_data() {
    check_ajax_referer('motocar_nonce', 'nonce');
    $slug = sanitize_text_field($_POST['category'] ?? '');
    if (empty($slug)) { wp_send_json_error('Missing category'); }

    $term = get_term_by('slug', $slug, 'categoria_vehiculo');
    if (!$term) { wp_send_json_error('Category not found'); }

    $tid = $term->term_id;

    $query = new WP_Query(array(
        'post_type'      => 'vehiculo',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'tax_query'      => array(array(
            'taxonomy' => 'categoria_vehiculo',
            'field'    => 'slug',
            'terms'    => $slug,
        )),
        'meta_key'  => '_precio_dia',
        'orderby'   => 'meta_value_num',
        'order'     => 'ASC',
    ));

    $imagenes = array();
    $fechas_bloqueadas = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id    = get_the_ID();
            $thumb = get_the_post_thumbnail_url($id, 'large');
            if ($thumb) $imagenes[] = $thumb;
            $vf = (array) (get_post_meta($id, '_fechas_no_disponibles', true) ?: array());
            $fechas_bloqueadas = array_merge($fechas_bloqueadas, $vf);
        }
        wp_reset_postdata();
    }

    $precio_dia = get_term_meta($tid, '_precio_dia', true);
    wp_send_json_success(array(
        'nombre'                => html_entity_decode($term->name, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
        'descripcion'           => get_term_meta($tid, '_descripcion', true) ?: '',
        'precio_dia'            => $precio_dia ? intval($precio_dia) : 0,
        'motor'                 => get_term_meta($tid, '_motor',       true) ?: '',
        'transmision'           => get_term_meta($tid, '_transmision', true) ?: '',
        'pasajeros'             => get_term_meta($tid, '_pasajeros',   true) ?: '',
        'abs'                   => get_term_meta($tid, '_abs',         true) ?: '',
        'maletas'               => get_term_meta($tid, '_maletas',     true) ?: '',
        'imagenes'              => $imagenes,
        'fechas_no_disponibles' => $fechas_bloqueadas,
    ));
}
add_action('wp_ajax_get_category_data',        'motocar_get_category_data');
add_action('wp_ajax_nopriv_get_category_data', 'motocar_get_category_data');

// ==========================================
// AJAX: OBTENER DATOS DEL VEHÍCULO
// ==========================================
function motocar_get_vehicle_data() {
    check_ajax_referer('motocar_nonce', 'nonce');

    $vehicle_id = intval($_POST['vehicle_id']);
    $vehicle = get_post($vehicle_id);

    if (!$vehicle) {
        wp_send_json_error('Vehículo no encontrado');
    }

    $thumbnail = get_the_post_thumbnail_url($vehicle_id, 'large');

    $data = array(
        'id'          => $vehicle_id,
        'nombre'      => $vehicle->post_title,
        'descripcion' => wp_strip_all_tags(apply_filters('the_content', $vehicle->post_content)),
        'imagen'      => $thumbnail ?: '',
        'precio_dia'  => get_post_meta($vehicle_id, '_precio_dia', true),
        'precio_anterior' => get_post_meta($vehicle_id, '_precio_anterior', true),
        'modelo'      => get_post_meta($vehicle_id, '_modelo', true),
        'ano'         => get_post_meta($vehicle_id, '_ano', true),
        'transmision' => get_post_meta($vehicle_id, '_transmision', true),
        'pasajeros'   => get_post_meta($vehicle_id, '_pasajeros', true),
        'combustible' => get_post_meta($vehicle_id, '_combustible', true),
        'aire'        => get_post_meta($vehicle_id, '_aire_acondicionado', true),
        'cilindrada'  => get_post_meta($vehicle_id, '_cilindrada', true),
        'maletas'     => get_post_meta($vehicle_id, '_maletas', true),
    );

    wp_send_json_success($data);
}
add_action('wp_ajax_get_vehicle', 'motocar_get_vehicle_data');
add_action('wp_ajax_nopriv_get_vehicle', 'motocar_get_vehicle_data');

// ==========================================
// SHORTCODE: Si se necesita insertar catálogo en otra página
// ==========================================
function motocar_catalogo_shortcode() {
    ob_start();
    include get_template_directory() . '/template-parts/catalogo.php';
    return ob_get_clean();
}
add_shortcode('motocar_catalogo', 'motocar_catalogo_shortcode');
