<?php

namespace app\models;

use yii\base\Model;

class MusicForm extends Model
{
    public $year;
    public $executor;
    public $album;

    public function rules()
    {
        return [
            ['year', 'integer', 'min' => 1900, 'max' => date('Y')],
            [['executor', 'album'], 'string', 'max' => 255],
            [['year', 'executor', 'album'], 'required'],
            ['executor', 'match', 'pattern' => '/^[a-zA-Zа-яА-Я\s]+$/u'],
        ];
    }



    public function saveToDatabase()
    {
        if ($this->validate()) {
            $music = new Music();
            $music->year = $this->year;
            $music->executor = $this->executor;
            $music->album = $this->album;
            $music->save();
            return true;
        } else {
            return false;
        }
    }
}
