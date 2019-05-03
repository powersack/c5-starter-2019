<?php

return [
    'assets' => array(
        'owl' => array(
            array(
                'javascript',
                'themes/kh/js/lib/owl.carousel.js',
                array('position' => 'F', 'minify' => false, 'combine' => true)
            )
        ),
        'theme_main' => array(
            array(
                'javascript',
                'themes/kh/js/main.js',
                array('position' => 'F', 'minify' => false, 'combine' => true)
            )
        ),
        'fancybox'                   => array(
            array(
                'javascript',
                'themes/kh/js/lib/jquery.fancybox.pack.js',
                array('position' => 'F', 'minify' => false, 'combine' => true)
            )
        ),
        'selectric'                   => array(
            array(
                'javascript',
                'themes/kh/js/lib/jquery.selectric.js',
                array('position' => 'F', 'minify' => false, 'combine' => true)
            )
        ),
    )
];
