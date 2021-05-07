<?php

namespace frontend\models;

use Yii;
use backend\models\Auth;

/**
 * This is the model class for table "bonus".
 *
 * @property int $id
 * @property string $name
 * @property int $b_count
 *
 * @property Auth[] $auths
 */
class Bonus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'b_count'], 'required'],
            [['b_count'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'b_count' => 'Количество',
        ];
    }

    /**
     * Gets query for [[Auths]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuths()
    {
        return $this->hasMany(Auth::className(), ['bonus_id' => 'id']);
    }

    private static function decrementBonusCount($id)
    {
        $bonus = Bonus::findOne($id);
        if ($bonus->b_count > 0){
            $bonus->b_count = $bonus->b_count - 1;
            $bonus->save();
        }       
    }

    private static function saveAuth($bonusId)
    {
        $auth = Auth::findByCurrentUser();
        $auth->bonus_id = $bonusId;
        $auth->save();      
}    

    private static function saveAuthBonus($bonusId)
    {
        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            self::saveAuth($bonusId);
            self::decrementBonusCount($bonusId);            
            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollback();
        }
    }

    public static function getRandomBonus()
    {
        $availableBonuses = self::find()
            ->where(['!=', 'b_count', 0])
            ->all();
        $countAvailableBonuses = sizeof($availableBonuses);
        $i = rand(0,$countAvailableBonuses - 1);

        self::saveAuthBonus($availableBonuses[$i]->id);
    }

}
