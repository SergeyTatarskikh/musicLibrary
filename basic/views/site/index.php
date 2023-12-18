<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use app\models\Music;
$this->registerCssFile('@web/css/styles.css');
$this->registerJsFile('@web/js/script.js', ['depends' => [\yii\web\JqueryAsset::class]]);

$model = new \app\models\MusicForm();
?>

<?php $form = ActiveForm::begin([
    'action' => '?r=site/add',
    'method' => 'post',
]); ?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($model, 'year')->label('Год')->textInput(['id' => 'year-input', 'class' => $model->hasErrors('year') ? 'form-control is-invalid' : 'form-control', 'value' => isset($_GET['id']) ? Music::findOne($_GET['id'])->year : '']) ?>
        <?php if ($model->hasErrors('year')): ?>
            <div class="invalid-feedback">
                <?= $model->getFirstError('year') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'executor')->label('Исполнитель')->textInput(['id' => 'executor-input', 'class' => $model->hasErrors('executor') ? 'form-control is-invalid' : 'form-control', 'value' => isset($_GET['id']) ? Music::findOne($_GET['id'])->executor : '']) ?>
        <?php if ($model->hasErrors('executor')): ?>
            <div class="invalid-feedback">
                <?= $model->getFirstError('executor') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'album')->label('Альбом')->textInput(['id' => 'album-input', 'class' => $model->hasErrors('album') ? 'form-control is-invalid' : 'form-control', 'value' => isset($_GET['id']) ? Music::findOne($_GET['id'])->album : '']) ?>
        <?php if ($model->hasErrors('album')): ?>
            <div class="invalid-feedback">
                <?= $model->getFirstError('album') ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-3">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'style' => 'margin-top: 25px;', 'id' => 'toggle-button']) ?>
    </div>
</div>

<?php ActiveForm::end()?>

<div class="row">
    <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => new \yii\data\ActiveDataProvider([
                'query' => Music::find(),
                'sort' => [
                    'defaultOrder' => [
                        'year' => SORT_DESC,
                    ]
                ],
            ]),
            'columns' => [
                'id',
                [
                    'attribute' => 'year',
                    'label' => 'Год',
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'executor',
                    'label' => 'Исполнитель',
                    'enableSorting' => true,
                ],
                [
                    'attribute' => 'album',
                    'label' => 'Альбом',
                    'enableSorting' => true,
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{updt} {del}',
                    'buttons' => [
                        'updt' => function ($url, $model, $key) {
                            return Html::button('Изменить', [
                                'class' => 'btn btn-primary',
                                'onclick' => 'toggleButtonText(this, ' . $model->id . ')'
                            ]);
                        },
                        'del' => function ($url, $model, $key) {
                            return Html::a('Удалить', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => ['confirm' => 'Вы уверены, что хотите удалить этот элемент?', 'method' => 'post']
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>

