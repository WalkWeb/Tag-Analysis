<?php

namespace Test;

use App\cURL;
use PHPUnit\Framework\TestCase;

class cURLTest extends TestCase
{
    /**
     * @dataProvider providerIsContentExist
     * @param $result
     * @param $url
     */
    public function testIsContentExist($url, $result): void
    {
        $curl = new cURL($url);

        self::assertEquals($result, $curl->isContentExist());
    }

    /**
     * @return array
     */
    public function providerIsContentExist()
    {
        return [
            'case1' => ['url' => 'http://ya.ru/', 'result' => true],
            'case2' => ['url' => 'incorrect_url', 'result' => false],
        ];
    }
}