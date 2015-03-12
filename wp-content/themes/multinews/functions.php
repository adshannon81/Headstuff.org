<?php
//Multinews functions
require_once get_template_directory() . '/framework/main.php';
/* fix header */
function mom_remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'mom_remove_x_pingback');
if (file_exists(get_template_directory() . '/demo/demo.php')) {
            require_once get_template_directory() . '/demo/demo.php';
}

?>