<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mm_allowed_roles".
 *
 * @property integer $allowed_id
 * @property integer $class_fk
 * @property integer $role_fk
 *
 * @property Classes $classFk
 * @property Roles $roleFk
 */
class MmAllowedRoles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mm_allowed_roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_fk', 'role_fk'], 'required'],
            [['class_fk', 'role_fk'], 'integer'],
            [['class_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::className(), 'targetAttribute' => ['class_fk' => 'class_id']],
            [['role_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role_fk' => 'role_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'allowed_id' => Yii::t('app', 'Allowed ID'),
            'class_fk' => Yii::t('app', 'Class Fk'),
            'role_fk' => Yii::t('app', 'Role Fk'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassFk()
    {
        return $this->hasOne(Classes::className(), ['class_id' => 'class_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleFk()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'role_fk']);
    }
}
