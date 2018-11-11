<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<div class="broadcast-list js-broadcast-list">
    <div id="LB24">
        <div class="lb24-liveblog-container">
            <div class="lb24-default-container">
                <div>
                    <?php if (!empty($arResult['items'])): ?>
                        <?php foreach ($arResult['items'] as $item): ?>
                            <div class="lb24-default-list-item lb24-default-list-complete-item">
                                <div class="lb24-default-list-item-header">
                                    <?php if (!empty($item['UF_DATE'])): ?>
                                        <div class="lb24-default-list-item-date">
                                            <?= $item['UF_DATE'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="lb24-default-list-item-editor">
                                        <a>
                                            <?php if (!empty($item['author_image_src'])): ?>
                                                <img src="<?= $item['author_image_src'] ?>" alt="BinaryDistrict" title="" />
                                            <?php endif; ?>
                                            <?php if (!empty($item['UF_AUTHOR_NAME'])): ?>
                                                <span><?= $item['UF_AUTHOR_NAME'] ?></span>
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="lb24-default-list-item-content">
                                    <div class="lb24-component-content">
                                        <p>
                                            <span class="quill-hashtag">
                                                ﻿<span contenteditable="false">
                                                    <span>
                                                        <?= $item['UF_CONTENT'] ?>
                                                    </span>
                                                </span>﻿
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
