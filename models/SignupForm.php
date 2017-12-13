<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignupForm is the model behind the signup for event form.
 *
 */
class SignupForm extends Model
{
    public $char_fk;
    public $event_fk;
    public $status_fk;
    public $signup_note;
    public $signup_created;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['char_fk', 'event_fk', 'status_fk'], 'required']
        ];
    }
}
