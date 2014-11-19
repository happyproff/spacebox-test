<?php

use yii\db\Schema;
use yii\db\Migration;

class m141117_222629_employee extends Migration
{
    public function up()
    {
        $this->createTable('{{%employee}}', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'lastname' => 'VARCHAR(64) NOT NULL COMMENT "Фамилия"',
            'is_in_place' => 'TINYINT(1) UNSIGNED NOT NULL COMMENT "На месте"',
        ]);

        $this->createTable('{{%group}}', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(255) NOT NULL COMMENT "Название"',
        ]);
        $this->createTable('{{%group_employee}}', [
            'group_id' => 'INT(10) UNSIGNED NOT NULL',
            'employee_id' => 'INT(10) UNSIGNED NOT NULL',
            'PRIMARY KEY (group_id, employee_id)',
            'FOREIGN KEY (group_id) REFERENCES {{%group}} (id) ON DELETE CASCADE',
            'FOREIGN KEY (employee_id) REFERENCES {{%employee}} (id) ON DELETE CASCADE',
        ]);

        $this->createTable('{{%skill}}', [
            'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'VARCHAR(255) NOT NULL COMMENT "Название"',
        ]);
        $this->createTable('{{%skill_employee}}', [
            'skill_id' => 'INT(10) UNSIGNED NOT NULL',
            'employee_id' => 'INT(10) UNSIGNED NOT NULL',
            'PRIMARY KEY (skill_id, employee_id)',
            'FOREIGN KEY (skill_id) REFERENCES {{%skill}} (id) ON DELETE CASCADE',
            'FOREIGN KEY (employee_id) REFERENCES {{%employee}} (id) ON DELETE CASCADE',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%group_employee}}');
        $this->dropTable('{{%group}}');

        $this->dropTable('{{%skill_employee}}');
        $this->dropTable('{{%skill}}');

        $this->dropTable('{{%employee}}');
    }
}
