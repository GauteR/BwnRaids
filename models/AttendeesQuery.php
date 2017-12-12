<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Attendees]].
 *
 * @see Attendees
 */
class AttendeesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Attendees[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Attendees|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}