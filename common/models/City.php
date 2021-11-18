<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%city}}".
 *
 * @property int $id
 * @property string $name Название
 */

class City extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%city}}';
    }

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
        ];
    }

    public static function getList()
    {
        $data = self::find()->all();
        return ArrayHelper::map($data, 'id', 'name');
    }
}
