<?php
/**
 * Send a JSON response to the client.
 *
 * @param array $data The data to be sent in the response, will be encoded to JSON.
 * @param int $status The HTTP status code for the response. Default is 200.
 *
 * @return void
 */
function send_json_response(array $data, int $status = 200): void
{
    header('Content-Type: application/json');
    http_response_code($status);
    echo json_encode($data);
    exit;
}

/**
 * Send an error response with a message in JSON format.
 *
 * @param string $message The error message to be sent.
 * @param int $status The HTTP status code for the error response. Default is 400.
 *
 * @return void
 */
function send_error_response(string $message, int $status = 400): void
{
    send_json_response(['error' => $message], $status);
}

/**
 * Send a success response with a message in JSON format.
 *
 * @param string $message The success message to be sent.
 * @param int $status The HTTP status code for the success response. Default is 200.
 *
 * @return void
 */
function send_success_response(string $message, int $status = 200): void
{
    send_json_response(['message' => $message], $status);
}

/**
 * Send a download response to the client.
 *
 * @param string $file The path to the file to be downloaded.
 * @param string $filename The name of the file to be sent to the client.
 *
 * @return void
 */
function send_download_response(string $file, string $filename): void
{
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}

/**
 * Redirect the client to a specified URL.
 *
 * Usage:
 * <code>
 *     redirect_to('/path/to/redirect');
 *     redirect_to(site_url('/path/to/redirect'));
 * </code>
 *
 * @param string $url The URL to redirect to.
 *
 * @return void
 */
function redirect_to(string $url): void
{
    header('Location: ' . $url);
    exit;
}


/**
 * Redirects the user back to the previous page (referer).
 * If no referer is found, redirects to the homepage ('/').
 *
 * @param array $params Optional query parameters to append to the referer URL.
 *
 * @return void
 */
function redirect_back(array $params = []): void
{
    // Use the HTTP referer if available, otherwise redirect to homepage
    $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/';

    // If there are additional query parameters, append them to the URL
    if ( ! empty($params)) {
        $queryString = http_build_query($params);
        $separator   = ! str_contains($redirectUrl, '?') ? '?' : '&';
        $redirectUrl .= $separator . $queryString;
    }

    header('Location: ' . $redirectUrl);
    exit;
}