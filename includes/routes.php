<?php
/**
 * =====================================================================
 * Route Helper Functions
 * =====================================================================
 *
 * These functions are used to retrieve and manipulate routes.
 * - get_routes: Returns an array of route information.
 * - get_segment: Returns a specific segment of the route.
 * - get_query_params: Returns an array of query parameters.
 */
function get_routes()
{
    static $routes;

    if (empty($routes)) {
        $route = $_SERVER['REQUEST_URI'];
        $parsedUrl = parse_url($route);

        $path = trim($parsedUrl['path'], '/');

        $routeSegments = explode('/', $path);

        $routes = [
            'protocol' => get_protocol(),
            'base_url' => get_base_url(),
            'request_uri' => $route,
            'segments' => $routeSegments,
            'query_params' => $_GET ?? [],
        ];
    }

    return $routes;
}

/**
 * Retrieve a specific segment of the route.
 *
 * This method retrieves a specific segment of the route based on the provided index.
 *
 * Usage:
 * <code>
 *     $route = get_segment(0); // Retrieves the first segment of the route.
 *     $route = get_segment(1); // Retrieves the second segment of the route.
 *     ....
 * </code>
 *
 * @param int $index The index of the segment to retrieve.
 * @return string Returns the segment of the route.
 */
function get_segment(int $index):string
{
    $segments = get_routes()['segments'];
    return $segments[$index] ?? '';
}

/**
 * Retrieve an array of query parameters.
 *
 * This method retrieves an array of query parameters from the route.
 *
 * @return array Returns an array of query parameters.
 */
function get_query_params():array
{
    return get_routes()['query_params'];
}

/**
 * Retrieve a specific query parameter.
 *
 * This method retrieves a specific query parameter based on the provided key.
 *
 * Usage:
 * <code>
 *     $param = get_query_param('key'); // Retrieves the value of the 'key' query parameter.
 * </code>
 *
 * @param string $key The key of the query parameter to retrieve.
 * @return string Returns the value of the query parameter.
 */
function get_query_param(string $key):string
{
    return get_query_params()[$key] ?? '';
}
