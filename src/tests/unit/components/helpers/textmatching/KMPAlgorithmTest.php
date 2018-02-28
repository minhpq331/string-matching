<?php
namespace tests\components\helpers\textmatching;

use tests\components\helpers\textmatching\AlgorithmLogicTest;

class KMPAlgorithmTest extends AlgorithmLogicTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = $this->getMockBuilder('app\components\helpers\textmatching\KMPAlgorithm')
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
