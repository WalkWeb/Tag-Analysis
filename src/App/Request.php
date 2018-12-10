<?php

namespace App;

/**
 * Что-то на подобии обычного Request'а во фреймворках, только в 1000 раз упрощенное - только то, что нужно для текущего
 * проекта.
 *
 * @package App
 */
class Request
{
    /** @var null */
    private $url = null;

    /**
     * Request constructor.
     * @param $get
     */
    public function __construct($get)
    {
        if (!empty($get['url'])) $this->url = $get['url'];
    }

    /**
     * Проверяет, задан ли url
     *
     * @return bool
     */
    public function isUrlExist(): bool
    {
        return !empty($this->url);
    }

    /**
     * Возвращает url
     *
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }
}
