<?php

use yii\db\Migration;

class m211117_035722_insert_table_wifi_spot extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = '{{%wifi_spot}}';
        $columns = ['key', 'city_id', 'language_id'];

        /*
         * Add one million Wi-Fi spots for test
         */

        $data = [];
        for ($c = 0, $i = 1; $i <= 1000000; $c++, $i++) {
            $data[] = [
                'er-telecom-' . $i,
                rand(1, 10), # ten cites
                rand(1, 2),  # two languages
            ];

            /*
             * To reduce memory usage move by small steps
             */

            if ($c > 999) {
                $this->batchInsert($tableName, $columns, $data);
                $data = [];
                $c = 0;
            }
        }
        if ($c > 0) {
            $this->batchInsert($tableName, $columns, $data);
        }
    }

    public function safeDown()
    {
        Yii::$app->db->createCommand()->truncateTable('{{%wifi_spot}}')->execute();
    }

}
