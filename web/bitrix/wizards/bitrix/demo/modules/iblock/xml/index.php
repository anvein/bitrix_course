<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

CModule::IncludeModule('iblock');
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/iblock/classes/".$DBType."/cml2.php");

$arDeps = array();
$rsProps = CIBlockProperty::GetList(array(),array("PROPERTY_TYPE"=>"E"));
while($arProp = $rsProps->Fetch())
{
	$arDeps[$arProp["IBLOCK_ID"]] = $arProp["LINK_IBLOCK_ID"];
}
$rsProps = CIBlockProperty::GetList(array(),array("PROPERTY_TYPE"=>"G"));
while($arProp = $rsProps->Fetch())
{
	$arDeps[intval($arProp["IBLOCK_ID"])] = intval($arProp["LINK_IBLOCK_ID"]);
}

$arBlocks = array();
$rsBlocks = CIBlock::GetList(array("sort"=>"asc","id"=>"asc"));
while($arBlock = $rsBlocks->Fetch())
{
	if(strlen($arBlock["XML_ID"]) > 0)
	{
		$arBlock["IBLOCK_TYPE_ID"] = str_replace("_", "", $arBlock["IBLOCK_TYPE_ID"]);
		$arBlocks[intval($arBlock["ID"])] = array("TYPE"=>$arBlock["IBLOCK_TYPE_ID"], "CODE"=>$arBlock["CODE"], "XML_ID"=>$arBlock["XML_ID"]);
	}
}

$arExport = array();
$i = 0;
for($j = 0; $j < 100; $j++)
{
	foreach($arBlocks as $ID => $arBlock)
	{
		if(!array_key_exists($ID, $arDeps))
		{
			$i+=10;
			$arExport[] = array(
				"NUM" => $i,
				"XML_ID" => $arBlock["XML_ID"],
				"TYPE" => $arBlock["TYPE"],
				"ID" => $ID,
				"FILE" => "/exp/".sprintf("%03d", $i)."_".$arBlock["TYPE"]."_".$arBlock["XML_ID"]."_ru.xml",
			);
			unset($arBlocks[$ID]);
			foreach($arDeps as $CHILD => $PARENT)
			{
				if(($PARENT == $ID) || ($CHILD == $ID))
				{
					unset($arDeps[$CHILD]);
				}
			}
		}
	}
	if(count($arBlocks) <= 0)
		break;
}

foreach($arExport as $arBlock)
{
	$ABS_FILE_NAME = $_SERVER["DOCUMENT_ROOT"].$arBlock["FILE"];
	$IBLOCK_ID = $arBlock["ID"];

	if($fp = fopen($ABS_FILE_NAME, "wb"))
	{
		$WORK_DIR_NAME = substr($ABS_FILE_NAME, 0, strrpos($ABS_FILE_NAME, "/")+1);

		$next_step = array();
		$obExport = new CIBlockCMLExport;
		$obExport->Init($fp, $IBLOCK_ID, $next_step, true, $WORK_DIR_NAME, substr(substr($ABS_FILE_NAME, 0, -4)."_files"."/", strlen($WORK_DIR_NAME)));
		$bCatalog = $obExport->next_step["catalog"];
		$obExport->next_step["catalog"] = false;
		$obExport->StartExport();
		$obExport->StartExportMetadata();
		$PROPERTY_MAP = false;
		$obExport->ExportProperties($PROPERTY_MAP);
		$SECTION_MAP = false;
		$obExport->ExportSections($SECTION_MAP, time(), 0);
		$obExport->EndExportMetadata();
		$obExport->StartExportCatalog();
		if($arBlock["XML_ID"] === "FUTURE-1C-CATALOG")
		{
			//Goods
			$saved_work_dir = $obExport->work_dir;
			$saved_file_dir = $obExport->file_dir;
			$i = 0;
			do
			{
				$i++;
				$ABS_FILE_NAME = $_SERVER["DOCUMENT_ROOT"]."/exp/".sprintf("%03d", $arBlock["NUM"] + $i)."_".$arBlock["TYPE"]."_".$arBlock["XML_ID"]."_ru.xml";
				$fi = fopen($ABS_FILE_NAME, "wb");
				$work_dir = substr($ABS_FILE_NAME, 0, strrpos($ABS_FILE_NAME, "/")+1);
				$file_dir = substr(substr($ABS_FILE_NAME, 0, -4)."_files"."/", strlen($work_dir));

				$obExport->fp = $fi;
				$obExport->work_dir = $work_dir;
				$obExport->file_dir = $file_dir;

				$obExport->StartExport();
				$obExport->StartExportCatalog(false);
				$res = $obExport->ExportElements($PROPERTY_MAP, $SECTION_MAP, time(), 0, 30);
				$obExport->EndExportCatalog();
				$obExport->EndExport();


				fclose($fi);
			} while ($res > 0);
			$obExport->work_dir = $saved_work_dir;
			$obExport->file_dir = $saved_file_dir;
			unlink($ABS_FILE_NAME);
			$obExport->fp = $fp;
		}
		elseif($arBlock["XML_ID"] === "books-books")
		{
			//Goods
			$saved_work_dir = $obExport->work_dir;
			$saved_file_dir = $obExport->file_dir;
			$i = 0;
			do
			{
				$i++;
				$ABS_FILE_NAME = $_SERVER["DOCUMENT_ROOT"]."/exp/".sprintf("%03d", $arBlock["NUM"] + $i)."_".$arBlock["TYPE"]."_".$arBlock["XML_ID"]."_ru.xml";
				$fi = fopen($ABS_FILE_NAME, "wb");
				$work_dir = substr($ABS_FILE_NAME, 0, strrpos($ABS_FILE_NAME, "/")+1);
				$file_dir = substr(substr($ABS_FILE_NAME, 0, -4)."_files"."/", strlen($work_dir));

				$obExport->fp = $fi;
				$obExport->work_dir = $work_dir;
				$obExport->file_dir = $file_dir;

				$obExport->StartExport();
				$obExport->StartExportCatalog(false);
				$res = $obExport->ExportElements($PROPERTY_MAP, $SECTION_MAP, time(), 0, 15);
				$obExport->EndExportCatalog();
				$obExport->EndExport();


				fclose($fi);
			} while ($res > 0);
			$obExport->work_dir = $saved_work_dir;
			$obExport->file_dir = $saved_file_dir;
			unlink($ABS_FILE_NAME);
			$obExport->fp = $fp;
		}
		else
		{
			$obExport->ExportElements($PROPERTY_MAP, $SECTION_MAP, time(), 0);
		}

		$obExport->EndExportCatalog();
		$obExport->EndExport();
		//Prices
		if($bCatalog)
		{
			$file = "/exp/".sprintf("%03d", $arBlock["NUM"])."_".$arBlock["TYPE"]."_".$arBlock["XML_ID"]."-offers_ru.xml";
			$fo = fopen($_SERVER["DOCUMENT_ROOT"].$file, "wb");
			$obExport = new CIBlockCMLExport;
			$obExport->Init($fo, $IBLOCK_ID, $next_step, true, "", "");
			$obExport->only_price = true;
			$obExport->StartExport();
			$obExport->StartExportCatalog(false);
			$obExport->ExportElements($PROPERTY_MAP, $SECTION_MAP, time(), 0);
			$obExport->EndExportCatalog();
			$obExport->EndExport();
		}
	}
}

?>