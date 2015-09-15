<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_test".
 *
 * @property integer $id
 * @property integer $student_id
 * @property integer $test_id
 * @property integer $taken
 * @property string $time
 *
 * @property User $student
 * @property Test $test
 */
class StudentTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'test_id', 'taken'], 'required'],
            [['student_id', 'test_id', 'taken'], 'integer'],
            [['time'], 'safe'],
            [['student_id', 'test_id'], 'unique', 'targetAttribute' => ['student_id', 'test_id'], 'message' => 'The combination of Student ID and Test ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'test_id' => 'Test ID',
            'taken' => 'Taken',
            'time' => 'Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @inheritdoc
     * @return StudentTestQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentTestQuery(get_called_class());
    }
}
