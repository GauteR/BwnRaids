<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mm_user_chars".
 *
 * @property integer $belong_id
 * @property integer $user_fk
 * @property integer $char_fk
 *
 * @property Users $userFk
 * @property Characters $charFk
 */
class MmUserChars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mm_user_chars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk', 'char_fk'], 'required'],
            [['user_fk', 'char_fk'], 'integer'],
            [['user_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_fk' => 'user_id']],
            [['char_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Characters::className(), 'targetAttribute' => ['char_fk' => 'char_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'belong_id' => Yii::t('app', 'Belong ID'),
            'user_fk' => Yii::t('app', 'User Fk'),
            'char_fk' => Yii::t('app', 'Char Fk'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFk()
    {
        return $this->hasOne(Users::className(), ['user_id' => 'user_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharFk()
    {
        return $this->hasOne(Characters::className(), ['char_id' => 'char_fk']);
    }
}
