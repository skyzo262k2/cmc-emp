<?php return array(
    'root' => array(
        'name' => '__root__',
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'reference' => NULL,
        'type' => 'library',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        '__root__' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'reference' => NULL,
            'type' => 'library',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'laminas/laminas-escaper' => array(
            'pretty_version' => '2.12.0',
            'version' => '2.12.0.0',
            'reference' => 'ee7a4c37bf3d0e8c03635d5bddb5bb3184ead490',
            'type' => 'library',
            'install_path' => __DIR__ . '/../laminas/laminas-escaper',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
        'phpoffice/phpword' => array(
            'pretty_version' => 'dev-develop',
            'version' => 'dev-develop',
            'reference' => 'fab9966b8c0cb085e293dc3c71176bfbfa16418d',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpoffice/phpword',
            'aliases' => array(
                0 => '0.19.x-dev',
            ),
            'dev_requirement' => false,
        ),
    ),
);
