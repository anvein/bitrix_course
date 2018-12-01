<?php
$arPrepItems = [];
if (!empty($arResult)) {
    foreach ($arResult as $key => $item) {
        if ($item['DEPTH_LEVEL'] === 1) {
            $arPrepItems[] = $item;
        } else {
            $arPrepItems[end(array_keys($arPrepItems))]['subitems'][] = $item;
        }
    }
}
$arResult = $arPrepItems;