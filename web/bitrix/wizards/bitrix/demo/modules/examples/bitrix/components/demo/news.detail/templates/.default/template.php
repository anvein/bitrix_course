<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="news-detail">

	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img border="0" src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>" height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"  title="<?=$arResult["NAME"]?>" />
	<?endif?>

	<?if($arParams["DISPLAY_DATE"]!="N" && strlen($arResult["ACTIVE_FROM"])):?>
		<span class="news-date-time"><?=$arResult["ACTIVE_FROM"]?></span><br />
	<?endif;?>

	<?if($arParams["DISPLAY_NAME"]!="N" && strlen($arResult["NAME"]) > 0):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>

 	<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?=$arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?=$arResult["PREVIEW_TEXT"];?>
	<?endif?>

	<div style="clear:both"></div>
	<br />

	<a href="<?=$arResult["LIST_PAGE_URL"]?>"><?=GetMessage("RETURN_TO_LIST")?></a>

</div>
