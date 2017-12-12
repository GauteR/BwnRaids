<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "roles".
 *
 * @property integer $role_id
 * @property string $role_name
 *
 * @property Characters[] $characters
 * @property Characters[] $characters0
 * @property Characters[] $characters1
 * @property Characters[] $characters2
 * @property MmAllowedRoles[] $mmAllowedRoles
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name'], 'required'],
            [['role_name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => Yii::t('app', 'Role ID'),
            'role_name' => Yii::t('app', 'Role Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Characters::className(), ['char_mainrole' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters0()
    {
        return $this->hasMany(Characters::className(), ['char_offrole1' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters1()
    {
        return $this->hasMany(Characters::className(), ['char_offrole2' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters2()
    {
        return $this->hasMany(Characters::className(), ['char_offrole3' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMmAllowedRoles()
    {
        return $this->hasMany(MmAllowedRoles::className(), ['role_fk' => 'role_id']);
    }
    
    /**
     * @inheritdoc
     * @return RolesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RolesQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
}
