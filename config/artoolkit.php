<?php

return [
    'level' => env('ARTOOLKIT_LEVEL', 2), // 0 = few, 4 = many
    'leveli' => env('ARTOOLKIT_LEVELI', 1), // 0 = few, 3 = many

    'max_dpi' => env('ARTOOLKIT_MAX_DPI', 72),
    'default_dpi' => env('ARTOOLKIT_DEFAULT_DPI', 40), // Used if the image has no DPI exif data
    'min_dpi' => env('ARTOOLKIT_MIN_DPI', 20),
];
