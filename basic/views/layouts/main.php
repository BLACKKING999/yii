<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'Biblioteca Virtual',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto mb-2 mb-md-0'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            [
                'label' => 'Libros',
                'items' => [
                    ['label' => 'Ver Libros', 'url' => ['/libro/index']],
                    ['label' => 'Nuevo Libro', 'url' => ['/libro/create']],
                    '<div class="dropdown-divider"></div>',
                    ['label' => 'Autores', 'url' => ['/autor/index']],
                    ['label' => 'Categorías', 'url' => ['/categoria/index']],
                ],
            ],
            [
                'label' => 'Usuarios',
                'items' => [
                    ['label' => 'Ver Usuarios', 'url' => ['/usuario/index']],
                    ['label' => 'Nuevo Usuario', 'url' => ['/usuario/create']],
                ],
            ],
            [
                'label' => 'Préstamos',
                'items' => [
                    ['label' => 'Ver Préstamos', 'url' => ['/prestamo/index']],
                    ['label' => 'Nuevo Préstamo', 'url' => ['/prestamo/create']],
                ],
            ],
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 text-muted">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="float-start">&copy; Biblioteca Virtual <?= date('Y') ?></p>
            </div>
            <div class="col-md-6">
                <p class="float-end">Desarrollado con <i class="fas fa-heart text-danger"></i> usando Yii Framework</p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
