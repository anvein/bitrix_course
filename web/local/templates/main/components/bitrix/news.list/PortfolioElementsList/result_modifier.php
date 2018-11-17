<?php

if (!empty($arResult['ITEMS'])) {
    $arElementsIds = [];
    foreach ($arResult['ITEMS'] as  $arItem) {
        if (isset($arItem['ID'])) {
            $arElementsIds[] = $arItem['ID'];
        }
    }

    $dbSections = CIBlockElement::GetElementGroups($arElementsIds);
    $arSections = [];
    while ($el = $dbSections->Fetch()) {
        $arSections[] = $el;
    }


    foreach ($arResult['ITEMS'] as $itemKey => $arItem) {
        // Получение Названия основного раздела
        if (isset($arItem['IBLOCK_SECTION_ID'])) {
            $searchSectId = $arItem['IBLOCK_SECTION_ID'];

            foreach ($arSections as $section) {
                if ($section['ID'] === $searchSectId) {
                    $arResult['ITEMS'][$itemKey]['SECTION_NAME'] = $section['NAME'];
                }
            }
        }

        if (!isset($arResult['ITEMS'][$itemKey]['SECTION_NAME'])) {
            $arResult['ITEMS'][$itemKey]['SECTION_NAME'] = '';
        }

        // Получение кодов разделов для элемента
        if (isset($arItem['ID'])) {
            $arElementSectionsCodes = [];
            foreach ($arSections as $section) {
                if ($arItem['ID'] == $section['IBLOCK_ELEMENT_ID']) {
                    $arElementSectionsCodes[] = $section['CODE'];
                }
            }

            $arResult['ITEMS'][$itemKey]['SECTIONS_CODES'] = implode(' ', $arElementSectionsCodes);
        } else {
            $arResult['ITEMS'][$itemKey]['SECTIONS_CODES'] = '';
        }
    }
}