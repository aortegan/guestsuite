<?php

// tests/Util/HelpersTest.php
namespace App\Tests\Util;

use App\Util\Helpers;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function testAverage()
    {
        $helpers = new Helpers();
        $values = array(1,2,3);
        $result = $helpers->average($values);

        $this->asseertEquals(2,$result);
    }
}