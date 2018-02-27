<?php
namespace tests\components\helpers\stringmatching;

class AlgorithmLogicTest extends \Codeception\Test\Unit
{
    protected $model;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // Test search logic
    protected function testSearhUseAlgorithm()
    {
        if ($this->model === null) {
            return;
        }
        $this->model->baseString = 'google is a search engine service, google is also an engine for a lot of other services and tools';

        $this->model->pattern = 'google';
        $this->assertEquals(array(1, 36), $this->tester->invokeMethod($this->model, 'searchUseAlgorithm'));

        $this->model->pattern = 'oo';
        $this->assertEquals(array(2, 37, 94), $this->tester->invokeMethod($this->model, 'searchUseAlgorithm'));

        $this->model->pattern = 'x';
        $this->assertEquals(array(), $this->tester->invokeMethod($this->model, 'searchUseAlgorithm'));

        $this->model->pattern = 'a';
        $this->assertEquals(array(11, 15, 46, 51, 65, 89), $this->tester->invokeMethod($this->model, 'searchUseAlgorithm'));
    }
}
