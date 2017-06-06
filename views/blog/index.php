<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блог';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">
    <style>
        .blog-page
        {
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 15px;
            border: 1px solid black;
            width: 90%;
            padding: 20px;
        }
        .blog-page + .blog-page
        {
            margin-top: 4px;
            margin-bottom: 4px;
        }
        .blog-header
        {
            font-size: 24px;
        }
    </style>
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php if (!Yii::$app->user->isGuest) {
            echo Html::a('Написать запись', ['create'], ['class' => 'btn btn-success', 'style' => '']);
            }
            ?>
    </p>
<?php foreach ($countries as $country): ?>
    <div class="blog-page">
        <div class="blog-header"><?= Html::encode($country->header) ?></div>
        <div><?= $country->brieftext ?></div>
        <?= Html::a('Просмотр', ['view','id'=>$country->id], ['class' => 'btn btn-success']) ?>
    </div>
<?php endforeach; ?>
</div>
