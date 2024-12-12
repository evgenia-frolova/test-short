<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'Сервис коротких ссылок + QR';

?>
<div class="site-index">

    <div>
        <h1>Сервис коротких ссылок + QR</h1>
        
        <?php Pjax::begin(['id' => 'link']) ?>
            <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ]]); ?>

                <?= $form->field($model, 'link') ?>

                <div class="form-group">
                    <?= Html::submitButton('OK', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        <?php Pjax::end() ?>
    </div>
</div>
