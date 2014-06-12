<?php

require_once 'src/TypeConverter.php';

class TypeConverterTest extends PHPUnit_Framework_TestCase {

    protected $tc;

    protected function setUp() {
        $this->tc = new \nineparams\TypeConverter();
    }

    public function testToBool() {
        $this->assertInternalType('bool', $this->tc->toBool('false'));
        $this->assertInternalType('bool', $this->tc->toBool('off'));
        $this->assertInternalType('bool', $this->tc->toBool('no'));
        $this->assertInternalType('bool', $this->tc->toBool('not'));
        $this->assertInternalType('bool', $this->tc->toBool(''));
        $this->assertInternalType('bool', $this->tc->toBool(false));
        $this->assertInternalType('bool', $this->tc->toBool(null));
        $this->assertInternalType('bool', $this->tc->toBool(0));
        $this->assertInternalType('bool', $this->tc->toBool(array()));

        $this->assertInternalType('bool', $this->tc->toBool('on'));
        $this->assertInternalType('bool', $this->tc->toBool('true'));
        $this->assertInternalType('bool', $this->tc->toBool('yes'));
        $this->assertInternalType('bool', $this->tc->toBool(true));
        $this->assertInternalType('bool', $this->tc->toBool(1));
        $this->assertInternalType('bool', $this->tc->toBool(array('a', 4)));


        $this->assertFalse($this->tc->toBool('false'));
        $this->assertFalse($this->tc->toBool('off'));
        $this->assertFalse($this->tc->toBool('no'));
        $this->assertFalse($this->tc->toBool('not'));
        $this->assertFalse($this->tc->toBool(false));
        $this->assertFalse($this->tc->toBool(null));
        $this->assertFalse($this->tc->toBool(0));
        $this->assertFalse($this->tc->toBool(''));
        $this->assertFalse($this->tc->toBool(array()));

        $this->assertTrue($this->tc->toBool('on'));
        $this->assertTrue($this->tc->toBool('true'));
        $this->assertTrue($this->tc->toBool('yes'));
        $this->assertTrue($this->tc->toBool(true));
        $this->assertTrue($this->tc->toBool(1));
        $this->assertTrue($this->tc->toBool(array('a', 4)));

    }

    public function testToInt() {
        $this->assertInternalType('int', $this->tc->toInt(null));
        $this->assertInternalType('int', $this->tc->toInt('0'));
        $this->assertInternalType('int', $this->tc->toInt('a'));
        $this->assertInternalType('int', $this->tc->toInt('1'));
        $this->assertInternalType('int', $this->tc->toInt('1.2'));
        $this->assertInternalType('int', $this->tc->toInt(1));
        $this->assertInternalType('int', $this->tc->toInt(1.2));
        $this->assertInternalType('int', $this->tc->toInt(array()));
        $this->assertInternalType('int', $this->tc->toInt(array('a', 4)));

        $this->assertSame(0, $this->tc->toInt(null));
        $this->assertSame(0, $this->tc->toInt('0'));
        $this->assertSame(0, $this->tc->toInt('a'));
        $this->assertSame(1, $this->tc->toInt('1'));
        $this->assertSame(1, $this->tc->toInt('1.2'));
        $this->assertSame(1, $this->tc->toInt(1));
        $this->assertSame(1, $this->tc->toInt(1.2));
        $this->assertSame(0, $this->tc->toInt(array()));
        $this->assertSame(1, $this->tc->toInt(array('a', 4)));
    }

    public function testToFloat() {
        $this->assertInternalType('float', $this->tc->toFloat(null));
        $this->assertInternalType('float', $this->tc->toFloat('0'));
        $this->assertInternalType('float', $this->tc->toFloat('a'));
        $this->assertInternalType('float', $this->tc->toFloat('1'));
        $this->assertInternalType('float', $this->tc->toFloat('1.2'));
        $this->assertInternalType('float', $this->tc->toFloat(1));
        $this->assertInternalType('float', $this->tc->toFloat(1.2));
        $this->assertInternalType('float', $this->tc->toFloat(array()));
        $this->assertInternalType('float', $this->tc->toFloat(array('a', 4)));

        $this->assertSame(0.0, $this->tc->toFloat(null));
        $this->assertSame(0.0, $this->tc->toFloat('0'));
        $this->assertSame(0.0, $this->tc->toFloat('a'));
        $this->assertSame(1.0, $this->tc->toFloat('1'));
        $this->assertSame(1.2, $this->tc->toFloat('1.2'));
        $this->assertSame(1.0, $this->tc->toFloat(1));
        $this->assertSame(1.2, $this->tc->toFloat(1.2));
        $this->assertSame(0.0, $this->tc->toFloat(array()));
        $this->assertSame(1.0, $this->tc->toFloat(array('a', 4)));
    }

    public function testToString() {
        $this->assertInternalType('string', $this->tc->toString(null));
        $this->assertInternalType('string', $this->tc->toString(0));
        $this->assertInternalType('string', $this->tc->toString(1));
        $this->assertInternalType('string', $this->tc->toString(1.2));
        $this->assertInternalType('string', $this->tc->toString(array()));
        $this->assertInternalType('string', $this->tc->toString(array('a', 4)));
        $this->assertInternalType('string', $this->tc->toString('a'));

        $this->assertSame('', $this->tc->toString(null));
        $this->assertSame('0', $this->tc->toString(0));
        $this->assertSame('1', $this->tc->toString(1));
        $this->assertSame('1.2', $this->tc->toString(1.2));
        $this->assertSame('', $this->tc->toString(array()));
        $this->assertSame('', $this->tc->toString(array('a', 4)));
        $this->assertSame('a', $this->tc->toString('a'));
    }

    public function testToArray() {
        $this->assertInternalType('array', $this->tc->toArray(null));
        $this->assertInternalType('array', $this->tc->toArray(array()));
        $this->assertInternalType('array', $this->tc->toArray(array('a', 4)));
        $this->assertInternalType('array', $this->tc->toArray(false));
        $this->assertInternalType('array', $this->tc->toArray(1));
        $this->assertInternalType('array', $this->tc->toArray('a'));

        $this->assertSame(array(), $this->tc->toArray(null));
        $this->assertSame(array(), $this->tc->toArray(array()));
        $this->assertSame(array('a', 4), $this->tc->toArray(array('a', 4)));
        $this->assertSame(array(false), $this->tc->toArray(false));
        $this->assertSame(array(1), $this->tc->toArray(1));
        $this->assertSame(array('a'), $this->tc->toArray('a'));
    }

}