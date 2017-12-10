<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Menu</li>',
                    [
                        'label' => '<i class="glyphicon glyphicon-calendar"></i><span>Events</span>',
                        'url' => ['/events/index'],
                        'visible' =>!Yii::$app->user->isGuest
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-user"></i><span>My Characters</span>',
                        'url' => ['/characters/index'],
                        'visible' =>!Yii::$app->user->isGuest
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-log-in"></i><span>Sign in</span>',
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-flash"></i><span>Register</span>',
                        'url' => ['/site/register'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>
    </section>

</aside>
