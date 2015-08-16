<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student_answer".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $student_id
 * @property string $answer
 */
class StudentAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'student_id', 'answer'], 'required'],
            [['question_id', 'student_id'], 'integer'],
            [['answer'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'student_id' => 'Student ID',
            'answer' => 'Answer',
        ];
    }

    /**
     * @inheritdoc
     * @return StudentAnswerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentAnswerQuery(get_called_class());
    }
}
