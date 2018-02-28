<?php

use app\components\helpers\textmatching\AlgorithmFactory;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'String Matching Implemention';
?>
<div class="site-index">


    <div class="body-content">
        <div class="row">
            <h1 class="text-center"><?=Html::encode($this->title);?></h1>
        </div>

        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
                <?php $form = ActiveForm::begin([
    'id' => 'string-form',
]);?>

                    <?=$form->field($model, 'baseString')->textarea(['autofocus' => true])?>

                    <?=$form->field($model, 'pattern')->textInput()?>

                    <?=$form->field($model, 'algorithm')->dropDownList(AlgorithmFactory::$ALLOWED_ALGORITHMS)?>

                    <?=$form->field($model, 'matchMultiple')->checkbox()?>

                    <?=$form->field($model, 'caseSensitive')->checkbox()?>

                    <div class="form-group">
                        <label class="control-label">Result:</label>
                        <div class="form-control-static">
                            <?php if (empty($matchingResult)): ?>
                                (empty result)
                            <?php else: ?>
                                <?=implode(', ', $matchingResult);?>
                            <?php endif?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?=Html::submitButton('Submit', ['class' => 'btn btn-primary col-xs-12', 'name' => 'submit-button'])?>
                    </div>

                <?php ActiveForm::end();?>
            </div>
        </div>

    </div>
</div>
