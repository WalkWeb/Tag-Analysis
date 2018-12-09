<?php

namespace App;

/**
 * Анализирует количество тегов в строке, на основе указанных настроек
 *
 * Возвращает массив вида:
 *
 * [
 *     [
 *         [tag] => <html> // тег
 *         [type] => double // тип тега (double - двойной, т.е. у тега должен быть закрывающий тег, single - одиночный)
 *         [count] => [
 *             [count] => 2 // общее количество вхождений в строке
 *             [first] => 1 // количество вхождений открывающего тега
 *             [second] => 1 // количество вхождений закрывающего тега
 *         ]
 *         [validation] => true // валидация, для двойных тегов:
 *                              // true - если количество открывающихся и закрывающихся равно,
 *                              // false - если их количество не совпадает
 *     ],
 *     ...
 * ]
 *
 * Class TagAnalysis
 * @package App
 */
class TagAnalysis
{
    private $tags = [];

    /**
     * Подгружаем массив тегов из настроек
     */
    public function __construct()
    {
        $this->tags = require(__DIR__ . '/../../tag_config.php');
    }

    /**
     * Анализирует строку на наличие тегов
     *
     * @param string $string
     * @return array
     */
    public function getAnalysis(string $string): array
    {
        $result = [];

        foreach ($this->tags as $tag) {
            $analysis = $this->searchTags($string, $tag);
            if ($analysis['count']['count'] > 0)  $result[] = $analysis;
        }

        return $result;
    }

    /**
     * Ищет вхождение тега в строку и собирает массив с результатами
     *
     * @param $string
     * @param $tag
     * @return array
     */
    private function searchTags(string $string, array $tag): array
    {
        $result = $tag;

        if ($tag['type'] === 'single') {
            $result['count']['count'] = $this->searchSingleTag($string, $tag['tag']);
            $result['validation'] = true;
        } else {
            $result['count'] = $this->searchDoubleTag($string, $tag['tag']);
            if ($result['count']['first'] === $result['count']['second']) {
                $result['validation'] = true;
            } else {
                $result['validation'] = false;
            }
        }

        return $result;
    }

    /**
     * Поиск одиночного тега (тега, у которого нет закрывающего тега)
     *
     * Можно искать одиночные теги, у которых нет закрывающего символа />, например <br> вместо <br />
     * Но тогда получится, что у нас уже не просто анализ тегов, но еще и анализ синтаксиса.
     *
     * @param $string
     * @param $tag
     * @return int
     */
    private function searchSingleTag($string, $tag): int
    {
        preg_match_all('{<' . $tag . '(?: [^>]*)?>}', $string, $matches);
        return count($matches[0]);
    }

    /**
     * Поиск двойного тега (например <a>...</a>) с отдельным подсчетом сколько раз встречается открывающий, а сколько
     * закрывающий тег.
     *
     * @param $string
     * @param $tag
     * @return array
     */
    private function searchDoubleTag($string, $tag): array
    {
        preg_match_all('{<' . $tag . '(?: [^>]*)?>}', $string, $matches);
        $first = count($matches[0]);
        preg_match_all('{</' . $tag . ' *>}', $string, $matches);
        $second = count($matches[0]);

        return ['count' => ($first + $second), 'first' => $first, 'second' => $second];
    }
}
