<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

//Set options which will overwrite defaults
COption::SetOptionString("statistic", "IMPORTANT_PAGE_PARAMS", "ID, IBLOCK_ID, SECTION_ID, ELEMENT_ID, PARENT_ELEMENT_ID, FID, TID, MID, UID, VOTE_ID, print, goto");
COption::SetOptionString("statistic", "DEFENCE_STACK_TIME", "20");
?>