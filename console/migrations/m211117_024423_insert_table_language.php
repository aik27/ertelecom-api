<?php

use yii\db\Migration;

/**
 * Class m211117_024423_insert_table_language
 */
class m211117_024423_insert_table_language extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%language}}', ['id', 'code', 'name'], [
            [1, 'ru', 'Русский'],
            [2, 'en', 'Английский'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->truncateTable('{{%language}}')->execute();
    }
}
