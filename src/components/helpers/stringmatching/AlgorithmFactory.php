<?php

namespace components\services\stringmatching;

use yii\base\NotSupportedException;

/**
 * Algorithm Factory to return a string matching algorithm implemention
 */
class AlgorithmFactory
{
    const ALGORITHM_NAIVE = 'naive';

    /**
     * Make an instance of BaseStringMatchingAlgorithm based on selected algorithm
     * @param  string                       $algorithm  Algorithm name
     * @param  array                        $options    Options to init Algorithm
     * @return BaseStringMatchingAlgorithm
     */
    public static function make($algorithm, $options)
    {
        switch ($algorithm) {
            case self::ALGORITHM_NAIVE:
                return new NaiveAlgorithm($options);
                break;

            default:
                throw new NotSupportedException("{$algorithm} is not implemented.");
                break;
        }
    }
}
