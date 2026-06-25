<?php
/**
 * Template: Search Results
 * Cuando el usuario busca un vehículo, lo redirige a la sección de
 * vehículos en la home con el parámetro ?cat=<slug> para abrir el modal.
 * Si el término coincide con una categoría conocida, va directo a ella;
 * si no, va a la home con el buscador resaltado.
 */

$search_query = get_search_query(); // sanitizado por WP

// Mapa de términos de búsqueda → slug de categoria_vehiculo
$keyword_map = array(
    // Motos
    'moto'          => 'motos',
    'motos'         => 'motos',
    'motocicleta'   => 'motos',
    'motocicletas'  => 'motos',
    'yamaha'        => 'motos',
    'fz'            => 'motos',
    'fz150'         => 'motos',
    'fz250'         => 'motos',
    // Motos automáticas
    'automatica'    => 'motos-auto',
    'automática'    => 'motos-auto',
    'automaticas'   => 'motos-auto',
    'automáticas'   => 'motos-auto',
    'scooter'       => 'motos-auto',
    'aerox'         => 'motos-auto',
    // Hatchback
    'hatchback'     => 'economy',
    'gol'           => 'economy',
    'volkswagen'    => 'economy',
    'economico'     => 'economy',
    'económico'     => 'economy',
    // Sedan
    'sedan'         => 'compact',
    'sedán'         => 'compact',
    'logan'         => 'compact',
    'renault'       => 'compact',
    // SUV Compacto
    'suv'           => 'suv',
    'seltos'        => 'suv',
    'kia'           => 'suv',
    'sportage'      => 'suv',
    // SUV 7 puestos
    'suv7'          => 'suv7',
    'fortuner'      => 'suv7',
    'toyota'        => 'suv7',
    '7 puestos'     => 'suv7',
    '7puestos'      => 'suv7',
    'camioneta'     => 'suv7',
    '4x4'           => 'suv7',
);

// Normalizar consulta: minúsculas, sin acentos
$normalized = mb_strtolower( trim( $search_query ), 'UTF-8' );
$normalized = str_replace(
    array('á','é','í','ó','ú','ü','ñ'),
    array('a','e','i','o','u','u','n'),
    $normalized
);

$matched_slug = null;

// 1. Coincidencia exacta en el mapa
if ( isset( $keyword_map[ $normalized ] ) ) {
    $matched_slug = $keyword_map[ $normalized ];
}

// 2. Coincidencia parcial (busca si alguna clave está contenida en la consulta)
if ( ! $matched_slug ) {
    foreach ( $keyword_map as $keyword => $slug ) {
        $norm_key = str_replace(
            array('á','é','í','ó','ú','ü','ñ'),
            array('a','e','i','o','u','u','n'),
            mb_strtolower( $keyword, 'UTF-8' )
        );
        if ( strpos( $normalized, $norm_key ) !== false ) {
            $matched_slug = $slug;
            break;
        }
    }
}

// 3. Buscar directamente en la taxonomía por nombre
if ( ! $matched_slug ) {
    $tax_terms = get_terms( array(
        'taxonomy'   => 'categoria_vehiculo',
        'hide_empty' => false,
    ) );
    if ( ! is_wp_error( $tax_terms ) ) {
        foreach ( $tax_terms as $term ) {
            $norm_term = str_replace(
                array('á','é','í','ó','ú','ü','ñ'),
                array('a','e','i','o','u','u','n'),
                mb_strtolower( $term->name, 'UTF-8' )
            );
            if ( strpos( $norm_term, $normalized ) !== false || strpos( $normalized, $norm_term ) !== false ) {
                $matched_slug = $term->slug;
                break;
            }
        }
    }
}

// Construir URL de destino
if ( $matched_slug ) {
    // Redirigir a home#vehiculos con parámetro para abrir el modal de la categoría
    $redirect_url = add_query_arg( 'cat', sanitize_key( $matched_slug ), home_url( '/' ) );
    $redirect_url .= '#vehiculos';
} else {
    // Sin coincidencia: ir a la home apuntando a la sección de vehículos
    $redirect_url = home_url( '/#vehiculos' );
}

wp_redirect( esc_url_raw( $redirect_url ), 302 );
exit;
