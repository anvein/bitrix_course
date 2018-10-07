<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CopyDirFiles(
	$wizardPath."/public_files/".LANGUAGE_ID, 
	$_SERVER["DOCUMENT_ROOT"],
	$rewrite = false,
	$recursive = true
);

?>