<?php

/* @var $this yii\web\View */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Профиль пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div>
		<img src="<?= $userData['photo'] ?>" alt="">    	
    	<p>Имя: <?= $userData['first_name'] ?> <?= $userData['last_name'] ?></p>
    	<p>Email: <?= $userData['email'] ?></p>
	</div>
	<div>
		<?php
			echo $userBonus;
		?>
	</div>
</div>
