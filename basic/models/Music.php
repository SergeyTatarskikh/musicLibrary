<?php

namespace app\models;

use yii\db\ActiveRecord;

class Music extends ActiveRecord
{
    public static function tableName(){
        return 'music';
    }
}