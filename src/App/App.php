<?php

namespace App;

class App
{
    /**
     * Принимает Request, и в зависимости от наличия $_GET[url] и какого-либо контента по указанному адресу - возвращает
     * или результат обработки контента, или стартовую страницу, или ошибку.
     *
     * @param Request $request
     * @return string
     */
    public function htmlResponse(Request $request): string
    {
        if ($request->isUrlExist()) {
            $curl = new cURL($request->getUrl());
            if ($curl->isContentExist()) {
                $analysis = new TagAnalysis();
                return View::getResultPage($request->getUrl(), $analysis->getAnalysis($curl->getHtmlContent()));
            } else {
                return View::errorPage('Указан некорректный URL, или сайт недоступен');
            }

        }
        return View::getStartPage();
    }
}
