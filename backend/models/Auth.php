<?php

namespace backend\models;

use Yii;
use common\models\User;
use frontend\models\Bonus;

/**
 * This is the model class for table "auth".
 *
 * @property int $id
 * @property int $user_id
 * @property string $source
 * @property string $source_id
 * @property int|null $bonus_id
 * @property int $created_at
 *
 * @property Bonus $bonus
 * @property User $user
 */
class Auth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'source', 'source_id', 'created_at'], 'required'],
            [['user_id', 'bonus_id', 'created_at'], 'integer'],
            [['source', 'source_id'], 'string', 'max' => 255],
            [['bonus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bonus::className(), 'targetAttribute' => ['bonus_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'source' => 'Source',
            'source_id' => 'Source ID',
            'bonus_id' => 'Bonus ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Bonus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBonus()
    {
        return $this->hasOne(Bonus::className(), ['id' => 'bonus_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function bonusDecorator()
    {
        if ($this->bonus) {
            return '<p>Ваш бонус: '.$this->bonus->name.'</p>';
        }
        else {
            return '<p><a href="receivebonus" class="btn btn-success">Получить бонус</a><p>';
        }
    }

    public static function findByCurrentUser()
    {
        $userId = Yii::$app->user->getId();
        return static::findOne(['user_id' => $userId]);
    }

}
