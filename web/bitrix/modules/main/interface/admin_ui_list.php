<?php
use Bitrix\Main\Text\HtmlFilter;
use Bitrix\Main\Grid\Editor\Types;
use Bitrix\Main\Grid\Panel;
use Bitrix\Main\UI\Filter\Options;

class CAdminUiList extends CAdminList
{
	public $enableNextPage = false;
	public $totalRowCount = 0;

	protected $filterPresets = array();
	protected $currentPreset = array();

	private $isShownContext = false;
	private $contextSettings = array();

	/** @var CAdminUiContextMenu */
	public $context = false;

	public function AddHeaders($aParams)
	{
		parent::AddHeaders($aParams);
		$this->SetVisibleHeaderColumn();
	}

	public function SetVisibleHeaderColumn()
	{
		$gridOptions = new Bitrix\Main\Grid\Options($this->table_id);
		$gridColumns = $gridOptions->GetVisibleColumns();
		if ($gridColumns)
		{
			$this->arVisibleColumns = array();
			$this->aVisibleHeaders = array();
			foreach ($gridColumns as $columnId)
			{
				if (isset($this->aHeaders[$columnId]) && !isset($this->aVisibleHeaders[$columnId]))
				{
					$this->arVisibleColumns[] = $columnId;
					$this->aVisibleHeaders[$columnId] = $this->aHeaders[$columnId];
				}
			}
		}
	}

	public function SetNavigationParams(\CAdminUiResult $queryObject, $params = array())
	{
		$queryObject->setNavigationParams($params);
		$this->NavText($queryObject->GetNavPrint(""));
		$this->totalRowCount = $queryObject->NavRecordCount;
		$this->enableNextPage = $queryObject->PAGEN < $queryObject->NavPageCount;
	}

	public function setNavigation(\Bitrix\Main\UI\PageNavigation $nav, $title, $showAllways = true, $post = false)
	{
		global $APPLICATION;

		$this->totalRowCount = $nav->getRecordCount();
		$this->enableNextPage = $nav->getCurrentPage() < $nav->getPageCount();

		ob_start();

		$APPLICATION->IncludeComponent(
			"bitrix:main.pagenavigation",
			"grid",
			array(
				"NAV_OBJECT" => $nav,
				"TITLE" => $title,
				"PAGE_WINDOW" => 5,
				"SHOW_ALWAYS" => $showAllways,
				"POST" => $post,
				"TABLE_ID" => $this->table_id,
			),
			false,
			array(
				"HIDE_ICONS" => "Y",
			)
		);

		$this->NavText(ob_get_clean());
	}

	public function getNavSize()
	{
		$gridOptions = new Bitrix\Main\Grid\Options($this->table_id);
		$navParams = $gridOptions->getNavParams();
		return $navParams["nPageSize"];
	}

