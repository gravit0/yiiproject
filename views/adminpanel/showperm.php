<?php
/* @var $this yii\web\View */
use app\models\User;
use yii\helpers\Html;

$this->title = 'Привилегии '.$model->login;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['users/index']];
$this->params['breadcrumbs'][] = ['label' => $model->login, 'url' => ['users/view','id'=>$model->id]];
$this->params['breadcrumbs'][] = 'Привилегии';
?>
<h1>Привилегии пользователя <?= $model->login ?></h1>
<table>
    <?php
    $groupmap = User::getGroupMap();
    foreach ($groupmap as $k=>$v) {
        ?>
    <tr><td><?= $v ?></td><td>
    <?= $model->isPermission($k) ? 
                Html::a('Удалить', ['rmperm', 'id' => $model->id, 'perm' => $k], ['class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите снять привилегию "'.$v.'" у '.$model->login.'?',
                'method' => 'post',
            ],]) :
                Html::a('Добавить', ['addperm', 'id' => $model->id, 'perm' => $k], ['class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Вы действительно хотите выдать привилегию "'.$v.'" пользователю '.$model->login.'?',
                'method' => 'post',
            ],]);?>
        </td></tr>
    <?php
} ?>
</table>