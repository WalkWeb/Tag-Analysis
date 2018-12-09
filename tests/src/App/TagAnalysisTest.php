<?php

namespace Test;

use App\TagAnalysis;
use PHPUnit\Framework\TestCase;

class TagAnalysisTest extends TestCase
{
    /**
     * @dataProvider providerGetAnalysis
     * @param $result
     * @param $string
     */
    public function testGetAnalysis($result, $string)
    {
        $analysis = new TagAnalysis();
        self::assertEquals($result, $analysis->getAnalysis($string));
    }

    /**
     * @return array
     */
    public function providerGetAnalysis()
    {
        return [
            'case1' => [
                'result' => [['tag' => 'a', 'type' => 'double', 'count' => ['count' => 2, 'first' => 1, 'second' => 1], 'validation' => true]
                ],
                'string' => '<a>link</a>',
            ],
            'case2' => [
                'result' => [['tag' => 'a', 'type' => 'double', 'count' => ['count' => 3, 'first' => 2, 'second' => 1], 'validation' => false]
                ],
                'string' => '<a>link</a><a>',
            ],
        ];
    }

}
