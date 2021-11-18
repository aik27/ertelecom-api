<?php

use yii\db\Migration;

class m211117_024405_create_table_language extends Migration
{
    public function safeUp()
    {
        $tableName = '{{%language}}';
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'code' => $this->string(2)->notNull()->comment('Код языка по стандарту ISO 639-1'),
            'name' => $this->string()->notNull()->comment('Название'),
        ], $tableOptions);

        $this->createIndex('idx-language-code', $tableName, 'code', true);

        $this->addCommentOnTable($tableName, 'Языки');
    }

    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