	public function EditAction()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST" &&
			!empty($_REQUEST["action_button_".$this->table_id]) && check_bitrix_sessid())
		{
			$arrays = array(&$_POST, &$_REQUEST, &$GLOBALS);
			foreach ($arrays as $i => &$array)
			{
				if(is_array($array["FIELDS"]))
				{
					foreach ($array["FIELDS"] as $id => &$fields)
					{
						if(is_array($fields))
						{
							CUtil::decodeURIComponent($fields);
							$keys = array_keys($fields);
							foreach ($keys as $key)
							{
								if(($c = substr($key, 0, 1)) == '~' || $c == '=')
								{
									unset($arrays[$i]["FIELDS"][$id][$key]);
								}
							}
						}
					}
				}
			}
			return true;
		}
		return false;
	}

	public function GroupAction()
	{
		if (!check_bitrix_sessid())
		{
			return false;
		}

		if (is_array($_REQUEST["action"]))
		{
			foreach ($_REQUEST["action"] as $actionKey => $actionValue)
				$_REQUEST[$actionKey] = $actionValue;
		}
		if (!empty($_REQUEST["action_button_".$this->table_id]))
		{
			$_REQUEST["action"] = $_REQUEST["action_button_".$this->table_id];
			$_REQUEST["action_button"] = $_REQUEST["action_button_".$this->table_id];
		}

		if (!empty($_REQUEST["bxajaxid"]))
		{
			global $adminSidePanelHelper;
			$adminSidePanelHelper->setSkipResponse(true);
		}

		if ((empty($_REQUEST["action_all_rows_".$this->table_id]) ||
				$_REQUEST["action_all_rows_".$this->table_id] === "N") && isset($_REQUEST["ID"]))
		{
			if(!is_array($_REQUEST["ID"]))
				$arID = array($_REQUEST["ID"]);
			else
				$arID = $_REQUEST["ID"];

			return $arID;
		}
		else
		{
			return array("");
		}
	}

	public function ActionDoGroup($id, $action_id, $add_params = "")
	{
		$listParams = explode("&", $add_params);
		$addParams = array();
		if ($listParams)
		{
			foreach($listParams as $param)
			{
				$explode = explode("=", $param);
				if ($explode[0] && $explode[1])
				{
					$addParams[$explode[0]] = $explode[1];
				}
			}
		}

		$postParams = array_merge(array(
			"action_button_".$this->table_id => $action_id,
			"ID" => $id
		), $addParams);

		return $this->ActionAjaxPostGrid($postParams);
	}

	public function AddGroupActionTable($arActions, $arParams = array())
	{
		$this->arActions = $arActions;
		$this->arActionsParams = $arParams;
	}

	public function ActionAjaxPostGrid($postParams)
	{
		return "BX.Main.gridManager.getById('".$this->table_id."').instance.reloadTable('POST', ".
			CUtil::PhpToJsObject($postParams).");";
	}

	public function AddFilter(array $filterFields, array &$arFilter)
	{
		$filterOption = new Bitrix\Main\UI\Filter\Options($this->table_id);
		$filterData = $filterOption->getFilter($filterFields);
		$filterable = array();
		$quickSearchKey = "";
		foreach ($filterFields as $filterField)
		{
			if (isset($filterField["quickSearch"]))
			{
				$quickSearchKey = $filterField["quickSearch"].$filterField["id"];
			}
			$filterable[$filterField["id"]] = $filterField["filterable"];
		}

		foreach ($filterData as $fieldId => $fieldValue)
		{
			if ((is_array($fieldValue) && empty($fieldValue)) || (is_string($fieldValue) && strlen($fieldValue) <= 0))
			{
				continue;
			}

			if (substr($fieldId, -5) == "_from")
			{
				$realFieldId = substr($fieldId, 0, strlen($fieldId)-5);
				if (!array_key_exists($realFieldId, $filterable))
				{
					continue;
				}
				if (substr($realFieldId, -2) == "_1")
				{
					$arFilter[$realFieldId] = $fieldValue;
				}
				else
				{
					if (!empty($filterData[$realFieldId."_numsel"]) && $filterData[$realFieldId."_numsel"] == "more")
						$filterPrefix = ">";
					else
						$filterPrefix = ">=";
					$arFilter[$filterPrefix.$realFieldId] = trim($fieldValue);
				}
			}
			elseif (substr($fieldId, -3) == "_to")
			{
				$realFieldId = substr($fieldId, 0, strlen($fieldId)-3);
				if (!array_key_exists($realFieldId, $filterable))
				{
					continue;
				}
				if (substr($realFieldId, -2) == "_1")
				{
					$realFieldId = substr($realFieldId, 0, strlen($realFieldId)-2);
					$arFilter[$realFieldId."_2"] = $fieldValue;
				}
				else
				{
					if (!empty($filterData[$realFieldId."_numsel"]) && $filterData[$realFieldId."_numsel"] == "less")
						$filterPrefix = "<";
					else
						$filterPrefix = "<=";
					$arFilter[$filterPrefix.$realFieldId] = trim($fieldValue);
				}
			}
			else
			{
				if (array_key_exists($fieldId, $filterable))
				{
					$filterPrefix = $filterable[$fieldId];
					$arFilter[$filterPrefix.$fieldId] = $fieldValue;
				}
				if ($fieldId == "FIND" && trim($fieldValue) && $quickSearchKey)
				{
					$arFilter[$quickSearchKey] = $fieldValue;
				}
			}
		}
	}

	public function hasGroupErrors()
	{
		return (bool)(count($this->arGroupErrors));
	}

	public function getGroupErrors()
	{
		$error = "";
		foreach ($this->arGroupErrors as $groupError)
		{
			$error .= " ".$groupError;
		}
		return $error;
	}

	public function setContextSettings(array $settings)
	{
		$this->contextSettings = $settings;
	}

	public function AddAdminContextMenu($aContext=array(), $bShowExcel=true, $bShowSettings=true)
	{
		/** @global CMain $APPLICATION */
		global $APPLICATION;

		$aAdditionalMenu = array();

		if ($bShowExcel)
		{
			if ($this->contextSettings["pagePath"])
			{
				$pageParam = (!empty($_GET) ? http_build_query($_GET, "", "&") : "");
				$pagePath = $this->contextSettings["pagePath"]."?".$pageParam;
				$link = CHTTP::urlAddParams($pagePath, array("mode" => "excel"));
			}
			else
			{
				$link = CHTTP::urlAddParams($APPLICATION->GetCurPageParam(), array("mode" => "excel"));
			}
			$aAdditionalMenu[] = array(
				"TEXT" => "Excel",
				"TITLE" => GetMessage("admin_lib_excel"),
				"LINK" => $link,
				"GLOBAL_ICON"=>"adm-menu-excel",
			);
		}

		if (count($aContext) > 0 || count($aAdditionalMenu) > 0)
			$this->context = new CAdminUiContextMenu($aContext, $aAdditionalMenu);
	}

	//TODO Finalize the function so that it can create a structure of any complexity.
	public function GetGroupAction()
	{
		if (empty($this->arActions))
		{
			return array();
		}

		$actionPanel = array();

		$snippet = new Panel\Snippet();

		$actionList = array(array("NAME" => GetMessage("admin_lib_list_actions"), "VALUE" => ""));
		$skipKey = array("edit", "delete", "for_all");
		foreach ($this->arActions as $actionKey => $action)
		{
			if (in_array($actionKey, $skipKey))
				continue;

			if (is_array($action))
			{
				if (!empty($action["type"]))
				{
					switch ($action["type"])
					{
						case "select":
							$actionList[] = array(
								"NAME" => $action["lable"],
								"VALUE" => $actionKey,
								"ONCHANGE" => array(
									array(
										"ACTION" => Panel\Actions::SHOW,
										"DATA" => array(
											array("ID" => "apply_button")
										)
									),
									array(
										"ACTION" => Panel\Actions::CREATE,
										"DATA" => array(
											array(
												"TYPE" => Panel\Types::DROPDOWN,
												"ID" => "selected_action_{$this->table_id}",
												"NAME" => $action["name"],
												"ITEMS" => $action["items"]
											)
										)
									)
								)
							);
							break;
						case "customJs":
							$actionList[] = array(
								"NAME" => $action["lable"],
								"VALUE" => $actionKey,
								"ONCHANGE" => array(
									array(
										"ACTION" => Panel\Actions::HIDE,
										"DATA" => array(
											array("ID" => "apply_button")
										)
									),
									array(
										"ACTION" => Panel\Actions::CREATE,
										"DATA" => array(
											$snippet->getApplyButton(
												array(
													"ONCHANGE" => array(
														array(
															"ACTION" => Panel\Actions::CALLBACK,
															"DATA" => array(
																array(
																	"JS" => $action["js"]
																)
															)
														)
													)
												)
											)
										)
									)
								)
							);
							break;
					}
				}
			}
			else
			{
				$actionList[] = array(
					"NAME" => $action,
					"VALUE" => $actionKey,
					"ONCHANGE" => Panel\Actions::RESET_CONTROLS,
				);
			}
		}

		$items = array();

		/* Default actions */
		if ($this->arActions["edit"])
			$items[] = $snippet->getEditButton();
		if ($this->arActions["delete"])
			$items[] = $snippet->getRemoveButton();

		/* Action list (select and apply button) */
		if (count($actionList) > 1)
		{
			$items[] = array(
				"TYPE" => Panel\Types::DROPDOWN,
				"ID" => "base_action_select_{$this->table_id}",
				"NAME" => "action_button_{$this->table_id}",
				"ITEMS" => $actionList
			);

			$items[] = $snippet->getApplyButton(
				array(
					"ONCHANGE" => array(
						array(
							"ACTION" => Panel\Actions::CALLBACK,
							"DATA" => array(
								array(
									"JS" => "BX.adminList.SendSelected('{$this->table_id}')"
								)
							)
						)
					)
				)
			);
		}

		if ($this->arActions["for_all"])
			$items[] = $snippet->getForAllCheckbox();

		$actionPanel["GROUPS"][] = array("ITEMS" => $items);

		return $actionPanel;
	}

	public function &AddRow($id = false, $arRes = Array(), $link = false, $title = false)
	{
		$row = new CAdminUiListRow($this->aHeaders, $this->table_id);
		$row->id = $id;
		$row->arRes = $arRes;
		if ($this->isPublicMode)
		{
			$selfFolderUrl = (defined("SELF_FOLDER_URL") ? SELF_FOLDER_URL : "/bitrix/admin/");
			$reqValue = "/".str_replace("/", "\/", $selfFolderUrl)."/i";
			if (!empty($link) && !preg_match($reqValue, $link) && preg_match("/\.php/i", $link))
			{
				$link = $selfFolderUrl.$link;
			}
		}
		$row->link = $link;
		$row->title = $title;
		$row->pList = &$this;
		$row->bEditMode = true;
		$this->aRows[] = &$row;
		return $row;
	}

	/**
	 * The method set the default fields for the filter.
	 *
	 * @param array $fields array("fieldId1", "fieldId2", "fieldId3")
	 */
	public function setDefaultFilterFields(array $fields)
	{
		$filterOptions = new Bitrix\Main\UI\Filter\Options($this->table_id);
		$filterOptions->setFilterSettings(
			"default_filter",
			array("rows" => $fields),
			false
		);
		$filterOptions->save();
	}

	/**
	 * The method set filter presets.
	 *
	 * @param array $filterPresets array("presetId" => array("name" => "presetName", "fields" => array(...)))
	 */
	public function setFilterPresets(array $filterPresets)
	{
		$this->filterPresets = $filterPresets;
		foreach ($filterPresets as $filterPreset)
		{
			if (!empty($filterPreset["current"]))
			{
				$this->currentPreset = $filterPreset;
			}
		}
	}

	public function deletePreset($presetId)
	{
		$options = new Options($this->table_id);
		$options->deleteFilter($presetId);
		$options->save();
	}

	public function DisplayFilter(array $filterFields = array())
	{
		global $APPLICATION;

		$params = array(
			"FILTER_ID" => $this->table_id,
			"GRID_ID" => $this->table_id,
			"FILTER" => $filterFields,
			"FILTER_PRESETS" => $this->filterPresets,
			"ENABLE_LABEL" => true,
			"ENABLE_LIVE_SEARCH" => true
		);

		if ($this->currentPreset)
		{
			$options = new Options($this->table_id, $this->filterPresets);
			$options->setFilterSettings($this->currentPreset["id"], $this->currentPreset, true);
			$options->save();
		}

		if ($this->context)
		{
			$this->context->setFilterContextParam(true);
		}

		if ($this->isPublicMode)
		{
			ob_start();
			?>
				<div class="pagetitle-container pagetitle-flexible-space">
					<?
					$APPLICATION->includeComponent(
						"bitrix:main.ui.filter",
						"",
						$params,
						false,
						array("HIDE_ICONS" => true)
					);
					?>
				</div>
			<?
			$APPLICATION->AddViewContent("inside_pagetitle", ob_get_clean());
		}
		else
		{
			$APPLICATION->SetAdditionalCSS('/bitrix/css/main/grid/webform-button.css');
			?>
			<div class="adm-toolbar-panel-container">
				<div class="adm-toolbar-panel-flexible-space">
					<?
					$APPLICATION->includeComponent(
						"bitrix:main.ui.filter",
						"",
						$params,
						false,
						array("HIDE_ICONS" => true)
					);
					?>
				</div>
				<?
				$this->ShowContext();
				?>
			</div>
			<?
		}

		$this->createFilterSelectorHandlers($filterFields);

		?>
		<script type="text/javascript">
			BX.ready(function () {
				if (!window['filter_<?=$this->table_id?>'] ||
					!BX.is_subclass_of(window['filter_<?=$this->table_id?>'], BX.adminUiFilter))
				{
					window['filter_<?=$this->table_id?>'] = new BX.adminUiFilter('<?=$this->table_id?>',
						<?=CUtil::PhpToJsObject(array())?>);
				}
			});
		</script>
		<?
	}

	private function createFilterSelectorHandlers(array $filterFields = array())
	{
		$selfFolderUrl = (defined("SELF_FOLDER_URL") ? SELF_FOLDER_URL : "/bitrix/admin/");
		foreach ($filterFields as $filterField)
		{
			if (isset($filterField["type"]) && $filterField["type"] !== "custom_entity")
			{
				continue;
			}

			if (isset($filterField["selector"]) && isset($filterField["selector"]["type"]))
			{
				switch ($filterField["selector"]["type"])
				{
					case "user":
						?>
						<script>
							BX.ready(function() {
								if (!window["userFilterHandler_<?=$filterField["id"]?>"])
								{
									var params = {
										filterId: "<?=$this->table_id?>",
										fieldId: "<?=$filterField["id"]?>",
										languageId: "<?=LANGUAGE_ID?>",
										selfFolderUrl: "<?=$selfFolderUrl?>"
									};
									window["userFilterHandler_<?=$filterField["id"]?>"] =
										new BX.adminUserFilterHandler(params);
								}
							});
							if (typeof(SUVsetUserId_<?=$filterField["id"]?>) === "undefined")
							{
								function SUVsetUserId_<?=$filterField["id"]?>(userId)
								{
									if (window["userFilterHandler_<?=$filterField["id"]?>"])
									{
										var adminUserFilterHandler = window["userFilterHandler_<?=$filterField["id"]?>"];
										adminUserFilterHandler.setSelected(userId);
									}
								}
							}
						</script>
						<?
						break;
					case "product":
						?>
						<script>
							BX.ready(function() {
								if (!window["productFilterHandler_<?=$filterField["id"]?>"])
								{
									var params = {
										filterId: "<?=$this->table_id?>",
										fieldId: "<?=$filterField["id"]?>",
										languageId: "<?=LANGUAGE_ID?>",
										publicMode: "<?=($this->isPublicMode ? "Y" : "N")?>",
										selfFolderUrl: "<?=$selfFolderUrl?>"
									};
									window["productFilterHandler_<?=$filterField["id"]?>"] =
										new BX.adminProductFilterHandler(params);
								}
							});
							if (typeof(FillProductFields_<?=$filterField["id"]?>) === "undefined")
							{
								function FillProductFields_<?=$filterField["id"]?>(product)
								{
									if (window["productFilterHandler_<?=$filterField["id"]?>"])
									{
										var adminProductFilterHandler =
											window["productFilterHandler_<?=$filterField["id"]?>"];
										adminProductFilterHandler.closeProductSearchDialog();
										adminProductFilterHandler.setSelected(product["id"], product["name"]);
									}
								}
							}
						</script>
						<?
						break;
				}
			}
		}
	}

	public function DisplayList($arParams = array())
	{
		global $APPLICATION;
		$APPLICATION->SetAdditionalCSS('/bitrix/css/main/grid/webform-button.css');

		foreach(GetModuleEvents("main", "OnAdminListDisplay", true) as $arEvent)
			ExecuteModuleEventEx($arEvent, array(&$this));

		echo $this->sPrologContent;

		$selfFolderUrl = (defined("SELF_FOLDER_URL") ? SELF_FOLDER_URL : "/bitrix/admin/");

		$this->ShowContext();

		$gridParameters = array(
			"GRID_ID" => $this->table_id,
			"AJAX_MODE" => "Y",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_HISTORY" => "N",
			"SHOW_PAGESIZE" => true,
			"AJAX_ID" => CAjax::getComponentID("bitrix:main.ui.grid", ".default", ""),
			"ALLOW_PIN_HEADER" => true
		);

		$actionPanel = $this->GetGroupAction();
		if ($actionPanel)
		{
			$gridParameters["ACTION_PANEL"] = $actionPanel;
		}
		else
		{
			$gridParameters["SHOW_CHECK_ALL_CHECKBOXES"] = false;
			$gridParameters["SHOW_ROW_CHECKBOXES"] = false;
			$gridParameters["SHOW_SELECTED_COUNTER"] = false;
			$gridParameters["SHOW_ACTION_PANEL"] = false;
		}

		$gridOptions = new Bitrix\Main\Grid\Options($gridParameters["GRID_ID"]);
		$gridColumns = $gridOptions->getVisibleColumns();
		if (empty($gridColumns))
			$gridColumns = array_keys($this->aVisibleHeaders);

		$gridParameters["ENABLE_NEXT_PAGE"] = $this->enableNextPage;
		$gridParameters["TOTAL_ROWS_COUNT"] = $this->totalRowCount;
		if ($this->sNavText)
		{
			$gridParameters["NAV_STRING"] = $this->sNavText;
		}
		else
		{
			$gridParameters["SHOW_PAGINATION"] = false;
		}

		$gridParameters["PAGE_SIZES"] = array(
			array("NAME" => "5", "VALUE" => "5"),
			array("NAME" => "10", "VALUE" => "10"),
			array("NAME" => "20", "VALUE" => "20"),
			array("NAME" => "50", "VALUE" => "50"),
			array("NAME" => "100", "VALUE" => "100"),
			array("NAME" => "200", "VALUE" => "200"),
			array("NAME" => "500", "VALUE" => "500")
		);

		$gridParameters["ROWS"] = array();
		foreach ($this->aRows as $row)
		{
			$gridRow = array(
				"id" => $row->id,
				"actions" => $row->aActions
			);

			if ($arParams["default_action"])
			{
				if ($this->isPublicMode)
				{
					if (!empty($row->link))
					{
						$row->link = str_replace("/bitrix/admin/", $selfFolderUrl, $row->link);
					}
				}
				$gridRow["default_action"] = array();
				$gridRow["default_action"]["href"] = htmlspecialcharsback($row->link);
				if ($row->title)
					$gridRow["default_action"]["title"] = $row->title;
			}
			elseif ($row->link)
			{
				$gridRow["default_action"] = array();
				if ($this->isPublicMode)
					$gridRow["default_action"]["onclick"] = "BX.adminSidePanel.onOpenPage('".$row->link."');";
				else
					$gridRow["default_action"]["href"] = htmlspecialcharsback($row->link);
				if ($row->title)
					$gridRow["default_action"]["title"] = $row->title;
			}
			else
			{
				$gridRow["default_action"] = array();
				$gridRow["default_action"]["onclick"] = "";
			}

			foreach ($row->aFields as $fieldId => $field)
			{
				if (!empty($field["edit"]["type"]))
					$this->SetHeaderEditType($fieldId, $field);
			}
			foreach ($gridColumns as $columnId)
			{
				$field = $row->aFields[$columnId];
				if (!is_array($row->arRes[$columnId]))
					$value = trim($row->arRes[$columnId]);
				else
					$value = $row->arRes[$columnId];
				$gridRow["data"][$columnId] = $value;
				switch ($field["view"]["type"])
				{
					case "checkbox":
						if ($value == "Y")
							$value = htmlspecialcharsex(GetMessage("admin_lib_list_yes"));
						else
							$value = htmlspecialcharsex(GetMessage("admin_lib_list_no"));
						break;
					case "select":
						if ($field["edit"]["values"][$value])
							$value = htmlspecialcharsex($field["edit"]["values"][$value]);
						break;
					case "file":
						$arFile = CFile::getFileArray($value);
						if (is_array($arFile))
							$value = htmlspecialcharsex(CHTTP::URN2URI($arFile["SRC"]));
						else
							$value = "";
						break;
					case "html":
						$value = $field["view"]["value"];
						break;
					default:
						$value = htmlspecialcharsex($value);
						break;
				}
				$gridRow["columns"][$columnId] = $value;
			}
			$gridParameters["ROWS"][] = $gridRow;
		}

		$gridParameters["COLUMNS"] = array();
		foreach ($this->aHeaders as $header)
		{
			$header["name"] = $header["content"];
			$gridParameters["COLUMNS"][] = $header;
		}

		$errorMessage = "";
		foreach ($this->arFilterErrors as $error)
			$errorMessage .= " ".$error;
		foreach ($this->arUpdateErrors as $arError)
			$errorMessage .= " ".$arError[0];
		foreach ($this->arGroupErrors as $arError)
			$errorMessage .= " ".$arError[0];
		if ($errorMessage <> "")
		{
			$gridParameters["MESSAGES"] = array(
				array(
					"TYPE" => Bitrix\Main\Grid\MessageType::ERROR,
					"TEXT" => $errorMessage
				)
			);
		}

		$APPLICATION->includeComponent(
			"bitrix:main.ui.grid",
			"",
			$gridParameters,
			false, array("HIDE_ICONS" => "Y")
		);

		echo $this->sEpilogContent;

		$arParams["publicMode"] = $this->isPublicMode;

		?>
		<script type="text/javascript">
			if (!window['<?=$this->table_id?>'] || !BX.is_subclass_of(window['<?=$this->table_id?>'], BX.adminUiList))
			{
				window['<?=$this->table_id?>'] = new BX.adminUiList(
					'<?=$this->table_id?>', <?=CUtil::PhpToJsObject($arParams)?>);
			}
			BX.adminChain.addItems("<?=$this->table_id?>_navchain_div");
		</script>
		<?
	}

	private function ShowContext()
	{
		if ($this->context && !$this->isShownContext)
		{
			$this->isShownContext = true;
			$this->context->Show();
		}
	}

	private function SetHeaderEditType($headerId, $field)
	{
		switch ($field["edit"]["type"])
		{
			case "input":
				$editable = array("TYPE" => Types::TEXT);
				break;
			case "calendar":
				$editable = array("TYPE" => Types::DATE);
				break;
			case "checkbox":
				$editable = array("TYPE" => Types::CHECKBOX);
				break;
			case "select":
				$editable = array(
					"TYPE" => Types::DROPDOWN,
					"items" => $field["edit"]["values"]
				);
				break;
			case "html":
				$editable = array("TYPE" => Types::CUSTOM, "HTML" => $field["edit"]["value"]);
				break;
			default:
				$editable = array("TYPE" => Types::TEXT);
		}

		$this->aHeaders[$headerId]["editable"] = $editable;
	}
}

