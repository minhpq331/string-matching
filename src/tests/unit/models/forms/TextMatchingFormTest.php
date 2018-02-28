<?php
namespace tests\models\forms;

use app\components\helpers\textmatching\AlgorithmFactory;
use app\models\forms\TextMatchingForm;

class TextMatchingFormTest extends \Codeception\Test\Unit
{
    private $validAlgorithm;

    private $model;

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->model = new TextMatchingForm();
        $this->validAlgorithm = AlgorithmFactory::ALGORITHM_NAIVE;
    }

    protected function _after()
    {
    }

    // tests validator rule with different input
    public function testValidateInput()
    {

        $formData = array(
            'algorithm' => 'unknown',
            'caseSensitive' => 0,
            'matchMultiple' => 1,
            'baseString' => 'some string',
            'pattern' => 'some',
        );
        $this->model->load($formData, '');
        $this->assertFalse($this->model->validate());

        $formData = array(
            'algorithm' => $this->validAlgorithm,
            'caseSensitive' => 'x',
            'matchMultiple' => 1,
            'baseString' => 'some string',
            'pattern' => 'some',
        );
        $this->model->load($formData, '');
        $this->assertFalse($this->model->validate());

        $formData = array(
            'algorithm' => $this->validAlgorithm,
            'caseSensitive' => 0,
            'matchMultiple' => 'x',
            'baseString' => 'some string',
            'pattern' => 'some',
        );
        $this->model->load($formData, '');
        $this->assertFalse($this->model->validate());

        $formData = array(
            'algorithm' => $this->validAlgorithm,
            'caseSensitive' => 'x',
            'matchMultiple' => 1,
            'baseString' => 'some string',
            'pattern' => 'some',
        );
        $this->model->load($formData, '');
        $this->assertFalse($this->model->validate());

        $formData = array(
            'algorithm' => $this->validAlgorithm,
            'caseSensitive' => 'x',
            'matchMultiple' => 1,
            'baseString' => array(),
            'pattern' => 'some',
        );
        $this->model->load($formData, '');
        $this->assertFalse($this->model->validate());

        $formData = array(
            'algorithm' => $this->validAlgorithm,
            'caseSensitive' => 'x',
            'matchMultiple' => 1,
            'baseString' => 'some string',
            'pattern' => array(),
        );
        $this->model->load($formData, '');
        $this->assertFalse($this->model->validate());

        $formData = array(
            'algorithm' => $this->validAlgorithm,
            'caseSensitive' => 0,
            'matchMultiple' => 1,
            'baseString' => 'some string',
            'pattern' => 'some',
        );
        $this->model->load($formData, '');
        $this->assertTrue($this->model->validate());
    }

    // Test result
    public function testStringMatchingResult()
    {
        $formData = array(
            'algorithm' => $this->validAlgorithm,
            'caseSensitive' => 0,
            'matchMultiple' => 1,
            'baseString' => 'some string some',
            'pattern' => 'Some',
        );
        $this->model->load($formData, '');
        $this->assertTrue($this->model->validate());
        $this->assertEquals(array(1, 13), $this->model->process());
    }
}
