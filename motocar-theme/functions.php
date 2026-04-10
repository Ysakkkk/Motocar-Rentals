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

    // Taxonomía: Tipo de vehículo (Carro / Moto)
    register_taxonomy('tipo_vehiculo', 'vehiculo', array(
        'labels' => array(
            'name' => 'Tipo de Vehículo',
            'singular_name' => 'Tipo',
        ),
        'hierarchical' => true,
        'show_in_rest' => true,
    ));
}
add_action('init', 'motocar_register_vehicles');

// ==========================================
// META BOXES PARA VEHÍCULOS
// ==========================================
function motocar_vehicle_meta_boxes() {
    add_meta_box(
        'vehicle_details',
        'Detalles del Vehículo',
        'motocar_vehicle_meta_callback',
        'vehiculo',
        'normal',
        'high'
    );
    add_meta_box(
        'vehicle_availability',
        'Fechas No Disponibles',
        'motocar_availability_meta_callback',
        'vehiculo',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'motocar_vehicle_meta_boxes');

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
    $subcategoria = get_post_meta($post->ID, '_subcategoria', true);
    ?>
    <style>
        .vehicle-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .vehicle-meta-field { margin-bottom: 10px; }
        .vehicle-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; }
        .vehicle-meta-field input, .vehicle-meta-field select { width: 100%; padding: 8px; }
    </style>
    <div class="vehicle-meta-grid">
        <div class="vehicle-meta-field">
            <label>Precio por día (COP):</label>
            <input type="number" name="precio_dia" value="<?php echo esc_attr($precio_dia); ?>" placeholder="Ej: 135000">
        </div>
        <div class="vehicle-meta-field">
            <label>Precio anterior (COP) - para tachar:</label>
            <input type="number" name="precio_anterior" value="<?php echo esc_attr($precio_anterior); ?>" placeholder="Ej: 180000">
        </div>
        <div class="vehicle-meta-field">
            <label>Modelo:</label>
            <input type="text" name="modelo" value="<?php echo esc_attr($modelo); ?>" placeholder="Ej: Sportage">
        </div>
        <div class="vehicle-meta-field">
            <label>Año:</label>
            <input type="number" name="ano" value="<?php echo esc_attr($ano); ?>" placeholder="Ej: 2024">
        </div>
        <div class="vehicle-meta-field">
            <label>Transmisión:</label>
            <select name="transmision">
                <option value="manual" <?php selected($transmision, 'manual'); ?>>Manual</option>
                <option value="automatica" <?php selected($transmision, 'automatica'); ?>>Automática</option>
            </select>
        </div>
        <div class="vehicle-meta-field">
            <label>Pasajeros:</label>
            <input type="number" name="pasajeros" value="<?php echo esc_attr($pasajeros); ?>" placeholder="Ej: 5">
        </div>
        <div class="vehicle-meta-field">
            <label>Combustible:</label>
            <select name="combustible">
                <option value="gasolina" <?php selected($combustible, 'gasolina'); ?>>Gasolina</option>
                <option value="diesel" <?php selected($combustible, 'diesel'); ?>>Diésel</option>
                <option value="electrico" <?php selected($combustible, 'electrico'); ?>>Eléctrico</option>
                <option value="hibrido" <?php selected($combustible, 'hibrido'); ?>>Híbrido</option>
            </select>
        </div>
        <div class="vehicle-meta-field">
            <label>Aire Acondicionado:</label>
            <select name="aire_acondicionado">
                <option value="si" <?php selected($aire_acondicionado, 'si'); ?>>Sí</option>
                <option value="no" <?php selected($aire_acondicionado, 'no'); ?>>No</option>
            </select>
        </div>
        <div class="vehicle-meta-field">
            <label>Cilindraje (cc) - para motos:</label>
            <input type="text" name="cilindrada" value="<?php echo esc_attr($cilindrada); ?>" placeholder="Ej: 250cc">
        </div>
        <div class="vehicle-meta-field">
            <label>Subcategoría (para ordenamiento):</label>
            <select name="subcategoria">
                <option value="moto" <?php selected($subcategoria, 'moto'); ?>>Moto</option>
                <option value="hatchback" <?php selected($subcategoria, 'hatchback'); ?>>Hatchback</option>
                <option value="sedan" <?php selected($subcategoria, 'sedan'); ?>>Sedán</option>
                <option value="camioneta" <?php selected($subcategoria, 'camioneta'); ?>>Camioneta</option>
            </select>
        </div>
    </div>
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

    $fields = array('precio_dia', 'precio_anterior', 'modelo', 'ano', 'transmision', 'pasajeros', 'combustible', 'aire_acondicionado', 'cilindrada', 'subcategoria');

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
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
    $tipos = wp_get_post_terms($vehicle_id, 'tipo_vehiculo', array('fields' => 'names'));

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
        'tipo'        => !empty($tipos) ? $tipos[0] : '',
    );

    wp_send_json_success($data);
}
add_action('wp_ajax_get_vehicle', 'motocar_get_vehicle_data');
add_action('wp_ajax_nopriv_get_vehicle', 'motocar_get_vehicle_data');

