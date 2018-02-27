<?php
namespace tests\components\helpers\stringmatching;

class BaseStringMatchingAlgorithmTest extends \Codeception\Test\Unit
{
    private $model;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = $this->getMockForAbstractClass('app\components\helpers\stringmatching\BaseStringMatchingAlgorithm');
    }

    protected function _after()
    {
    }

    /**
     * Check if constructor set right config
     */
    public function testConstructor()
    {
        $options = array(
            'matchMultiple' => false,
            'caseSensitive' => true,
        );
        $model = $this->getMockBuilder('app\components\helpers\stringmatching\BaseStringMatchingAlgorithm')
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();

        $this->assertEquals($model->matchMultiple, !$options['matchMultiple']);
        $this->assertEquals($model->caseSensitive, !$options['caseSensitive']);

        $reflectedClass = new \ReflectionClass('app\components\helpers\stringmatching\BaseStringMatchingAlgorithm');
        $reflectedClass->getConstructor()->invoke($model, $options);

        $this->assertEquals($model->matchMultiple, $options['matchMultiple']);
        $this->assertEquals($model->caseSensitive, $options['caseSensitive']);
    }

    /**
     * Test validate input
     */
    public function testValidateInput()
    {
        $this->model->baseString = array();
        $this->model->pattern = 'valid';
        $this->assertFalse($this->tester->invokeMethod($this->model, 'validateInput'));

        $this->model->baseString = 'valid';
        $this->model->pattern = null;
        $this->assertFalse($this->tester->invokeMethod($this->model, 'validateInput'));

        $this->model->baseString = '';
        $this->model->pattern = 'valid';
        $this->assertFalse($this->tester->invokeMethod($this->model, 'validateInput'));

        $this->model->baseString = 'valid';
        $this->model->pattern = '';
        $this->assertFalse($this->tester->invokeMethod($this->model, 'validateInput'));

        // correct values
        $this->model->baseString = 'valid';
        $this->model->pattern = 'valid';
        $this->assertTrue($this->tester->invokeMethod($this->model, 'validateInput'));
    }

    /**
     * Test prepare input
     */
    public function testPrepareInput()
    {
        $stringWithUpperCaseLetter = 'stringWithUpperCaseLetter';

        $this->model->caseSensitive = false;
        $this->model->baseString = $stringWithUpperCaseLetter;
        $this->model->pattern = $stringWithUpperCaseLetter;
        $this->tester->invokeMethod($this->model, 'prepareInput');
        $this->assertEquals($this->model->baseString, strtolower($stringWithUpperCaseLetter));
        $this->assertEquals($this->model->pattern, strtolower($stringWithUpperCaseLetter));

        $this->model->caseSensitive = true;
        $this->model->pattern = $stringWithUpperCaseLetter;
        $this->model->baseString = $stringWithUpperCaseLetter;
        $this->tester->invokeMethod($this->model, 'prepareInput');
        $this->assertEquals($this->model->baseString, $stringWithUpperCaseLetter);
        $this->assertEquals($this->model->pattern, $stringWithUpperCaseLetter);
    }

    /**
     * Test search funtion
     */
    public function testSearch()
    {
        $this->model->expects($this->once())
            ->method('searchUseAlgorithm')
            ->will($this->returnValue(array(2)));

        $this->assertEquals($this->model->search('baseString', 'pattern'), array(2));
    }
}
