<?php

namespace app\models;

use yii\db\ActiveRecord as BaseActiveRecord;

class ActiveRecord extends BaseActiveRecord
{
    public static function tableName()
    {
        $parts = explode('\\', get_called_class());
        return '{{%' . strtolower(end($parts)) . '}}';
    }
}
