<?php

require_once __DIR__ . '/includes/routes.php';
require_once __DIR__ . '/includes/file-system.php';
require_once __DIR__ . '/includes/responses.php';
require_once __DIR__ . '/includes/requests.php';
require_once __DIR__ . '/includes/sites.php';

/**
 * ============================================================
 * Templating Handler
 * ============================================================
 */

/**
 * Templating with static segment
 *
 */
// example: https://domain.com/crm/leads/add
// Load the template if the route is /crm/leads/add
if (get_segment(0) === 'crm' && get_segment(1) === 'leads' && get_segment(2) === 'add') {
    // Load the template
    # include_file(__DIR__ . '/templates/crm/lead/add');
    # include_file_once(__DIR__ . '/templates/crm/lead/add');
    // Or
    # require __DIR__ . '/templates/crm/lead/add.php';
    # require_once __DIR__ . '/templates/crm/lead/add.php';
}

/**
 * Templating with dynamic segment
 *
 */
// example: https://domain.com/crm/leads/add
echo '<pre>';
echo 'Dynamic Segment: <br>';
if ($segment = get_segment(0)) {
    if (check_file_is_exists(__DIR__ . '/templates/' . $segment)) {
        include_file_once(__DIR__ . '/templates/' . $segment);
    } else {
        header('HTTP/1.0 404 Not Found');
        echo '404 Not Found';
    }
} else {
    #include_file_once(__DIR__ . '/templates/home');
    echo 'Home Page';
}
echo '</pre>';

/**
 * ============================================================
 * Routing Handler
 * ============================================================
 */
echo '<pre>';
// Get All Routes
echo 'Get All Routes: <br>';
print_r(get_routes());
echo '</pre>';

// Get Route By Name
// Route Pattern: https://domain.com/seqment-1/seqment-2/seqment-3/.../seqment-n?key1=value1&key2=value2&...&key-n=value-n
// example: https://domain.com/hallo/apa/kabar/dunia
echo '<pre>';
echo 'Segments: <br>';
print_r(get_segment(0)); // hallo
print_r(get_segment(1)); // apa
print_r(get_segment(2)); // kabar
print_r(get_segment(3)); // dunia
print_r(get_segment(4)); // kosong

echo '</pre>';

// Get Query Params
// example: https://domain.com/hallo/apa/kabar/dunia?name=John&age=20
echo '<pre>';
echo 'Query Params: <br>';
print_r(get_query_params());
print_r(get_query_param('name')); // John
print_r(get_query_param('age')); // 20
echo '</pre>';

// Get Base URL
echo '<pre>';
echo 'Base URL: <br>';
print_r(get_base_url());
echo '</pre>';

// Get Protocol
echo '<pre>';
echo 'Protocol: <br>';
print_r(get_protocol());
echo '</pre>';