class CAdminUiListRow extends CAdminListRow
{
	public function addActions($aActions)
	{
		$listActions = array();
		foreach ($aActions as $aAction)
		{
			if (isset($aAction["SEPARATOR"]))
			{
				continue;
			}

			if (!empty($aAction["LINK"]) && empty($aAction["ACTION"]))
			{
				$aAction["href"] = $aAction["LINK"];
			}
			else
			{
				if (preg_match("/BX.adminPanel.Redirect/", $aAction["ACTION"]))
				{
					$explode = explode("'", $aAction["ACTION"]);
					if (!empty($explode[1]))
						$aAction["href"] = $explode[1];
				}
				else
				{
					$aAction["ONCLICK"] = $aAction["ACTION"];
				}
			}

			if ($this->isPublicMode)
			{
				if (!empty($aAction["href"]) &&
					!preg_match("/bitrix\/admin/i", $aAction["href"]) && preg_match("/\.php/i", $aAction["href"]))
				{
					$aAction["href"] = "/bitrix/admin/".$aAction["href"];
				}
			}

			$listActions[] = $aAction;
		}

		$this->aActions = $listActions;
	}
}

class CAdminUiResult extends CAdminResult
{
	private $componentParams = array();

	public function NavStart($nPageSize=20, $bShowAll=true, $iNumPage=false)
	{
		$nPageSize = $this->GetNavSize($this->table_id);

		$nSize = $this->GetNavSize($this->table_id, $nPageSize);

		if(!is_array($nPageSize))
			$nPageSize = array();

		$nPageSize["nPageSize"] = $nSize;
		if($_REQUEST["mode"] == "excel")
			$nPageSize["NavShowAll"] = true;

		$this->nInitialSize = $nPageSize["nPageSize"];

		$this->parentNavStart($nPageSize, $bShowAll, $iNumPage);
	}

