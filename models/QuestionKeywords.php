<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question_keywords".
 *
 * @property integer $id
 * @property integer $question_id
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
            [['question_id', 'marks'], 'required'],
            [['question_id', 'marks'], 'integer']
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
            'marks' => 'Marks',
        ];
    }

    /**
     * @inheritdoc
     * @return QuestionKeywordsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QuestionKeywordsQuery(get_called_class());
    }
}
