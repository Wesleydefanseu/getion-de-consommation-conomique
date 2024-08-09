<?php // config/flasher.php

return [
    'plugins' => [
        'toastr' => [
            'scripts' => [
                '/vendor/flasher/jquery.min.js',
                '/vendor/flasher/toastr.min.js',
                '/vendor/flasher/flasher-toastr.min.js',

                '/vendor/flasher/sweetalert2.min.js',
                '/vendor/flasher/flasher-sweetalert.min.js',
            ],
            'styles' => [
                '/vendor/flasher/toastr.min.css',

                '/vendor/flasher/sweetalert2.min.css',
            ],
            'options' => [
                // Optional: Add global options here
                'closeButton' => true,

                      // Optional: Add global options here
                'position' => 'center'
            ],
        ],
    ],
];