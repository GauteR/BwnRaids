<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property integer $event_id
 * @property integer $leader_fk
 * @property string $event_name
 * @property string $event_date
 * @property string $event_note
 * @property integer $event_permitted_chars
 * @property string $event_created
 *
 * @property Attendees[] $attendees
 * @property Characters $leaderFk
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['leader_fk', 'event_name', 'event_date'], 'required'],
            [['leader_fk', 'event_permitted_chars'], 'integer'],
            [['event_date', 'event_created'], 'safe'],
            [['event_note'], 'string'],
            [['event_name'], 'string', 'max' => 256],
            [['leader_fk'], 'exist', 'skipOnError' => true, 'targetClass' => Characters::className(), 'targetAttribute' => ['leader_fk' => 'char_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => Yii::t('app', 'Event ID'),
            'leader_fk' => Yii::t('app', 'Leader Fk'),
            'event_name' => Yii::t('app', 'Event Name'),
            'event_date' => Yii::t('app', 'Event Date'),
            'event_note' => Yii::t('app', 'Event Note'),
            'event_permitted_chars' => Yii::t('app', 'Event Permitted Chars'),
            'event_created' => Yii::t('app', 'Event Created'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttendees()
    {
        return $this->hasMany(Attendees::className(), ['event_fk' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeaderFk()
    {
        return $this->hasOne(Characters::className(), ['char_id' => 'leader_fk']);
    }
}
