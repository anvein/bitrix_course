<?php
$arUrlRewrite = [
    0 => [
        'CONDITION' => '#^/portfolio/#',
        'RULE'      => '',
        'ID'        => 'bitrix:news',
        'PATH'      => '/portfolio/index.php',
        'SORT'      => 100,
    ],
    1 => [
        'CONDITION' => '#^/services/#',
        'RULE'      => '',
        'ID'        => 'bitrix:news',
        'PATH'      => '/services/index.php',
        'SORT'      => 100,
    ],
    2 => [
        'CONDITION' => '#^/rest/#',
        'RULE'      => '',
        'ID'        => null,
        'PATH'      => '/bitrix/services/rest/index.php',
        'SORT'      => 100,
    ],
];
