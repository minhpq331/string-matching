<?php

namespace app\components\helpers\stringmatching;

use app\components\helpers\stringmatching\NaiveAlgorithm;
use yii\base\NotSupportedException;

/**
 * Algorithm Factory to return a string matching algorithm implemention
 */
class AlgorithmFactory
{
    const ALGORITHM_NAIVE = 'naive';
    const ALGORITHM_KMP = 'kmp';

    public static $ALLOWED_ALGORITHMS = array(
        self::ALGORITHM_NAIVE => 'Naive Algorithm',
        self::ALGORITHM_KMP => 'Knuth-Morris-Pratt Algorithm',
    );

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
            case self::ALGORITHM_KMP:
                return new KMPAlgorithm($options);
                break;
            default:
                throw new NotSupportedException("{$algorithm} is not implemented.");
                break;
        }
    }
}
