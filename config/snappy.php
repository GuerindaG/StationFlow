<?php

return [
    
    'pdf' => [
        'enabled' => true,
        'binary'  => '"C:\Program Files (x86)\wkhtmltopdf\bin\wkhtmltopdf.exe"',
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
    
    'image' => [
        'enabled' => true,
        'binary'  => env('WKHTML_IMG_BINARY', '/usr/local/bin/wkhtmltoimage'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],

];
