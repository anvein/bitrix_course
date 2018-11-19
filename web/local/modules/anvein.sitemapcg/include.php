<?php

use Bitrix\Main\Loader;

Loader::includeModule('seo');

Loader::registerAutoLoadClasses(
    'anvein.sitemapcg',
    [
        'Anvein\SitemapCG\SitemapIblockGenerator'   => 'lib/SitemapIblockGenerator.php',
        'Anvein\SitemapCG\SitemapForumGenerator'    => 'lib/SitemapForumGenerator.php',
        'Anvein\SitemapCG\SitemapGlobalGenerator'    => 'lib/SitemapGlobalGenerator.php',
    ]
);
