<?php

namespace app\models;
use Yii;
use yii\base\Model;

/**
 * Created by JetBrains PhpStorm.
 * User: mark
 * Date: 8/24/15
 * Time: 5:16 AM
 * To change this template use File | Settings | File Templates.
 */


class AnswerForm extends Model
{
    public $test_id;
    public $student_id;
    public $answers;

    public function rules()
    {
        return [
            [ ['answers', 'test_id'], 'required'],
        ];
    }
}