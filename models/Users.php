<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property integer $user_fk_rank
 * @property string $user_email
 * @property string $user_pass
 * @property string $user_discord
 *
 * @property Characters[] $characters
 * @property Ranks $userFkRank
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk_rank', 'user_email', 'user_pass'], 'required'],
            [['user_fk_rank'], 'integer'],
            [['user_email'], 'string', 'max' => 256],
            [['user_pass'], 'string', 'max' => 512],
            [['user_discord'], 'string', 'max' => 64],
            [['user_fk_rank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['user_fk_rank' => 'rank_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'user_fk_rank' => Yii::t('app', 'User Fk Rank'),
            'user_email' => Yii::t('app', 'User Email'),
            'user_pass' => Yii::t('app', 'User Pass'),
            'user_discord' => Yii::t('app', 'User Discord'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Characters::className(), ['user_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFkRank()
    {
        return $this->hasOne(Ranks::className(), ['rank_id' => 'user_fk_rank']);
    }
}
