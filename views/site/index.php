<?php
/**
 * @var yii\web\View $this
 * @var app\models\Employee $model
 * @var yii\data\ActiveDataProvider $dataProvider
 */
$this->title = 'Employees';
?>

<div class="site_index">

    <?=\yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $model,
        'columns' => [
            [
                'attribute' => 'id',
                'filter' => true,
                'filterOptions' => ['style' => 'width:100px'],
            ],
            'lastname',
            [
                'header' => 'Группы',
                'value' => function(\app\models\Employee $employee){
                    return implode(', ', array_map(function(\app\models\Group $group){
                        return $group->title;
                    }, $employee->groups));
                },
                'attribute' => 'filterByGroup',
                'filter' => \app\models\Group::getList(),
            ],
            [
                'header' => 'Навыки',
                'value' => function(\app\models\Employee $employee){
                    return implode(', ', array_map(function(\app\models\Skill $skill){
                        return $skill->title;
                    }, $employee->skills));
                },
                'attribute' => 'filterBySkill',
                'filter' => \app\models\Skill::getList(),
            ],
            [
                'attribute' => 'is_in_place',
                'value' => function(\app\models\Employee $employee){
                    return $employee->is_in_place ? 'Да' : 'Нет';
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
        ],
    ]) ?>

</div>
