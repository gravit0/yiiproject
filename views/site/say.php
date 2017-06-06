<?php
use yii\helpers\Html;
Yii::$app->request->isAjax;
?>
<?= Html::encode($message) ?>
<pre><?= print_r(Yii::$app->user) ?></pre>