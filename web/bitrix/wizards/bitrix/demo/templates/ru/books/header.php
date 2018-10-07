<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?$APPLICATION->ShowHead()?>
<title><?$APPLICATION->ShowTitle()?></title>
</head>

<body>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>

<div id="header"><img src="<?=SITE_TEMPLATE_PATH?>/images/logo.jpg" id="header_logo" height="105" alt="" width="508" border="0"/>
  <div id="header_text"><?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/company_name.php"),
			Array(),
			Array("MODE"=>"html")
		);?> </div>

	<a href="/" title="Главная" id="company_logo"></a>

  <div id="header_menu"><?$APPLICATION->IncludeFile(
			$APPLICATION->GetTemplatePath("include_areas/header_icons.php"),
			Array(),
			Array("MODE"=>"php")
		);?> </div>

</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"horizontal_multilevel",
	Array(
		"ROOT_MENU_TYPE" => "top", 
		"MAX_LEVEL" => "3", 
		"CHILD_MENU_TYPE" => "left", 
		"USE_EXT" => "Y", 
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => Array()
	)
);?> 
<div id="zebra"></div>

<table id="content">
  <tbody>
    <tr><td class="left-column"><?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	".default",
	Array(
		"ROOT_MENU_TYPE" => "left", 
		"MAX_LEVEL" => "1", 
		"CHILD_MENU_TYPE" => "left", 
		"USE_EXT" => "Y", 
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
			0 => "SECTION_ID",
			1 => "page",
		),
	)
);?>

	<!-- SOCIALNETWORK -->

        <div class="content-block">
          <div class="content-block-head">Поиск по сайту</div>

          <div class="content-block-body"><?$APPLICATION->IncludeComponent(
	"bitrix:search.form",
	".default",
	Array(
		"PAGE" => "/search/" 
	)
);?> </div>
        </div>
      
        <div class="content-block">
          <div class="content-block-head">Авторизация</div>
        
          <div class="content-block-body"><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	".default",
	Array(
		"REGISTER_URL" => "/auth/", 
		"PROFILE_URL" => "/personal/profile/" 
	)
);?></div>
        </div>
      
		<!--SUBSCRIBE-->
      
        <!--BANNER_LEFT-->

        </div>
      </td><td class="main-column">
        <div id="navigation"><?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	".default",
	Array(
		"START_FROM" => "0", 
		"PATH" => "", 
		"SITE_ID" => "" 
	)
);?> </div>
      
        <h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>
      