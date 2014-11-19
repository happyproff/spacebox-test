<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%skill_employee}}".
 *
 * @property integer $skill_id
 * @property integer $employee_id
 *
 * @property Skill $skill
 * @property Employee $employee
 */
class SkillEmployee extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%skill_employee}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skill_id', 'employee_id'], 'required'],
            [['skill_id', 'employee_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'skill_id' => 'Skill ID',
            'employee_id' => 'Employee ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'skill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }
}
