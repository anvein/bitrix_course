<?php

if (!empty($arResult['items'])) {
    foreach ($arResult['items'] as $key => $item) {
        if (!empty($item['UF_AUTHOR_IMAGE'])) {
            $img = CFile::ResizeImageGet(
                $item['UF_AUTHOR_IMAGE'],
                [
                    'width' => 37,
                    'height' => 39,
                ],
                BX_RESIZE_IMAGE_EXACT,
                false,
                [],
                false,
                87
            );

            $arResult['items'][$key]['author_image_src'] = !empty($img['src']) ? $img['src'] : null;
        }

        if (!empty($item['UF_IMAGE'])) {
            $img = CFile::ResizeImageGet(
                $item['UF_IMAGE'],
                [
                    'width' => 716,
                    'height' => 400,
                ],
                BX_RESIZE_IMAGE_EXACT,
                false,
                [],
                false,
                87
            );

            $arResult['items'][$key]['image_src'] = !empty($img['src']) ? $img['src'] : null;
        }
    }
}