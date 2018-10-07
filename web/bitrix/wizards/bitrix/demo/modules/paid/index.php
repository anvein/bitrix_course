<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog"))
	return;

include(dirname(__FILE__)."/../e-store/index.php");
include(dirname(__FILE__)."/../iblock/paid-content.php");
?>