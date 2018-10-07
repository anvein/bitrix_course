<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

require_once($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/interface/admin_lib.php");
define("ADMIN_THEME_ID", CAdminTheme::GetCurrentTheme());

global $adminPage, $adminMenu, $adminChain, $adminAjaxHelper, $adminSidePanelHelper;
$adminPage = new CAdminPage();
$adminAjaxHelper = new CAdminAjaxHelper();
$adminSidePanelHelper = new CAdminSidePanelHelper();
$adminMenu = new CAdminMenu();
$adminChain = new CAdminMainChain("main_navchain");
