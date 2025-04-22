<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Autor $model */

$this->title = $model->nombre_autor;
$this->params['breadcrumbs'][] = ['label' => 'Autores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="autor-view">
    <div class="container">
        <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

        <div class="card">
            <div class="card-body">
                <p>
                    <?= Html::a('<i class="fas fa-edit"></i> Actualizar', ['update', 'id' => $model->id_autor], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="fas fa-trash-alt"></i> Eliminar', ['delete', 'id' => $model->id_autor], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => '¿Está seguro que desea eliminar este autor?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Volver', ['index'], ['class' => 'btn btn-secondary']) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id_autor',
                        'nombre_autor',
                        'nacionalidad',
                    ],
                ]) ?>

                <div class="mt-4">
                    <h3>Libros del Autor</h3>
                    <?php if ($model->libros): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Categoría</th>
                                        <th>Año de Publicación</th>
                                        <th>Disponible</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($model->libros as $libro): ?>
                                        <tr>
                                            <td><?= Html::encode($libro->titulo) ?></td>
                                            <td><?= Html::encode($libro->categoria->nombre_categoria) ?></td>
                                            <td><?= Html::encode($libro->anio_publicacion) ?></td>
                                            <td><?= $libro->disponible ? 'Sí' : 'No' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>No hay libros registrados para este autor.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> 