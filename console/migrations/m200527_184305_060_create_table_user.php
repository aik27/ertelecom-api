<?php

use yii\db\Expression;
use yii\db\Migration;

class m200527_184305_060_create_table_user extends Migration
{
    public function safeUp()
    {
        $tableName = '{{%user}}';
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($tableName, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('ФИО'),
            'login' => $this->string(32)->notNull()->comment('Логин'),
            'password' => $this->string(60)->notNull()->comment('Пароль'),
            'email' => $this->string()->notNull()->comment('E-mail'),
            'auth_key' => $this->string(32)->notNull()->comment('Ключ авторизации'),
            'access_token' => $this->string(32)->notNull()->comment('Токен для API'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('Статус'),
            'online' => $this->smallInteger()->defaultValue(0)->comment('Онлайн'),
            'online_at' => $this->dateTime()->defaultValue('2001-01-01 00:00:00')->comment('Последняя активность'),
            'created_at' => $this->dateTime()->defaultExpression('NOW()')->comment('Дата создания'),
            'updated_at' => $this->dateTime()->defaultExpression('NOW()')->comment('Дата изменения'),
        ], $tableOptions);

        $this->createIndex('idx-user-auth', $tableName, ['login', 'password'], true);
        $this->createIndex('idx-user-login', $tableName, 'login', true);
        $this->createIndex('idx-user-auth_key', $tableName, 'auth_key', true);
        $this->createIndex('idx-user-access_token', $tableName, 'access_token', true);
        $this->createIndex('idx-user-status', $tableName, 'status');

        $this->addCommentOnTable($tableName, 'Пользователи');
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