	public function GetNavPrint($title, $show_allways=true, $StyleText="", $template_path=false, $arDeleteParam=false)
	{
		$componentObject = null;
		$this->bShowAll = false;
		return $this->getPageNavStringEx(
			$componentObject,
			"",
			"grid",
			false,
			null,
			$this->componentParams
		);
	}

	public function GetNavSize($tableId = false, $nPageSize = 20, $listUrl = '')
	{
		$tableId = $tableId ? $tableId : $this->table_id;
		$gridOptions = new Bitrix\Main\Grid\Options($tableId);
		$navParams = $gridOptions->getNavParams();
		return $navParams["nPageSize"];
	}

	public function setNavigationParams(array $params)
	{
		$gridOptions = new Bitrix\Main\Grid\Options($this->table_id);
		$this->componentParams = array_merge($params, $gridOptions->getNavParams());
	}
}

class CAdminUiContextMenu extends CAdminContextMenu
{
	private $isShownFilterContext = false;

	public function setFilterContextParam($bool)
	{
		$this->isShownFilterContext = $bool;
	}

	public function Show()
	{
		foreach (GetModuleEvents("main", "OnAdminContextMenuShow", true) as $arEvent)
		{
			ExecuteModuleEventEx($arEvent, array(&$this->items));
		}

		if (empty($this->items) && empty($this->additional_items))
		{
			return;
		}


		if ($this->isPublicMode): ob_start(); ?>
		<div class="pagetitle-container pagetitle-align-right-container" style="padding-right: 12px;">
		<? else: ?>
		<? if (!$this->isShownFilterContext): ?>
			<div class="adm-toolbar-panel-container">
				<div class="adm-toolbar-panel-flexible-space">
					<? $this->showBaseButton(); ?>
				</div>
		<? endif ?>
		<div class="adm-toolbar-panel-align-right">
		<? endif;

		$this->showActionButton();

		if ($this->isShownFilterContext || $this->isPublicMode)
		{
			$this->showBaseButton();
		}

		?>
		</div>
		<? if (!$this->isShownFilterContext && !$this->isPublicMode): ?>
		</div>
		<? endif;

		if ($this->isPublicMode)
		{
			global $APPLICATION;
			$APPLICATION->AddViewContent("inside_pagetitle", ob_get_clean());
		}
	}

