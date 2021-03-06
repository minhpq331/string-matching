<?php
namespace tests\components\helpers\textmatching;

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
    public function testSearhUseAlgorithm()
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

    public function testSearch()
    {
        if ($this->model === null) {
            return;
        }

        $baseString = 'Google is a search engine service, google is also an engine for a lot of other services and tools';

        $pattern = 'google';
        $this->assertEquals(array(1, 36), $this->model->search($baseString, $pattern));

        $pattern = 'Google';
        $this->assertEquals(array(1, 36), $this->model->search($baseString, $pattern));

        $pattern = 'oo';
        $this->assertEquals(array(2, 37, 94), $this->model->search($baseString, $pattern));

        $pattern = 'Oo';
        $this->assertEquals(array(2, 37, 94), $this->model->search($baseString, $pattern));

        $pattern = 'a';
        $this->assertEquals(array(11, 15, 46, 51, 65, 89), $this->model->search($baseString, $pattern));

        $pattern = 'X';
        $this->assertEquals(array(), $this->model->search($baseString, $pattern));

        $pattern = 'Sx';
        $this->assertEquals(array(), $this->model->search($baseString, $pattern));

        $baseString = 'abc';
        $pattern = 'abcdef';
        $this->assertEquals(array(), $this->model->search($baseString, $pattern));

        $pattern = '';
        $pattern = '';
        $this->assertEquals(array(), $this->model->search($baseString, $pattern));

        // test search options
        $this->model->caseSensitive = false;
        $this->model->matchMultiple = false;

        $baseString = 'Google g';
        $pattern = 'g';
        $this->assertEquals(array(1), $this->model->search($baseString, $pattern));

        $this->model->matchMultiple = true;
        $this->assertEquals(array(1, 4, 8), $this->model->search($baseString, $pattern));

        $this->model->caseSensitive = true;
        $this->assertEquals(array(4, 8), $this->model->search($baseString, $pattern));

        $this->model->matchMultiple = false;
        $this->assertEquals(array(4), $this->model->search($baseString, $pattern));

    }
}
