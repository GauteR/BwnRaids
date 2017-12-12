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
                        'label' => '<i class="fa fa-home"></i><span>Home</span>',
                        'url' => ['/site/index']
                    ],
                    [
                        'label' => '<i class="fa fa-user"></i><span>My Characters</span>',
                        'url' => ['/characters/index'],
                        'visible' =>!Yii::$app->user->isGuest
                    ],
                    [
                        'label' => '<i class="fa fa-sign-in"></i><span>Sign in</span>',
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                    [
                        'label' => '<i class="fa fa-bolt"></i><span>Register</span>',
                        'url' => ['/site/register'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>
    </section>

</aside>
