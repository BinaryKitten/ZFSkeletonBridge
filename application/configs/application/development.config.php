<?php
return array(
    'phpSettings' => array(
        'display_startup_errors'    => 1,
        'display_errors'            => 1,
    ),
    'resources' => array(
        'frontController' => array(
            'params' => array(
                'displayExceptions' => 1
            ),
            'throwexceptions' => FALSE,
        ),
    )
);