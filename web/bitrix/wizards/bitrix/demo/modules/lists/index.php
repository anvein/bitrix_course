<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule("lists"))
	return;

include(dirname(__FILE__)."/../iblock/lists-clients.php");

CLists::SetPermission('lists', array(1));
?>