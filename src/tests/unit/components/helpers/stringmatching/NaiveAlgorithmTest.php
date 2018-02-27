<?php
namespace components\helpers\stringmatching;

use tests\components\helpers\stringmatching\AlgorithmLogicTest;

class NaiveAlgorithmTest extends AlgorithmLogicTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = $this->getMockBuilder('app\components\helpers\stringmatching\NaiveAlgorithm')
            ->getMock();
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
