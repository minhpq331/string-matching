<?php

namespace app\components\helpers\textmatching;

use app\components\helpers\textmatching\NaiveAlgorithm;
use app\components\helpers\textmatching\NotImplementedAlgorithmException;

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
     * Make an instance of BaseTextMatchingAlgorithm based on selected algorithm
     * @param  string                       $algorithm  Algorithm name
     * @param  array                        $options    Options to init Algorithm
     * @return BaseTextMatchingAlgorithm
     */
    public static function make($algorithm, $options = array())
    {
        switch ($algorithm) {
            case self::ALGORITHM_NAIVE:
                return new NaiveAlgorithm($options);
                break;
            case self::ALGORITHM_KMP:
                return new KMPAlgorithm($options);
                break;
            default:
                throw new NotImplementedAlgorithmException("{$algorithm} is not implemented.");
                break;
        }
    }
}
