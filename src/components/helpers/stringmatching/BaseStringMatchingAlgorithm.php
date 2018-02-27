<?php

namespace components\services\stringmatching;

use Yii;
use yii\base\Configurable;

/**
 * String-matching Algorithm Base class
 */
abstract class BaseStringMatchingAlgorithm implements Configurable
{

    /**
     * Option to return multiple matches or only first match
     * @var boolean
     */
    public $matchMultiple = true;

    /**
     * Option to match case sensitive
     * @var boolean
     */
    public $caseSensitive = false;

    /**
     * Base string to search in
     * @var string
     */
    protected $baseString;

    /**
     * Pattern string to search for
     * @var string
     */
    protected $pattern;

    /**
     * Class constructor
     *
     * Load options into class attributes
     *
     * @param array $config Options
     */
    public function __construct($config = [])
    {
        if (!empty($config)) {
            Yii::configure($config);
        }
    }

    /**
     * Use matching algorithm to find matching position
     *
     * @param  string $baseString The base string to search in.
     * @param  string $pattern    The pattern to search for.
     * @return array              Array contains starting position of matching results (if any).
     */
    public function search($baseString, $pattern)
    {
        $this->baseString = $baseString;
        $this->pattern = $pattern;

        // Validate inputs and return empty result if an error occur
        if (!$this->validateInput()) {
            return array();
        }

        // Apply pre-modification (if any)
        $this->prepareInput();

        // Check some special cases
        $specialCaseResult = $this->checkSpecialCases();

        if (null !== $specialCaseResult) {
            // result is one of special cases
            return $specialCaseResult;
        } else {
            // process matching use algorithm
            return $this->searchUseAlgorithm();
        }
    }

    /**
     * Prepare input for processing
     *
     */
    protected function prepareInput()
    {
        if (!$this->caseSensitive) {
            // matching with case-insentitive option
            $this->baseString = strtolower($this->baseString);
            $this->pattern = strtolower($this->pattern);
        }
    }

    /**
     * Implement some basic input-checking
     *
     * @return boolean Return `true` if all input is valid for further processing
     */
    protected function validateInput()
    {
        // Invalid type should always return false
        if (!is_string($this->baseString) || !is_string($this->pattern)) {
            return false;
        }
    }

    /**
     * Check if the input is one of special cases
     *
     * @return array|null Return array if the input is one of special case, null otherwise
     */
    protected function checkSpecialCases()
    {
        $baseStringLength = strlen($this->baseString);
        $patternLength = strlen($this->pattern);

        $result = array();

        // match all position
        if ($patternLength === 0) {
            for ($i = 0; $i <= $baseStringLength; $i++) {
                $result[] = $i;
                if (!$this->matchMultiple) {
                    // break the loop if only first match is considered
                    break;
                }
            }
            return $result;
        }

        // Pattern length is larger than base string length, should return result immediately
        if ($patternLength >= $baseStringLength) {
            if ($this->pattern === $this->baseString) {
                $result[] = 0;
            }
            return $result;
        }

        // No special case occured
        return null;
    }

    /**
     * Use specific algorithm to search pattern in string, all child class must override this method
     *
     * @return array Array contains starting position of matching results (if any).
     */
    abstract protected function searchUseAlgorithm();

}
