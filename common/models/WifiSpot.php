<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wifi_spot}}".
 *
 * @property int $id
 * @property string $key Строковый идентификатор
 * @property int $city_id ID города
 * @property int $language_id ID языка
 */
class WifiSpot extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '{{%wifi_spot}}';
    }

    public function rules()
    {
        return [
            [['key', 'city_id', 'language_id'], 'required'],
            [['city_id', 'language_id'], 'integer'],
            [['key'], 'string', 'max' => 32],
            [['key'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'key' => 'Строковый идентификатор',
            'city_id' => 'Город',
            'language_id' => 'Язык по умолчанию',
        ];
    }

    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    public function getLanguage()
    {
        return $this->hasOne(Language::class, ['id' => 'language_id']);
    }
}
