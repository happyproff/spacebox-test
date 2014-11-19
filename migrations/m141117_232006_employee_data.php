<?php

use yii\db\Schema;
use yii\db\Migration;

class m141117_232006_employee_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%employee}}', ['lastname', 'is_in_place'], [
            ['Иванов', 0],
            ['Петров', 0],
            ['Сидоров', 0],
            ['Кузнецов', 1],
            ['Соколов', 1],
            ['Попов', 1],
        ]);

        $this->batchInsert('{{%group}}', ['title'], [
            ['1'],
            ['2'],
            ['3'],
            ['4'],
        ]);
        $this->batchInsert('{{%group_employee}}', ['group_id', 'employee_id'], [
            [1, 1], [1, 2], [1, 3],
            [2, 1], [2, 2], [2, 3], [2, 4], [2, 5],
            [3, 4], [3, 5],
            [4, 4], [4, 5], [4, 6],
        ]);

        $this->batchInsert('{{%skill}}', ['title'], [
            ['a'],
            ['b'],
            ['c'],
        ]);
        $this->batchInsert('{{%skill_employee}}', ['skill_id', 'employee_id'], [
            [1, 1], [1, 2], [1, 3], [1, 4], [1, 5],
            [2, 3], [2, 4], [2, 5],
            [3, 6],
        ]);
    }

    public function down()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->truncateTable('{{%group_employee}}');
        $this->truncateTable('{{%group}}');
        $this->truncateTable('{{%skill_employee}}');
        $this->truncateTable('{{%skill}}');
        $this->truncateTable('{{%employee}}');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
    }
}
