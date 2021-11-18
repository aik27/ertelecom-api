<?php

use yii\db\Expression;
use yii\db\Migration;

class m211116_101556_insert_table_user extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('{{%user}}', ['id', 'name', 'login', 'password', 'email', 'auth_key', 'access_token', 'status', 'online', 'online_at', 'created_at', 'updated_at'], [
            [
                1,
                'Administrator',
                'root',
                '$2y$13$CeJ0wvRRrvlNJfGVkJ0NoeoZd9ImYJ1bzFxtdi3xapH3OFW2HGv8.',
                'root@ertelecom.ru',
                '095khhjo5dJm95s8rG4TQPEUS5dBxqyV',
                'XbgOZGq1I6Q3sndSRcLdgY7MktGQFj3w',
                1,
                0,
                '2001-01-01 00:00:00',
                new Expression('NOW()'),
                new Expression('NOW()')
            ]
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%user}}', ['id' => 1]);
    }
}
