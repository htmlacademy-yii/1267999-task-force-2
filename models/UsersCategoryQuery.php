<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UsersCategory]].
 *
 * @see UsersCategory
 */
class UsersCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UsersCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UsersCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