	private function showUpButton()
	{
		foreach ($this->items as $items)
		{
			if (isset($items["UP"]))
			{
				?>
				<a href="<?=HtmlFilter::encode($items["LINK"])?>" class="adm-up-button">
					<?=HtmlFilter::encode($items["TEXT"])?>
				</a>
				<?
			}
		}
	}

	private function showActionButton()
	{
		if ($this->isPublicMode)
		{
			if (!empty($this->additional_items)):
				$menuUrl = "BX.adminList.showPublicMenu(this, ".HtmlFilter::encode(
					CAdminPopup::PhpToJavaScript($this->additional_items)).");";
			?>
			<div class="webform-small-button webform-small-button-transparent webform-cogwheel" onclick="<?=$menuUrl?>">
				<span class="webform-button-icon"></span>
			</div>
			<?endif;
		}
		else
		{
			if (!empty($this->additional_items)):
				$menuUrl = "BX.adminList.ShowMenu(this, ".HtmlFilter::encode(
						CAdminPopup::PhpToJavaScript($this->additional_items)).");";
			?>
			<div class="adm-toolbar-panel-button webform-small-button webform-small-button-transparent
				webform-cogwheel" onclick="<?=$menuUrl?>">
				<span class="webform-button-icon"></span>
			</div>
			<?endif;
		}
	}

