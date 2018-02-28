<?php

namespace app\models\forms;

use app\components\helpers\textmatching\AlgorithmFactory;
use yii\base\Model;

/**
 * TextMatchingForm present the ActiveForm for user to input
 */
class TextMatchingForm extends Model
{

    public $algorithm = AlgorithmFactory::ALGORITHM_NAIVE;

    public $matchMultiple = true;

    public $caseSensitive = false;

    public $baseString;

    public $pattern;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['algorithm'], 'required'],
            [['algorithm'], 'in', 'range' => array_keys(AlgorithmFactory::$ALLOWED_ALGORITHMS)],

            [['matchMultiple'], 'boolean'],
            [['matchMultiple'], 'default', 'value' => true],

            [['caseSensitive'], 'boolean'],
            [['caseSensitive'], 'default', 'value' => false],

            // both baseString and pattern are strings
            [['baseString', 'pattern'], 'string'],

        ];
    }

    /**
     * Process String matching using user input
     *
     * @return array Result of the matching process
     */
    public function process()
    {
        $matchingAlgorithm = AlgorithmFactory::make($this->algorithm, [
            'matchMultiple' => $this->matchMultiple,
            'caseSensitive' => $this->caseSensitive,
        ]);
        return $matchingAlgorithm->search($this->baseString, $this->pattern);
    }
}
