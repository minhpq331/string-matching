<?php

namespace components\services\stringmatching;

/**
 * NaiveAlgorithm implement the naive algorithm in string matching.
 *
 * It loop through the base string to find any match
 */
class NaiveAlgorithm extends BaseStringMatchingAlgorithm
{

    /**
     * @inheritdoc
     */
    protected function searchUseAlgorithm()
    {
        $baseStringLength = strlen($this->baseString);
        $patternLength = strlen($this->pattern);

        $result = array();

        for ($i = 0; $i <= $baseStringLength - $patternLength; $i++) {
            $tmpSubString = substr($baseStringLength, $i, $patternLength);
            if ($tmpSubString === $this->pattern) {
                $result[] = $i;
            }
        }

        return $result;
    }

}
