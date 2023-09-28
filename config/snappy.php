<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Snappy PDF / Image Configuration
    |--------------------------------------------------------------------------
    |
    | This option contains settings for PDF generation.
    |
    | Enabled:
    |
    |    Whether to load PDF / Image generation.
    |
    | Binary:
    |
    |    The file path of the wkhtmltopdf / wkhtmltoimage executable.
    |
    | Timout:
    |
    |    The amount of time to wait (in seconds) before PDF / Image generation is stopped.
    |    Setting this to false disables the timeout (unlimited processing time).
    |
    | Options:
    |
    |    The wkhtmltopdf command options. These are passed directly to wkhtmltopdf.
    |    See https://wkhtmltopdf.org/usage/wkhtmltopdf.txt for all options.
    |
    | Env:
    |
    |    The environment variables to set while running the wkhtmltopdf process.
    |
    */

    'pdf' => [
        'enabled' => true,
        // 'binary'  => env('WKHTML_PDF_BINARY', base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),),
        // 'binary'  => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf.exe"', working on local
        // 'binary'  => ('/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'),
        // 'binary'  => '/usr/bin/wkhtmltopdf', // Update this path
        // 'binary'  => '/usr/local/bin/wkhtmltopdf-amd64',
        // 'binary' => env('WKHTMLTOPDF_BINARY_PATH', '/usr/local/bin/wkhtmltopdf'),
        // 'binary'  => '/usr/local/bin/wkhtmltopdf-amd64',
        'binary'  => env('WKHTML_PDF_BINARY', '/usr/local/bin/wkhtmltopdf'),
        'timeout' => false,
        'options' => [  
            'enable-local-file-access' => true,
            'print-media-type' => true
        ],
        'env'     => [],
    ],

    'image' => [
        'enabled' => true,
        // 'binary'  => '""C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage.exe"',
        // 'binary'  => '/usr/bin/wkhtmltoimage', // Update this path
        // 'binary' => env('WKHTMLTOIMAGE_BINARY_PATH', '/usr/local/bin/wkhtmltoimage'),
        // 'binary'  => ('/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'binary'  => env('WKHTML_IMG_BINARY', '/usr/local/bin/wkhtmltoimage'),

        'timeout' => false,
        'options' => [
            'enable-local-file-access' => true
        ],
        'env'     => [],
    ],

];
