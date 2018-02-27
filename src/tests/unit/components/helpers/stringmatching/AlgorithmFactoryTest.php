<?php
namespace components\helpers\stringmatching;

use app\components\helpers\stringmatching\AlgorithmFactory;
use app\components\helpers\stringmatching\BaseStringMatchingAlgorithm;
use app\components\helpers\stringmatching\NotImplementedAlgorithmException;

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
            $this->assertTrue($algorithm instanceof BaseStringMatchingAlgorithm);
        }

        $this->tester->expectException(NotImplementedAlgorithmException::class, function () {
            $algorithm = AlgorithmFactory::make('unknown');
        });
    }
}
