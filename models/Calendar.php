<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calendar".
 *
 * @property integer $id
 * @property string $time
 * @property integer $test_id
 */
class Calendar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calendar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'test_id'], 'required'],
            [['time'], 'safe'],
            [['test_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'test_id' => 'Test ID',
        ];
    }
}
