<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%language}}".
 *
 * @property int $id
 * @property string $code Код языка по стандарту ISO 639-1
 * @property string $name Название
 */

class Language extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%language}}';
    }

    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['code'], 'string', 'max' => 2],
            [['name'], 'string', 'max' => 255],
            [['code'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код языка по стандарту ISO 639-1',
            'name' => 'Название',
        ];
    }

    public static function getList()
    {
        $data = self::find()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }
}
