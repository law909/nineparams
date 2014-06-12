<?php

require_once 'src/ParameterHandler.php';

class ParameterHandlerTest extends PHPUnit_Framework_TestCase {

    protected $tc;

    protected function setUp() {
        $arr = array(
            'params' => array(
                'intparam' => '1',
                'stringparam' => 'almafa'
            ),
            'requestparams' => array(
                'intparam' => '2',
                'stringparam' => 'kortefa'
            )
        );
        $this->ph = new \nineparams\ParameterHandler($arr);
    }

    public function testGetIntParam() {
        $p = $this->ph->getIntParam('intparam');

        $this->assertInternalType('int', $p);
        $this->assertSame(1, $p);
    }

    public function testGetStringParam() {
        $p = $this->ph->getStringParam('stringparam');

        $this->assertInternalType('string', $p);
        $this->assertSame('almafa', $p);
    }

    public function testGetIntReqParam() {
        $p = $this->ph->getIntRequestParam('intparam');

        $this->assertInternalType('int', $p);
        $this->assertSame(2, $p);
    }

    public function testGetStringReqParam() {
        $p = $this->ph->getStringRequestParam('stringparam');

        $this->assertInternalType('string', $p);
        $this->assertSame('kortefa', $p);
    }

}