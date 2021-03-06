<aside class="main-sidebar">

    <section class="sidebar">
        <?php
            $notifyEdit = common\models\Broker::notifyEdit();
            $agentUrl = ['/broker', 'sort' => '-group_id'];
            if ($notifyEdit) {
                $notifyEdit = " (".$notifyEdit.")";
                $agentUrl = ['/broker', 'sort' => '-edit'];
            }
            $notifyEdit = $notifyEdit ? " (".$notifyEdit.")" : '';
            $items = [
                ['label' => Yii::t('app', 'Sales'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('app', 'Sales'), 'icon' => 'fa fa-tags', 'url' => ['/sale']],
                ['label' => Yii::t('app', 'Objects'), 'icon' => 'fa fa-home', 'url' => ['/object']],
                ['label' => Yii::t('app', 'Map'), 'icon' => 'fa fa-map-marker', 'url' => ['/map']],

                ['label' => Yii::t('app', 'Users'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('app', 'Users'), 'icon' => 'fa fa-user', 'url' => ['/user']],
                ['label' => Yii::t('app', 'Agents').$notifyEdit, 'icon' => 'fa fa-user', 'url' => $agentUrl],

                ['label' => Yii::t('app', 'Params'), 'options' => ['class' => 'header']],
                ['label' => Yii::t('app', 'Regions'), 'icon' => 'fa fa-map', 'url' => ['/region']],
                ['label' => Yii::t('app', 'Districts'), 'icon' => 'fa fa-map-o', 'url' => ['/district']],
                ['label' => Yii::t('app', 'Facilities'), 'icon' => 'fa fa-coffee', 'url' => ['/facilities']],
                ['label' => Yii::t('app', 'Views'), 'icon' => 'fa fa-picture-o', 'url' => ['/view']],

                ['label' => 'Menu', 'options' => ['class' => 'header']],
                ['label' => Yii::t('app', 'Parser'), 'icon' => 'fa fa-file-excel-o', 'url' => ['/parser']],
                ['label' => Yii::t('app', 'Aliases'), 'icon' => 'fa fa-file-excel-o', 'url' => ['/alias']],
                ['label' => Yii::t('app', 'Phrases'), 'icon' => 'fa fa-font', 'url' => ['/message']],
            ];

            if (YII_DEBUG) $items[] = ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']];
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => $items,
            ]
        ) ?>

    </section>

</aside>