	private function showBaseButton()
	{
		if (!empty($this->items))
		{
			$items = $this->items;
			$firstItem = array_shift($items);
			if (!empty($firstItem["MENU"]))
			{
				$items = array_merge($items, $firstItem["MENU"]);
			}
			if ($this->isPublicMode)
			{
				$menuUrl = "BX.adminList.showPublicMenu(this, ".HtmlFilter::encode(
						CAdminPopup::PhpToJavaScript($items)).");";
			}
			else
			{
				$menuUrl = "BX.adminList.ShowMenu(this, ".HtmlFilter::encode(
						CAdminPopup::PhpToJavaScript($items)).");";
			}
			if (count($items) > 0):?>
			<span class="webform-small-button-separate-wrap adm-toolbar-panel-button">
				<? if (!empty($firstItem["ONCLICK"])): ?>
					<span onclick="<?=HtmlFilter::encode($firstItem["ONCLICK"])?>" class="
						webform-small-button webform-small-button-blue">
					<span class="webform-small-button-icon"></span>
					<span class="webform-small-button-text"><?=HtmlFilter::encode($firstItem["TEXT"])?></span>
					</span>
					<span class="webform-small-button-right-part" onclick="<?=$menuUrl?>"></span>
				<? else: ?>
					<? if (isset($firstItem["DISABLE"])): ?>
					<span class="webform-small-button webform-small-button-blue" onclick="<?=$menuUrl?>">
					<span class="webform-small-button-icon"></span>
					<span class="webform-small-button-text"><?=HtmlFilter::encode($firstItem["TEXT"])?></span>
					</span>
					<span class="webform-small-button-right-part" onclick="<?=$menuUrl?>"></span>
					<? else: ?>
					<a href="<?=HtmlFilter::encode($firstItem["LINK"])?>" class="
					webform-small-button webform-small-button-blue">
					<span class="webform-small-button-icon"></span>
					<span class="webform-small-button-text"><?=HtmlFilter::encode($firstItem["TEXT"])?></span>
					</a>
					<span class="webform-small-button-right-part" onclick="<?=$menuUrl?>"></span>
					<? endif; ?>
				<? endif; ?>
			</span>
			<? else:?>
				<? if (!empty($firstItem["ONCLICK"])): ?>
					<span onclick="<?=HtmlFilter::encode($firstItem["ONCLICK"])?>">
						<span class="webform-small-button webform-small-button-blue bx24-top-toolbar-add
							adm-toolbar-panel-button">
							<?=HtmlFilter::encode($firstItem["TEXT"])?>
						</span>
					</span>
				<? else: ?>
					<a href="<?=HtmlFilter::encode($firstItem["LINK"])?>">
						<span class="webform-small-button webform-small-button-blue bx24-top-toolbar-add
							adm-toolbar-panel-button">
							<?=HtmlFilter::encode($firstItem["TEXT"])?>
						</span>
					</a>
				<? endif; ?>
			<?endif;
		}
	}
}