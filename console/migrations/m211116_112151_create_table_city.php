<?php

use yii\db\Migration;

class m211116_112151_create_table_city extends Migration
{
    public function safeUp()
    {
        $tableName = '{{%city}}';
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название'),
        ], $tableOptions);

        $this->addCommentOnTable($tableName, 'Города');
    }

    public function safeDown()
    {
        $this->dropTable('{{%city}}');
    }
}
