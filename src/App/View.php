<?php

namespace App;

class View
{
    /**
     * Если в $_GET нет url - отображает стартовую страницу
     */
    public static function getStartPage(): string
    {
        return
        '<div class="content">
            <h1>URL-страницы для анализа</h1>
            <form action="/" method="get">
                <input name="url" type="text">
                <button type="submit">Анализировать</button>
            </form>
        </div>';
    }

    /**
     * Собирает HTML-контент для отображения результата анализа тегов
     *
     * @param string $url
     * @param array $analysis
     * @return string
     */
    public static function getResultPage(string $url, array $analysis): string
    {
        $content = '<div class="content">
                        <h1>URL-страницы для анализа</h1>
                        <form action="/" method="get">
                            <input name="url" type="text">
                            <button type="submit">Анализировать</button>
                        </form>
                        
                        <h1>Результат анализа: ' . $url . '</h1><div class="analysis">';

        foreach ($analysis as $value) {
            $type = ($value['type'] === 'single') ? 'Одиночный' : 'Двойной';

            if ($value['type'] === 'single') {
                $number = '<div class="tag_elemet tag_single"><p>Количество:<br /><span class="big">' . $value['count']['count'] . '</span></p></div>';
            } else {
                $number = '<div class="tag_elemet tag_first"><p>Открывающих:<br /><span class="big">' . $value['count']['first'] . '</span></p></div>
                           <div class="tag_elemet tag_second"><p>Закрывающих:<br /><span class="big">' . $value['count']['second'] . '</span></p></div>';
            }

            if ($value['validation']) {
                $content .=
                    '<div class="tag green">
                        <div class="tag_elemet tag_title"><p>Тег:<br /><span class="big green">&lt;' . $value['tag'] . '&gt;</span></p></div>
                        <div class="tag_elemet tag_type"><p>Тип:<br /><span class="big">' . $type . '</span></p></div>
                        ' . $number . '
                        <div class="tag_elemet tag_status"><p><span class="big green">ОК</span></p></div>
                    </div>';
            } else {
                $content .=
                    '<div class="tag red">
                        <div class="tag_elemet tag_title"><p>Тег:<br /><span class="big red">&lt;' . $value['tag'] . '&gt;</span></p></div>
                        <div class="tag_elemet tag_type"><p>Тип:<br /><span class="big">' . $type . '</span></p></div>
                        ' . $number . '
                        <div class="tag_elemet tag_status"><p><span class="big red">Ошибка</span></p></div>
                    </div>';
            }
        }

        return $content . '</div></div>';
    }

    /**
     * Возвращает HTML-контент для отображения страницы с ошибкой
     *
     * @param string $message
     * @return string
     */
    public static function errorPage(string $message): string
    {
        $placeholder = $_GET['url'] ?? '';

        return
            '<div class="content">
                <h1>URL-страницы для анализа</h1>
                <p class="error">' . $message . '</p>
                <form action="/" method="get">
                    <input name="url" type="text" value="' . $placeholder . '">
                    <button type="submit">Анализировать</button>
                </form>
            </div>';
    }
}
