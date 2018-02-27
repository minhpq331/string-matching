<?php

namespace components\helpers\stringmatching;

use components\services\stringmatching\BaseStringMatchingAlgorithm;

/**
 * KMPAlgorithm implement the Knuth-Morris-Pratt algorithm in string matching.
 *
 * It loop through the base string to find any match
 */
class KMPAlgorithm extends BaseStringMatchingAlgorithm
{

    /**
     * @inheritdoc
     */
    protected function searchUseAlgorithm()
    {
        $patternLength = strlen($this->pattern);
        $baseStringLength = strlen($this->baseString);

        $result = array();
        $prefixes = $this->generatePrefixes();

        $k = 0;
        $m = 0;
        for ($i = 0; $i < $patternLength; $i++) {
            while ($k > 0 && $this->baseString[$k] !== $this->pattern[$i]) {
                $k = $prefixes[$k];
            }
            if ($this->baseString[$k] === $this->pattern[$i]) {
                $k = $k + 1;
            }
            if ($k == $baseStringLength) {
                $result[] = $i - $baseStringLength + 1;
                $m = $i;
                $k = $prefixes[$k];
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
        $baseStringLength = strlen($this->baseString);

        $result = array();

        $result[1] = 0;

        $k = 0;
        for ($i = 1; $i < $baseStringLength; $i++) {
            while ($k > 0 && $this->baseString[$k] !== $this->baseString[$i]) {
                $k = $result[$k];
            }
            if ($this->baseString[$k] === $this->baseString[$i]) {
                $k = $k + 1;
            }
            $result[$i + 1] = $k;
        }

        return $result;
    }

}
