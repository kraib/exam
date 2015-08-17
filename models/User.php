<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $role
 * @property string $first_name
 * @property string $last_name
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password','role', 'first_name', 'last_name'], 'required'],
            [['password', 'auth_key', 'access_token'], 'string'],
            [['status'], 'integer'],
            [['username', 'first_name', 'last_name'], 'string', 'max' => 250],
            [['role'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'role' => 'Role',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'status' => 'Status',
        ];
    }
}
