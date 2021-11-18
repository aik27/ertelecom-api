<?php

use yii\db\Migration;

class m211117_035713_create_table_wifi_spot extends Migration
{
    public function safeUp()
    {
        $tableName = '{{%wifi_spot}}';
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'key' => $this->string(32)->notNull()->comment('Строковый идентификатор'),
            'city_id' => $this->integer()->notNull()->comment('ID города'),
            'language_id' => $this->integer()->notNull()->comment('ID языка'),
        ], $tableOptions);

        $this->createIndex('idx-wifi-spot-search', $tableName, ['city_id', 'language_id']);
        $this->createIndex('idx-wifi-spot-key', $tableName, 'key', true);
        $this->createIndex('idx-wifi-spot-city_id', $tableName, 'city_id');
        $this->createIndex('idx-wifi-spot-language_id', $tableName, 'language_id');

        $this->addCommentOnTable($tableName, 'Wifi. Точки доступа');
    }

    public function safeDown()
    {
        $this->dropTable('{{%wifi_spot}}');
    }
}
