<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Autor;
use app\models\Categoria;

?>

<div class="libro-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'anio_publicacion')->textInput(['type' => 'number']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'id_autor')->dropDownList(
                ArrayHelper::map(Autor::find()->all(), 'id_autor', 'nombre_autor'),
                ['prompt' => 'Seleccione un autor']
            ) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'id_categoria')->dropDownList(
                ArrayHelper::map(Categoria::find()->all(), 'id_categoria', 'nombre_categoria'),
                ['prompt' => 'Seleccione una categoría']
            ) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'disponible')->checkbox() ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div> 