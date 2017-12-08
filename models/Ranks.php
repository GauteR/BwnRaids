<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ranks".
 *
 * @property integer $rank_id
 * @property string $rank_name
 * @property string $rank_style
 * @property integer $rank_permission
 *
 * @property Users[] $users
 */
class Ranks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ranks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rank_name', 'rank_permission'], 'required'],
            [['rank_style'], 'string'],
            [['rank_permission'], 'integer'],
            [['rank_name'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rank_id' => Yii::t('app', 'Rank ID'),
            'rank_name' => Yii::t('app', 'Rank Name'),
            'rank_style' => Yii::t('app', 'Rank Style'),
            'rank_permission' => Yii::t('app', 'Rank Permission'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['user_fk_rank' => 'rank_id']);
    }
}
