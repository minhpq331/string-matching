<?php
namespace components\helpers\stringmatching;

use tests\components\helpers\stringmatching\AlgorithmLogicTest;

class KMPAlgorithmTest extends AlgorithmLogicTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = $this->getMockBuilder('app\components\helpers\stringmatching\KMPAlgorithm')
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
