<?php

namespace App;

/**
 * Class Request
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
        if (!empty($get['url']) ) $this->url = $get['url'];
    }

    /**
     * Проверяет, задан ли url
     *
     * @return bool
     */
    public function url(): bool
    {
        if ($this->url) return true;
        return false;
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
