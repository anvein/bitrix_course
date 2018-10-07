<?php

// @see intranet / landing

// prepare init (@tmp bug fix for post action)
if (isset($_REQUEST['path']))
{
	$urlParts = parse_url($_REQUEST['path']);
	if (isset($urlParts['query']))
	{
		foreach (explode('&', $urlParts['query']) as $part)
		{
			if (strpos($part, '=') !== false)
			{
				list($k, $v) = explode('=', $part);
				$_GET[$k] = $v;
			}
		}
	}
}


require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$APPLICATION->IncludeComponent(
	'bitrix:landing.pub',
	'',
	array(
		'HTTP_HOST' => $_SERVER['HTTP_HOST']
	),
	null,
	array(
		'HIDE_ICONS' => 'Y'
	)
);

require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php');