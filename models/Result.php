<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property integer $id
 * @property integer $test_id
 * @property integer $student_id
 * @property integer $total_score
 * @property integer $score_percentage
 * @property string $comments
 * @property integer $duration_used
 */
class Result extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'student_id', 'total_score', 'score_percentage', 'duration_used'], 'required'],
            [['test_id', 'student_id', 'total_score', 'score_percentage', 'duration_used'], 'integer'],
            [['comments'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'student_id' => 'Student ID',
            'total_score' => 'Total Score',
            'score_percentage' => 'Score Percentage',
            'comments' => 'Comments',
            'duration_used' => 'Duration Used',
        ];
    }

    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
    public function getStudent()
    {
        return $this->hasOne(User::className(), ['id' => 'student_id']);
    }
}
