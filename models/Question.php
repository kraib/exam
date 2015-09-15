<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $test_id
 * @property string $question
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'question'], 'required'],
            [['test_id'], 'integer'],
            [['question'], 'string', 'max' => 250]
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
            'question' => 'Question',
        ];
    }

    public static function grade_question($question_keywords, $student_answer)
    {

        $score = 0;
        foreach($question_keywords as $keyw => $mark){

            if(preg_match("/(".$keyw.")/i", $student_answer, $match)){
                $score+=$mark;
            }

        }
        return $score;
    }
}
