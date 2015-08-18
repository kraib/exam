<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_keywords".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $keyword
 * @property integer $marks
 */
class QuestionKeywords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_keywords';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'keyword', 'marks'], 'required'],
            [['question_id', 'marks'], 'integer'],
            [['keyword'], 'string', 'max' => 250]
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
            'keyword' => 'Keyword',
            'marks' => 'Marks',
        ];
    }
}
