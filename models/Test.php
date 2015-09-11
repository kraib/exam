<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $name
 * @property string $subject
 * @property integer $examiner_id
 * @property string $time
 * @property integer $duration
 */
class Test extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'subject', 'examiner_id', 'time', 'duration'], 'required'],
            [['examiner_id', 'duration'], 'integer'],
            [['time'], 'safe'],
            [['name', 'subject'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'subject' => 'Subject',
            'examiner_id' => 'Examiner ID',
            'time' => 'Time',
            'duration' => 'Duration',
        ];
    }

    /**
     *
     */
    public function getFullTest(){
        //$this->

    }

    public function getExaminer()
    {
        return $this->hasOne(User::className(), ['id' => 'examiner_id']);
    }

    public function getstudent_test()
    {
        return $this->hasMany(StudentTest::className(), ['student_id' => 'id']);
    }
}
