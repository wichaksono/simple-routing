<?php

/**
 * =====================================================================
 * Sites Helper Functions
 * =====================================================================
 *
 * These functions are used to retrieve and manipulate URLs.
 * - get_base_url: Returns the base URL of the site. E.g., http://example.com
 * - get_protocol: Returns the protocol of the current request. E.g., http or https
 */

/**
 * Retrieve the base URL of the site.
 *
 * This method determines the base URL of the site based on the server configuration.
 *
 * @return string Returns the base URL of the site.
 */
function get_base_url(): string
{
    $subDirectory = str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
    $subDirectory = str_replace('/index.php', '', $subDirectory);

    return get_protocol() . '://' . $_SERVER['HTTP_HOST'] . $subDirectory;
}

/**
 * Retrieve the protocol of the current request.
 *
 * This method determines the protocol of the current request based on the server configuration.
 *
 * @return string Returns the protocol of the current request.
 */
function get_protocol():string
{
    return isset($_SERVER['HTTPS']) && ($_SERVER['SERVER_PORT'] === '443' || $_SERVER['HTTPS'] === 'on')
        ? 'https' : 'http';
}

/**
 * Retrieve the home URL of the site.
 *
 * This method retrieves the home URL of the site based on the provided path.
 *
 * Usage:
 * <code>
 *     $homeUrl = get_home_url(); // Retrieves the home URL of the site.
 *     $homeUrl = get_home_url('/about'); // Retrieves the home URL with the 'https://domaian.com/about' path appended.
 *
 *     echo $homeUrl;
 * </code>
 *
 * @param string $path The path to append to the home URL.
 * @return string Returns the home URL of the site.
 */
function get_site_url(string $path = '/'): string
{
    return get_base_url() . $path;
}

/**
 * Output the home URL of the site.
 *
 * This method outputs the home URL of the site based on the provided path.
 *
 * Usage:
 * <code>
 *     site_url(); // Outputs the home URL of the site.
 *     site_url('/about'); // Outputs the home URL with the 'https://domaian.com/about' path appended.
 * </code>
 *
 * @param string $path The path to append to the home URL.
 * @return void
 */
function site_url(string $path = '/'): void
{
    echo get_site_url($path);
}
