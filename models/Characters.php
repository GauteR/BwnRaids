<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "characters".
 *
 * @property integer $char_id
 * @property integer $class_fk
 * @property string $char_name
 * @property string $char_realm
 * @property integer $char_mainrole
 * @property integer $char_offrole1
 * @property integer $char_offrole2
 * @property integer $char_offrole3
 * @property integer $char_type
 *
 * @property Attendees[] $attendees
 * @property Classes $classFk
 * @property Roles $charMainrole
 * @property Roles $charOffrole1
 * @property Roles $charOffrole2
 * @property Roles $charOffrole3
 * @property Events[] $events
 * @property MmUserChars[] $mmUserChars
 */
class Characters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'characters';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['class_fk', 'char_name', 'char_realm', 'char_mainrole', 'char_type'], 'required'],
            [['class_fk', 'char_mainrole', 'char_offrole1', 'char_offrole2', 'char_offrole3', 'char_type'], 'integer'],
            [['char_name', 'char_realm'], 'string', 'max' => 128],
            [['class_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Classes::className(), 'targetAttribute' => ['class_fk' => 'class_id']],
            [['char_mainrole'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['char_mainrole' => 'role_id']],
            [['char_offrole1'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['char_offrole1' => 'role_id']],
            [['char_offrole2'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['char_offrole2' => 'role_id']],
            [['char_offrole3'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['char_offrole3' => 'role_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'char_id' => Yii::t('app', 'Char ID'),
            'class_fk' => Yii::t('app', 'Class Fk'),
            'char_name' => Yii::t('app', 'Char Name'),
            'char_realm' => Yii::t('app', 'Char Realm'),
            'char_mainrole' => Yii::t('app', 'Char Mainrole'),
            'char_offrole1' => Yii::t('app', 'Char Offrole1'),
            'char_offrole2' => Yii::t('app', 'Char Offrole2'),
            'char_offrole3' => Yii::t('app', 'Char Offrole3'),
            'char_type' => Yii::t('app', 'Char Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees()
    {
        return $this->hasMany(Attendees::className(), ['char_fk' => 'char_id']);
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
    public function getCharMainrole()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'char_mainrole']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharOffrole1()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'char_offrole1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharOffrole2()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'char_offrole2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharOffrole3()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'char_offrole3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['leader_fk' => 'char_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMmUserChars()
    {
        return $this->hasMany(MmUserChars::className(), ['char_fk' => 'char_id']);
    }
}
