<?php
/**
 * Template: Archive – vehiculo
 * Redirige a la sección de vehículos en la home.
 */

wp_redirect( esc_url_raw( home_url( '/#vehiculos' ) ), 302 );
exit;
