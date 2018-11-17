<?php
if (!empty($arResult['PROPERTIES']['gallery']['VALUE'])) {
    foreach ($arResult['PROPERTIES']['gallery']['VALUE'] as $key => $photoId) {
        $arPhoto = CFile::GetFileArray($photoId);

        $arResult['PROPERTIES']['photos'][$key]['src'] = $arPhoto['SRC'];
    }
}
