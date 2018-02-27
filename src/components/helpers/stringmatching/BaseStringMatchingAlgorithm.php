<?php

namespace app\components\helpers\stringmatching;

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
            Yii::configure($this, $config);
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

        // process matching use algorithm
        return $this->searchUseAlgorithm();
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

        // This implemention does not accept empty string
        if (empty($this->baseString) || empty($this->pattern)) {
            return false;
        }

        return true;
    }

    /**
     * Use specific algorithm to search pattern in string, all child class must override this method
     *
     * @return array Array contains starting position of matching results (if any).
     */
    abstract protected function searchUseAlgorithm();

}
