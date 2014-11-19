<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%skill}}".
 *
 * @property integer $id
 * @property string $title
 *
 * @property SkillEmployee[] $skillEmployees
 * @property Employee[] $employees
 */
class Skill extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%skill}}';
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
    public function getSkillEmployees()
    {
        return $this->hasMany(SkillEmployee::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['id' => 'employee_id'])->viaTable('{{%skill_employee}}', ['skill_id' => 'id']);
    }

    public static function getList()
    {
        $list = [];
        foreach (self::find()->all() as $skill) {
            /** @var Skill $skill */
            $list[$skill->id] = $skill->title;
        }

        return $list;
    }
}
