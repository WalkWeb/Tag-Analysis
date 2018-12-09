<?php

namespace App;

use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * @dataProvider providerIsUrlExist
     * @param $result
     * @param $get
     */
    public function testIsUrlExist($result, $get): void
    {
        $request = new Request($get);
        self::assertEquals($result, $request->isUrlExist());
    }

    /**
     * @return array
     */
    public function providerIsUrlExist()
    {
        return [
            'case1' => ['result' => false, 'get' => []],
            'case2' => ['result' => true, 'get' => ['url' => 'https://www.google.ru/']],
        ];
    }

    /**
     * @dataProvider providerGetUrl
     * @param $result
     * @param $get
     */
    public function testGetUrl($result, $get): void
    {
        $request = new Request($get);
        self::assertEquals($result, $request->getUrl());
    }

    /**
     * @return array
     */
    public function providerGetUrl()
    {
        return [
            'case1' => ['result' => null, 'get' => []],
            'case2' => ['result' => 'https://www.google.ru/', 'get' => ['url' => 'https://www.google.ru/']],
        ];
    }
}
