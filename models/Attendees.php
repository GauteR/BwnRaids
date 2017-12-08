<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendees".
 *
 * @property integer $attendee_id
 * @property integer $event_fk
 * @property integer $char_fk
 * @property integer $status_fk
 * @property string $signup_note
 * @property string $signup_created
 *
 * @property Characters $charFk
 * @property Events $eventFk
 * @property Statuses $statusFk
 */
class Attendees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attendees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_fk', 'char_fk', 'status_fk'], 'required'],
            [['event_fk', 'char_fk', 'status_fk'], 'integer'],
            [['signup_note'], 'string'],
            [['signup_created'], 'safe'],
            [['char_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Characters::className(), 'targetAttribute' => ['char_fk' => 'char_id']],
            [['event_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_fk' => 'event_id']],
            [['status_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_fk' => 'status_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'attendee_id' => Yii::t('app', 'Attendee ID'),
            'event_fk' => Yii::t('app', 'Event Fk'),
            'char_fk' => Yii::t('app', 'Char Fk'),
            'status_fk' => Yii::t('app', 'Status Fk'),
            'signup_note' => Yii::t('app', 'Signup Note'),
            'signup_created' => Yii::t('app', 'Signup Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharFk()
    {
        return $this->hasOne(Characters::className(), ['char_id' => 'char_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventFk()
    {
        return $this->hasOne(Events::className(), ['event_id' => 'event_fk']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatusFk()
    {
        return $this->hasOne(Statuses::className(), ['status_id' => 'status_fk']);
    }
}
