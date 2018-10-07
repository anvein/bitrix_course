<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="news-detail">

	<?if(strlen($arResult["ACTIVE_FROM"])):?>
		<span class="news-date-time"><?=$arResult["ACTIVE_FROM"]?></span><br />
	<?endif;?>

 	<?if(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?=$arResult["DETAIL_TEXT"];?>
 	<?else:?>
		<?=$arResult["PREVIEW_TEXT"];?>
	<?endif?>


	<br /><br />

	<a href="<?=$arResult["LIST_PAGE_URL"]?>"><?=GetMessage("RETURN_TO_LIST")?></a>

</div>
