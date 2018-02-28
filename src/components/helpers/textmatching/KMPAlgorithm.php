<?php

namespace app\components\helpers\textmatching;

use app\components\helpers\textmatching\BaseTextMatchingAlgorithm;

/**
 * KMPAlgorithm implement the Knuth-Morris-Pratt algorithm in string matching.
 *
 * It loop through the base string to find any match
 */
class KMPAlgorithm extends BaseTextMatchingAlgorithm
{

    /**
     * @inheritdoc
     */
    protected function searchUseAlgorithm()
    {
        $baseStringLength = strlen($this->baseString);
        $patternLength = strlen($this->pattern);

        $result = array();
        $prefixes = $this->generatePrefixes();

        $k = 0;
        $m = 0;
        for ($i = 0; $i < $baseStringLength; $i++) {
            while ($k > 0 && $this->pattern[$k] !== $this->baseString[$i]) {
                $k = $prefixes[$k];
            }
            if ($this->pattern[$k] === $this->baseString[$i]) {
                $k = $k + 1;
            }
            if ($k === $patternLength) {
                $result[] = $i - $patternLength + 2;
                $m = $i;
                $k = $prefixes[$k];
                if (!$this->matchMultiple) {
                    // break if found a match
                    break;
                }
            }
        }

        return $result;

    }

    /**
     * Generate all prefixes to perform KMP matching process
     *
     * @return array
     */
    private function generatePrefixes()
    {
        $patternLength = strlen($this->pattern);

        $result = array();

        $result[1] = 0;

        $k = 0;
        for ($i = 1; $i < $patternLength; $i++) {
            while ($k > 0 && $this->pattern[$k] !== $this->pattern[$i]) {
                $k = $result[$k];
            }
            if ($this->pattern[$k] === $this->pattern[$i]) {
                $k = $k + 1;
            }
            $result[$i + 1] = $k;
        }

        return $result;
    }

}
