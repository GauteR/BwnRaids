<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property integer $status_id
 * @property string $status_name
 *
 * @property Attendees[] $attendees
 */
class Statuses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
            [['status_name'], 'string', 'max' => 16],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => Yii::t('app', 'Status ID'),
            'status_name' => Yii::t('app', 'Status Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees()
    {
        return $this->hasMany(Attendees::className(), ['status_fk' => 'status_id']);
    }
}
