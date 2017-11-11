<?php

use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'New review';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $errors ? var_dump($errors) : '' ?>
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => ''],
    ]) ?>

    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <h2>Author's name</h2><hr/>
        </div>
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'author')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'text')->textarea(['rows' => 7]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'site_url')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <?= $form->field($imageModel, 'photos[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success pull-right']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
