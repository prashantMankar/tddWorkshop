<?php 

namespace phpreboot\tddworkshop;

use phpreboot\tddworkshop\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    private $calculator;

    public function setUp()
    {
        $this->calculator = new Calculator();
    }

    public function tearDown()
    {
        $this->calculator = null;
    }

    public function testAddReturnsAnInteger()
    {
        $result = $this->calculator->add();

        $this->assertInternalType('integer', $result, 'Result of `add` is not an integer.');
    }
    
    public function testAddWithoutParameterReturnsZero() 
    {
        $result = $this->calculator->add();
        $this->assertSame(0, $result, 'Empty string on add do not return 0');
    }
    
    public function testAddWithSingleNumberReturnsSameNumber()
    {
        $result = $this->calculator->add('3');
        $this->assertSame(3, $result, 'Add with single number do not returns same number');
    }
    
    /**
     * Test find the correct sum with more than two numbers
     * 
     * @dataProvider numberProvider
     */
    public function testAddWithTwoParametersReturnsTheirSum($numbers, $expectedResult)
    {
        $result = $this->calculator->add($numbers);

        $this->assertSame($expectedResult, $result, 'Add with multiple parameter do not returns correct sum');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNonStringParameterThrowsException() {
        $this->calculator->add(5, 'Integer parameter do not throw error');
    }
    
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNonNumbersThrowException()
    {
        $this->calculator->add('1,a', 'Invalid parameter do not throw exception');
    }

    /**
     * Sum of number provider for multiple parameter 
     */
    public function numberProvider()
    {
        return array(
            array('', 0),
            array('1', 1),
            array('2,3', 5),
            array('4,5,6', 15),
            array('2,3,4,5', 14),
            array('4,7,3,4,7,3,5,6,7,4,3,2,5,7,5,3,4,6,7,8,9,5,5,5,4,3,2', 133),
        );
    }
    
    /**
     * Test for checking new line character as seprator
     */
    public function testAddWithNewLineSeprator()
    {
        $result = $this->calculator->add('3\n2,5', 'Integer parameter do not throw error');
        
        $this->assertSame(10, $result, 'Add will not accept the new line character');
    }
    
    /**
     * Test for Invalid seprator specified
     * 
     * @expectedException InvalidArgumentException
     */
    public function testAddWithDifferentSeprator()
    {
        $result = $this->calculator->add('3\n2:5', 'Integer parameter do not throw error');
    }
}