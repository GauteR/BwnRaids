<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property integer $user_id
 * @property integer $user_fk_rank
 * @property string $user_screen_name
 * @property string $user_email
 * @property string $user_pass
 * @property string $user_discord
 * @property string $user_access_token
 * @property string $user_auth_key
 *
 * @property Characters[] $characters
 * @property Ranks $userFkRank
 */
class Users extends ActiveRecord implements IdentityInterface
{
    private $auth_key;
    private $password_hash;
    private $password_reset_token;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_fk_rank', 'user_email', 'user_pass', 'user_access_token', 'user_auth_key'], 'required'],
            [['user_fk_rank'], 'integer'],
            [['user_screen_name', 'user_discord'], 'string', 'max' => 64],
            [['user_email'], 'string', 'max' => 256],
            [['user_pass'], 'string', 'max' => 512],
            [['user_access_token', 'user_auth_key'], 'string', 'max' => 128],
            [['user_fk_rank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['user_fk_rank' => 'rank_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'user_fk_rank' => Yii::t('app', 'User Fk Rank'),
            'user_screen_name' => Yii::t('app', 'Screen Name'),
            'user_email' => Yii::t('app', 'E-mail'),
            'user_pass' => Yii::t('app', 'Password'),
            'user_discord' => Yii::t('app', 'Discord'),
            'user_access_token' => Yii::t('app', 'User Access Token'),
            'user_auth_key' => Yii::t('app', 'User Auth Key'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Characters::className(), ['user_fk' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFkRank()
    {
        return $this->hasOne(Ranks::className(), ['rank_id' => 'user_fk_rank']);
    }

    /**
     * @inheritdoc
     * @return UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['user_access_token' => $token]);
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $user_email
     * @return static|null
     */
    public static function findByUsername($user_email)
    {
        return static::findOne(['user_email' => $user_email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($user_pass)
    {
        //return $this->user_pass === md5($user_pass);
        return $this->user_pass === $user_pass;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($user_pass)
    {
        $this->password_hash = Security::generatePasswordHash($user_pass);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
