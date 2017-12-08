<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "classes".
 *
 * @property integer $class_id
 * @property string $class_name
 * @property string $class_icon
 * @property string $class_style
 *
 * @property Characters[] $characters
 * @property MmAllowedRoles[] $mmAllowedRoles
 */
class Classes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'classes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_name'], 'required'],
            [['class_style'], 'string'],
            [['class_name'], 'string', 'max' => 16],
            [['class_icon'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'class_id' => Yii::t('app', 'Class ID'),
            'class_name' => Yii::t('app', 'Class Name'),
            'class_icon' => Yii::t('app', 'Class Icon'),
            'class_style' => Yii::t('app', 'Class Style'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Characters::className(), ['class_fk' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMmAllowedRoles()
    {
        return $this->hasMany(MmAllowedRoles::className(), ['class_fk' => 'class_id']);
    }
}
