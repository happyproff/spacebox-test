<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;



/**
 * This is the model class for table "{{%employee}}".
 *
 * @property integer $id
 * @property string $lastname
 * @property integer $is_in_place
 *
 * @property GroupEmployee[] $groupEmployees
 * @property Group[] $groups
 * @property SkillEmployee[] $skillEmployees
 * @property Skill[] $skills
 */
class Employee extends ActiveRecord
{
    public $filterByGroup = 0;
    public $filterBySkill = 0;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lastname'], 'required', 'on' => ['create', 'update']],
            [['is_in_place'], 'boolean'],
            [['lastname'], 'string', 'max' => 64],

            [['id'], 'safe', 'on' => 'search'],
        ];
    }

    public function scenarios () {

        return array_merge(
            parent::scenarios(),
            [
                'search' => ['id', 'lastname', 'filterByGroup', 'filterBySkill', 'is_in_place'],
            ]
        );

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastname' => 'Фамилия',
            'is_in_place' => 'На месте',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupEmployees()
    {
        return $this->hasMany(GroupEmployee::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['id' => 'group_id'])->viaTable('{{%group_employee}}', ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkillEmployees()
    {
        return $this->hasMany(SkillEmployee::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skill::className(), ['id' => 'skill_id'])->viaTable('{{%skill_employee}}', ['employee_id' => 'id']);
    }

    public static function getInPlaceList()
    {
        return [0 => 'Нет', 1 => 'Да'];
    }

    public function search ($params)
    {
        /** @var ActiveQuery $query */
        $query = Employee::find()->with(['groups', 'skills']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_ASC,
                ]
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['id' => $this->id])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'is_in_place', $this->is_in_place]);

        if ($this->filterByGroup) {
            $groupIds = GroupEmployee::find()
                ->select(['employee_id'])
                ->distinct(true)
                ->andFilterWhere(['group_id' => $this->filterByGroup])
                ->asArray(true)
                ->column();
            ;
            $query->andFilterWhere(['id' => $groupIds]);
        }

        if ($this->filterBySkill) {
            $skillIds = SkillEmployee::find()
                ->select(['employee_id'])
                ->distinct(true)
                ->andFilterWhere(['skill_id' => $this->filterBySkill])
                ->asArray(true)
                ->column();
            ;
            $query->andFilterWhere(['id' => $skillIds]);
        }

        return $dataProvider;
    }
}
