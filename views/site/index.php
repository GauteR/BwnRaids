<?php

/* @var $this yii\web\View */
use  yii\helpers\Html;
$this->title = 'BwnRaids';
?>
<div class="site-index">
    <?php if(isset($events) && !is_null($events) && count($events) > 0) : ?>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><?= Yii::t('app','Upcoming Events') ?></h3>
            <div class="box-tools pull-right">
            </div>
            <!-- /.box-tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <ul class="timeline">
                <?php foreach($events as $ev) : ?>
                <!-- timeline time label -->
                <li class="time-label">
                    <span class="bg-red">
                        <?= date(Yii::t('app', 'l d.m.Y'), strtotime($ev->event_date)) ?>
                    </span>
                </li>
                <!-- /.timeline-label -->

                <!-- timeline item -->
                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-calendar bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?= date(Yii::t('app', 'H:i'), strtotime($ev->event_date)) ?></span>

                        <h3 class="timeline-header"><a href="#"><?= $ev->event_name ?></a> ...</h3>

                        <div class="timeline-body">
                            <div class="row"><?= $ev->event_note ?></div>
                            <br/>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-shield"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Tanks</span>
                                            <span class="info-box-number" style="font-size:2.6em;">2</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-medkit"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Healers</span>
                                            <span class="info-box-number" style="font-size:2.6em;">4</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa fa-fire"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Melee Damage</span>
                                            <span class="info-box-number" style="font-size:2.6em;">4</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa fa-fire"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">Ranged Damage</span>
                                            <span class="info-box-number" style="font-size:2.6em;">4</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="timeline-footer">
                            <?php if(Yii::$app->user->isGuest) : ?>
                            <a href="/site/login" class="btn btn-primary btn-lg"><?= Yii::t('app', 'Sign in to sign up for ').$ev->event_name ?></a>
                            <?php else : ?>
                            <a href="/events/signup?event_id=<?= $ev->event_id ?>" class="btn btn-primary btn-lg"><?= Yii::t('app', 'View ').$ev->event_name ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
                <!-- END timeline item -->
            </ul>
        </div>
        <!-- /.box-body -->
        <?php if(!Yii::$app->user->isGuest) : ?>
        <div class="box-footer">
            <?= Html::a('Sign up for events', ['events/index'], ['class' => 'btn btn-success']) ?>
        </div>
        <?php endif; ?>
        <!-- box-footer -->
    </div>
    <!-- /.box -->
    <?php endif; ?>

</div>
