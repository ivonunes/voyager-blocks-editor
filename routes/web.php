<?php

Route::get('/admin/assets/js/voyager-blocks-editor/{filename}', function ($filename) {
    $filepath = __DIR__ . '/../resources/js/' . $filename;

    if (file_exists($filepath) && strpos($filename, '/') === false) {
        return response(
            file_get_contents($filepath)
        )->header('Content-Type', 'application/javascript');
    }
});
