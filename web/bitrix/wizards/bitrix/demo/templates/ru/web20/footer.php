<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?> 
<br />
<!--BANNER_BOTTOM-->


		</td>
	</tr>
	<tr>
		<td colspan="2" class="right-shadow">
		<div class="footer-box">
		<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
			"ROOT_MENU_TYPE"	=>	"top",
			"MAX_LEVEL"	=>	"1",
			"MENU_CACHE_TYPE" => "A",
			"MENU_CACHE_TIME" => "3600",
			"MENU_CACHE_USE_GROUPS" => "N",
			"MENU_CACHE_GET_VARS" => Array()
			)
		);?></div>
		</td>
	</tr>
	<tr class="table-bottom-corner">
		<td><img src="<?=SITE_TEMPLATE_PATH?>/images/left_bottom_corner.gif" width="5" height="23" border="0" alt="" /></td>
		<td align="right"><img src="<?=SITE_TEMPLATE_PATH?>/images/right_bottom_corner.gif" width="7" height="23" border="0" alt="" /></td>
	</tr>
</table>

</div>
</body>
</html>