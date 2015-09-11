<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[StudentTest]].
 *
 * @see StudentTest
 */
class StudentTestQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return StudentTest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return StudentTest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}