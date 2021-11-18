<aside class="main-sidebar">
    <section class="sidebar">
        <?php
            $config = [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Инфраструктура', 'options' => ['class' => 'header']],
                    ['label' => 'Точки доступа', 'icon' => 'wifi', 'url' => ['/wifi-spot']],
                    ['label' => 'Справочники', 'options' => ['class' => 'header']],
                    ['label' => 'Города', 'icon' => 'building', 'url' => ['/city']],
                    ['label' => 'Языки', 'icon' => 'language', 'url' => ['/language']],
                    ['label' => 'Прочее', 'options' => ['class' => 'header']],
                    /*
                    [
                        'label' => 'Разработка',
                        'icon' => 'wrench',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']]
                        ],
                    ],
                    */
                    ['label' => 'Вход', 'icon' => 'power-off', 'url' => ['auth/login'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Выйти', 'icon' => 'power-off', 'url' => ['auth/logout'], 'template' => '<a href="{url}" data-confirm="Вы уверены, что хотите выйти?" data-method="post">{icon} {label}</a>', 'visible' => !Yii::$app->user->isGuest],
                ],
            ];
        ?>
        <?= dmstr\widgets\Menu::widget($config) ?>
    </section>
</aside>
