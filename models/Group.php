<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%group}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property GroupEmployee[] $groupEmployees
 * @property Employee[] $employees
 */
class Group extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupEmployees()
    {
        return $this->hasMany(GroupEmployee::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['id' => 'employee_id'])->viaTable('{{%group_employee}}', ['group_id' => 'id']);
    }

    public static function getList()
    {
        $list = [];
        foreach (self::find()->all() as $group) {
            /** @var Group $group */
            $list[$group->id] = $group->title;
        }

        return $list;
    }
}
