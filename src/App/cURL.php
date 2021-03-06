<?php

namespace App;

/**
 * Класс получает (если это возможно) html-контент указанного сайта, с использованием cURL
 *
 * @package App
 */
class cURL
{
    private $htmlContent = null;

    /**
     * Принимает URL, обрабатывает его, и если по указанному адресу есть страница - заполняет htmlContent её содержимым
     *
     * Примечание:
     * Валидация пользовательских URL и содержимого ответа - отдельная большая тема. Для простоты в текущем примере
     * URL проверяется следующим образом - по указанному адресу отправляется curl-запрос, и если мы получили какой-то
     * ответ - значит все ок. Иначе - пользователь указан некорректный URL или сайт недоступен.
     *
     * cURL constructor.
     * @param $url
     */
    public function __construct($url)
    {
        $content = $this->runCurl($url);
        if ($url !== false && $url !== '') {
            $this->htmlContent = $content;
        }
    }

    /**
     * Проверяет, есть ли htmlContent
     *
     * @return bool
     */
    public function isContentExist(): bool
    {
        return !empty($this->htmlContent);
    }

    /**
     * Возвращает htmlContent
     *
     * @return null|string
     */
    public function getHtmlContent(): ?string
    {
        return $this->htmlContent;
    }

    /**
     * Делает curl-запрос по указанному URL и возвращает ответ
     *
     * @param $url
     * @return null|string
     */
    private function runCurl($url): ?string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
