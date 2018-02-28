<?php
namespace tests\components\helpers\textmatching;

use app\components\helpers\textmatching\KMPAlgorithm;
use tests\components\helpers\textmatching\AlgorithmLogicTest;

class KMPAlgorithmTest extends AlgorithmLogicTest
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = new KMPAlgorithm();
    }

    protected function _after()
    {
    }
}
