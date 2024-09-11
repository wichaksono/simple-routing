<?php
/**
 * ==============================================================================
 * File System Functions
 * ==============================================================================
 */

/**
 * ==============================================================================
 * Include File(s)
 * ==============================================================================
 */

/**
 * Check if file exists
 *
 * Usage:
 * <code>
 *     $check = check_file_is_exists('/path/to/file.php');
 *     $check = check_file_is_exists('/path/to/file')
 * </code>
 *
 * @param string $filename
 * @return bool
 */
function check_file_is_exists(string $filename): bool
{
    // file name with .php
    if (substr($filename, -4) !== '.php') {
        $filename .= '.php';
    }

    return file_exists($filename);
}

/**
 * Include file if exists
 *
 * Usage:
 * <code>
 *     include_file('/path/to/file.php');
 *     include_file('/path/to/file')
 *
 *     include_file('/path/to/file.php', ['key' => 'value']);
 *     include_file('/path/to/file', ['key' => 'value']);
 * </code>
 *
 * Inner file include you can use $args array to pass variables to the included file.
 * <code>
 *     // file.php
 *     echo isset($args['key']) ? $args['key'] : '';
 * </code>
 *
 * @param string $filename
 * @param array $args
 */
function include_file(string $filename, array $args = []): void
{
    if (check_file_is_exists($filename)) {
        include $filename;
    } else {
        echo 'File not found: ' . $filename;
    }
}

/**
 * Include file once if exists
 *
 * Usage:
 * <code>
 *     include_file_once('/path/to/file.php');
 *     include_file_once('/path/to/file')
 *
 *     include_file_once('/path/to/file.php', ['key' => 'value']);
 *     include_file_once('/path/to/file', ['key' => 'value']);
 * </code>
 *
 * Inner file include you can use $args array to pass variables to the included file.
 * <code>
 *     // file.php
 *     echo isset($args['key']) ? $args['key'] : '';
 * </code>
 *
 * @param string $filename
 * @param array $args
 */
function include_file_once(string $filename, array $args = []): void
{
    if (check_file_is_exists($filename)) {
        include_once $filename;
    } else {
        echo 'File not found: ' . $filename;
    }
}

/**
 * Include all files in a directory
 *
 * Usage:
 * <code>
 *     include_files('/path/to/directory');
 *     include_files('/path/to/directory', 'ext');
 * </code>
 *
 * @param string $directory
 * @param string $extension
 */
function include_files(string $directory, string $extension = 'php'): void
{
    $files = glob($directory . '/*.' .$extension);
    foreach ($files as $file) {
        include $file;
    }
}

/**
 * ==============================================================================
 * Logs System
 * ==============================================================================
 */
define('LOG_DIR', $_SERVER['DOCUMENT_ROOT'] . '/logs/');
define('LOG_FILE', LOG_DIR . 'log.txt');

function set_log(string $message): void
{
    if (!is_dir(LOG_DIR)) {
        mkdir(LOG_DIR, 0755, true);
    }

    $log = date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;
    file_put_contents(LOG_FILE, $log, FILE_APPEND);
}

/**
 * Get log
 *
 * @return array
 */
function get_log(): array
{
    return file(LOG_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
}

/**
 * ==============================================================================
 * File Cache System
 * ==============================================================================
 */
define('CACHE_DIR', $_SERVER['DOCUMENT_ROOT'] . '/cache/');
define('CACHE_EXT', '.cache');

/**
 * Set cache
 *
 * @param string $key
 * @param mixed $value
 * @param int $expires
 * @return bool
 */
function cache_set(string $key, $value, int $expires = 0): bool
{
    $filePath = CACHE_DIR . $key . CACHE_EXT;

    if (!is_dir(CACHE_DIR)) {
        mkdir(CACHE_DIR, 0755, true);
    }

    $data = [
        'value' => $value,
        'expires' => $expires > 0 ? time() + $expires : 0,
    ];

    return file_put_contents($filePath, serialize($data)) !== false;
}

/**
 * Get cache
 *
 * @param string $key
 * @return mixed
 */
function cache_get(string $key)
{
    $filePath = CACHE_DIR . $key . CACHE_EXT;

    if (check_file_is_exists($filePath)) {
        $data = unserialize(file_get_contents($filePath));

        if ($data['expires'] === 0 || $data['expires'] > time()) {
            return $data['value'];
        }

        unlink($filePath);
    }

    return null;
}
