<?php
namespace tests\components\helpers\textmatching;

use app\components\helpers\textmatching\NaiveAlgorithm;
use tests\components\helpers\textmatching\AlgorithmLogicTest;

class NaiveAlgorithmTest extends AlgorithmLogicTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = new NaiveAlgorithm();
    }

    protected function _after()
    {
    }

    // Test search logic
    public function testSearhUseAlgorithm()
    {
        return parent::testSearhUseAlgorithm();
    }
}
