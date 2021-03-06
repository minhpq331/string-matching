<?php

namespace app\components\helpers\textmatching;

use app\components\helpers\textmatching\BaseTextMatchingAlgorithm;

/**
 * NaiveAlgorithm implement the naive algorithm in string matching.
 *
 * It loop through the base string to find any match
 */
class NaiveAlgorithm extends BaseTextMatchingAlgorithm
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
            $isMatch = true;
            for ($k = 0; $k < $patternLength; $k++) {
                $isMatch = $isMatch && ($this->pattern[$k] === $this->baseString[$i + $k]);
                if (!$isMatch) {
                    // break the loop if any character is not matched to reduce total loop number
                    break;
                }
            }

            if ($isMatch) {
                $result[] = $i + 1;
                if (!$this->matchMultiple) {
                    // break if get only 1 result
                    break;
                }
            }
        }

        return $result;
    }

}