// ==========================================
// AJAX: FILTRAR VEHÍCULOS
// ==========================================
function motocar_filter_vehicles() {
    check_ajax_referer('motocar_nonce', 'nonce');

    $tipo = sanitize_text_field($_POST['tipo'] ?? '');
    $precio_rango = sanitize_text_field($_POST['precio_rango'] ?? '');
    $fecha_inicio = sanitize_text_field($_POST['fecha_inicio'] ?? '');
    $fecha_fin = sanitize_text_field($_POST['fecha_fin'] ?? '');

    $args = array(
        'post_type'      => 'vehiculo',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    );

    // Filtro por tipo (carro/moto)
    if (!empty($tipo)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'tipo_vehiculo',
                'field'    => 'slug',
                'terms'    => $tipo,
            ),
        );
    }

    // Filtro por rango de precio
    if (!empty($precio_rango)) {
        $rango = explode('-', $precio_rango);
        if (count($rango) === 2) {
            $args['meta_query'][] = array(
                'key'     => '_precio_dia',
                'value'   => array(intval($rango[0]), intval($rango[1])),
                'type'    => 'NUMERIC',
                'compare' => 'BETWEEN',
            );
        }
    }

    $query = new WP_Query($args);
    $vehicles = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $thumbnail = get_the_post_thumbnail_url($id, 'medium');
            $tipos = wp_get_post_terms($id, 'tipo_vehiculo', array('fields' => 'names'));

            $vehicles[] = array(
                'id'          => $id,
                'nombre'      => get_the_title(),
                'imagen'      => $thumbnail ?: '',
                'precio_dia'  => get_post_meta($id, '_precio_dia', true),
                'precio_anterior' => get_post_meta($id, '_precio_anterior', true),
                'modelo'      => get_post_meta($id, '_modelo', true),
                'ano'         => get_post_meta($id, '_ano', true),
                'transmision' => get_post_meta($id, '_transmision', true),
                'pasajeros'   => get_post_meta($id, '_pasajeros', true),
                'tipo'        => !empty($tipos) ? $tipos[0] : '',
                'subcategoria' => get_post_meta($id, '_subcategoria', true),
                'cilindrada'  => get_post_meta($id, '_cilindrada', true),
            );
        }
        wp_reset_postdata();

        // Filtrar por disponibilidad de fechas
        if (!empty($fecha_inicio) && !empty($fecha_fin)) {
            $vehicles = array_filter($vehicles, function($v) use ($fecha_inicio, $fecha_fin) {
                $fechas_nd = get_post_meta($v['id'], '_fechas_no_disponibles', true);
                if (!is_array($fechas_nd) || empty($fechas_nd)) return true;
                foreach ($fechas_nd as $rango) {
                    if (empty($rango['inicio']) || empty($rango['fin'])) continue;
                    // Hay conflicto si los rangos se solapan
                    if ($fecha_inicio <= $rango['fin'] && $fecha_fin >= $rango['inicio']) {
                        return false;
                    }
                }
                return true;
            });
            $vehicles = array_values($vehicles);
        }

        // Sort by subcategory hierarchy then price
        $subcat_order = array('moto' => 1, 'hatchback' => 2, 'sedan' => 3, 'camioneta' => 4);
        usort($vehicles, function($a, $b) use ($subcat_order) {
            $oa = $subcat_order[$a['subcategoria']] ?? 99;
            $ob = $subcat_order[$b['subcategoria']] ?? 99;
            if ($oa !== $ob) return $oa - $ob;
            return intval($a['precio_dia']) - intval($b['precio_dia']);
        });
    }

    wp_send_json_success($vehicles);
}
add_action('wp_ajax_filter_vehicles', 'motocar_filter_vehicles');
add_action('wp_ajax_nopriv_filter_vehicles', 'motocar_filter_vehicles');

// ==========================================
// SHORTCODE: Si se necesita insertar catálogo en otra página
// ==========================================
function motocar_catalogo_shortcode() {
    ob_start();
    include get_template_directory() . '/template-parts/catalogo.php';
    return ob_get_clean();
}
add_shortcode('motocar_catalogo', 'motocar_catalogo_shortcode');
