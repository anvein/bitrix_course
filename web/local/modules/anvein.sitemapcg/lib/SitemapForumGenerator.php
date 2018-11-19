<?php

namespace Anvein\SitemapCG;

use Bitrix\Seo\SitemapForum;

class SitemapForumGenerator extends SitemapForum
{
    /**
     * Обновление sitemap при добавлении темы
     */
    public static function addTopic($arg)
    {
        parent::addTopic($arg);
    }

    /**
     * Обновление sitemap при обновлении темы
     */
    public static function updateTopic($arg)
    {
        parent::updateTopic($arg);
    }

    /**
     * Обновление sitemap при удалении темы
     */
    public static function deleteTopic($arg)
    {
        parent::deleteTopic($arg);
    }
}