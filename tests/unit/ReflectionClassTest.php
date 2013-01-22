<?php
namespace itbz\inroute;

class ReflectionClassTest extends \PHPUnit_Framework_TestCase
{
    public function testIsinroute()
    {
        $no = new ReflectionClass('itbz\test\NoInroute');
        $this->assertFalse($no->isInroute());

        $yes = new ReflectionClass('itbz\test\NoConstructor');
        $this->assertTrue($yes->isInroute());
    }

    public function testIsCaller()
    {
        $no = new ReflectionClass('itbz\test\NoInroute');
        $this->assertFalse($no->isCaller());
    }

    public function testIsContainer()
    {
        $no = new ReflectionClass('itbz\test\NoInroute');
        $this->assertFalse($no->isContainer());
    }

    public function testNoConstructor()
    {
        $refl = new ReflectionClass('itbz\test\NoConstructor');
        $this->assertEquals(
            array(),
            $refl->getInjections(),
            'List of injections for class with no constructor should be an empty array'
        );
    }

    public function testGetFactoryName()
    {
        $refl = new ReflectionClass('itbz\test\NoConstructor');
        $this->assertEquals('itbz_test_NoConstructor', $refl->getFactoryName());
    }

    /**
     * @expectedException itbz\inroute\Exception\InjectionException
     */
    public function testInjectionMissing()
    {
        $refl = new ReflectionClass('itbz\test\InjectionMissing');
        $refl->getInjections();
    }

    /**
     * @expectedException itbz\inroute\Exception\InjectionException
     */
    public function testParamMissing()
    {
        $refl = new ReflectionClass('itbz\test\InjectedParameterMissing');
        $refl->getInjections();
    }

    public function testGetSignature()
    {
        $refl = new ReflectionClass('itbz\test\Working');
        $this->assertEquals('$bar, $x, $y', $refl->getSignature());
    }

    public function testGetInjections()
    {
        $refl = new ReflectionClass('itbz\test\Working');
        $expected = array(
            array(
                'name' => '$bar',
                'class' => 'DateTime',
                'array' => false,
                'factory' => 'foobar'
            ),
            array(
                'name' => '$x',
                'class' => '',
                'array' => true,
                'factory' => 'xfactory'
            ),
            array(
                'name' => '$y',
                'class' => '',
                'array' => false,
                'factory' => 'xx'
            )
        );
        $this->assertEquals($expected, $refl->getInjections());
    }

    public function testGetRoutes()
    {
        $refl = new ReflectionClass('itbz\test\Working');
        $routes = $refl->getRoutes();
        $this->assertTrue(is_array($routes));
        $this->assertEquals(2, count($routes));
        $this->assertArrayHasKey('name', $routes[0]);
        $this->assertArrayHasKey('path', $routes[0]);
        $this->assertArrayHasKey('httpmethod', $routes[0]);
        $this->assertTrue(is_array($routes[0]['httpmethod']));
    }
}
