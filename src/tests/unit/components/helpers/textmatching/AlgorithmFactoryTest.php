<?php
namespace tests\components\helpers\textmatching;

use app\components\helpers\textmatching\AlgorithmFactory;
use app\components\helpers\textmatching\BaseTextMatchingAlgorithm;
use app\components\helpers\textmatching\NotImplementedAlgorithmException;

class AlgorithmFactoryTest extends \Codeception\Test\Unit
{
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

    // tests making algorithm
    public function testMake()
    {
        foreach (AlgorithmFactory::$ALLOWED_ALGORITHMS as $algorithmKey => $algorithmName) {
            $algorithm = AlgorithmFactory::make($algorithmKey);
            $this->assertTrue($algorithm instanceof BaseTextMatchingAlgorithm);
        }

        $this->tester->expectException(NotImplementedAlgorithmException::class, function () {
            $algorithm = AlgorithmFactory::make('unknown');
        });
    }
}
