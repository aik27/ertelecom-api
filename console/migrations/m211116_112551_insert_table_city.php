<?php

use yii\db\Migration;

class m211116_112551_insert_table_city extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%city}}', ['id', 'name'], [
            [1, 'Москва'],
            [2, 'Санкт-Петербург'],
            [3, 'Новосибирск'],
            [4, 'Екатеринбург'],
            [5, 'Казань'],
            [6, 'Нижний Новгород'],
            [7, 'Челябинск'],
            [8, 'Самара'],
            [9, 'Омск'],
            [10, 'Ростов-на-Дону']
        ]);
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand()->truncateTable('{{%city}}')->execute();
    }
}
