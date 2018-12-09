<?php

namespace App;

/**
 * Анализирует количество тегов в строке, на основе указанных настроек
 *
 * Возвращает массив вида:
 *
 * [
 *     [
 *         [tag] => <html> - тег
 *         [type] => double - тип тега (double - двойной, т.е. у тега должен быть закрывающий тег, single - одиночный)
 *         [count] => [
 *             [count] => 2 - общее количество вхождений в строке
 *             [first] => 1 - количество вхождений открывающего тега
 *             [second] => 1 - количество вхождений закрывающего тега
 *         ]
 *         [validation] => 1 - валидация, для двойных тегов: true - если количество открывающихся и закрывающихся равно,
 *                             false - если их количество не совпадает
 *     ]
 * ...
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
     * @param $string
     * @param $tag
     * @return array
     */
    private function searchTags(string $string, array $tag): array
    {
        $result['tag'] = htmlspecialchars($tag['tag']);
        $result['type'] = $tag['type'];

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
     * @param $string
     * @param $tag
     * @return int
     */
    private function searchSingleTag($string, $tag): int
    {
        $tag = mb_substr($tag, 1);
        $tag = mb_substr($tag, 0, -1);
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
        $tag = mb_substr($tag, 1);
        $tag = mb_substr($tag, 0, -1);
        preg_match_all('{<' . $tag . '(?: [^>]*)?>}', $string, $matches);
        $first = count($matches[0]);
        preg_match_all('{</' . $tag . '(?: [^>]*)?>}', $string, $matches);
        $second = count($matches[0]);

        return ['count' => ($first + $second), 'first' => $first, 'second' => $second];
    }
}
