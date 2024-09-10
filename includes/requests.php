<?php
/**
 * =====================================================================
 * Request Helper Functions
 * =====================================================================
 *
 * These functions are used to determine the type of request.
 * - is_post_request: Determines if the request is a POST request.
 * - is_get_request: Determines if the request is a GET request.
 * - is_ajax_request: Determines if the request is an AJAX request.
 */

/**
 * Determine if the request is a POST request.
 *
 * This method determines if the current request is a POST request.
 *
 * Usage:
 * <code>
 *     if (is_post_request()) {
 *        // Perform POST request operations.
 *     } else {
 *       // Perform other operations.
 *    }
 * </code>
 *
 * @return bool Returns true if the request is a POST request, false otherwise.
 */
function is_post_request():bool
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Determine if the request is a GET request.
 *
 * This method determines if the current request is a GET request.
 *
 * Usage:
 * <code>
 *     if (is_get_request()) {
 *        // Perform GET request operations.
 *     } else {
 *       // Perform other operations.
 *    }
 * </code>
 *
 * @return bool Returns true if the request is a GET request, false otherwise.
 */
function is_get_request():bool
{
    return $_SERVER['REQUEST_METHOD'] === 'GET';
}

/**
 * Determine if the request is an AJAX request.
 *
 * This method determines if the current request is an AJAX request.
 *
 * Usage:
 * <code>
 *     if (is_ajax_request()) {
 *        // Perform AJAX request operations.
 *     } else {
 *       // Perform other operations.
 *    }
 * </code>
 *
 * @return bool Returns true if the request is an AJAX request, false otherwise.
 */
function is_ajax_request():bool
{
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
