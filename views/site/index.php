<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'BwnRaids';
?>
<div class="site-index">
    <?php if(isset($events) && !is_null($events) && count($events) > 0) : ?>
        <?php if(!Yii::$app->user->isGuest) : ?>
        <?php $form = ActiveForm::begin([
            'id' => 'quick-signup-form',
            'method' => 'post',
            'action' => '/site/index'
        ]); 
        $num = 0;
        if((time() >= strtotime($events[0]->event_date) && time() <= strtotime('+4 hours'))) $num = 1;
        ?>
        <input type="hidden" id="char_fk" name="char_fk" value="<?= (isset($main_char) ? $main_char->char_id : 0) ?>"/>
        <input type="hidden" id="event_fk" name="event_fk" value="<?= $events[$num]->event_id ?>"/>
        <div class="col-lg-12">
            <div id="quick-signup-box" class="box box-warning">
                <div class="box-header with-border">
                    <h3 id="box-title" class="box-title"><?= Yii::t('app','Quick Signup') ?></h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row" style="padding:5px 16px;">
                        <p class="pull-left">
                            Character: <?= (isset($main_char) ? $main_char->char_name.'-'.$main_char->char_realm : Yii::t('app','Please choose a main character.')) ?><br/>
                        </p>
                        <p class="pull-right">
                            Event: <?= $events[$num]->event_name.' @ '.date(Yii::t('app', 'l - H:i'), strtotime($events[$num]->event_date)) ?><br/>
                        </p>
                    </div>
                    <div class="row" style="padding:5px 16px;">
                        <div class="form-group">
                            <label><?= Yii::t('app', 'Signup note') ?></label>
                            <textarea id="signup_note" class="form-control" rows="3" <?= (!isset($main_char) ? 'disabled=""' : '') ?> name="signup_note"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div style="height:5px;"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <a id="not_attending_btn" href="#" class="btn btn-danger btn-flat btn-block btn-lg" <?= (!isset($main_char) ? 'disabled=""' : '') ?>><i class="fa fa-times"></i> <?= Yii::t('app', 'Not Attending') ?></a>
                        </div>
                        <div class="col-md-4">
                            <a id="maybe_btn" href="#" class="btn btn-default btn-flat btn-block btn-lg" <?= (!isset($main_char) ? 'disabled=""' : '') ?>><i class="fa fa-minus"></i> <?= Yii::t('app', 'Maybe') ?></a>
                        </div>
                        <div class="col-md-4">
                            <a id="signup_btn" href="#" class="btn btn-success btn-flat btn-block btn-lg" <?= (!isset($main_char) ? 'disabled=""' : '') ?>><i class="fa fa-check"></i> <?= Yii::t('app', 'Sign up') ?></a>
                        </div>
                    </div>
                    <div style="height:5px;"></div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div id="notif" class="alert bg-gray hidden" role="alert"><span id="notif-text">&nbsp;</span></div>
                        </div>
                    </div>
                </div>
                <!-- box-footer -->
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <?php endif; ?>
        <?php if(!Yii::$app->user->isGuest) : ?>
        <div class="col-lg-8">
        <?php else : ?>
        <div class="col-lg-12">
        <?php endif; ?>
            <div class="box box-primary upcoming">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app','Upcoming Events') ?></h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="timeline">
                        <?php foreach($events as $ev) : 
                            $cur_time = time();
                            $ev_time = strtotime($ev->event_date);
                            $isOngoing = ($cur_time >= $ev_time && $cur_time <= strtotime('+4 hours'));

                            $tank_number = 0;
                            $healer_number = 0;
                            $ranged_number = 0;
                            $melee_number = 0;
                            if(isset($signups[$ev->event_id])) {
                                $event_signups = $signups[$ev->event_id];
                                
                                foreach($event_signups as $signee) {
                                    switch($signee) {
                                        case 1:
                                            $tank_number++;
                                            break;
                                        case 2:
                                            $healer_number++;
                                            break;
                                        case 3:
                                            $ranged_number++;
                                            break;
                                        case 4:
                                            $melee_number++;
                                            break;
                                    }
                                }
                            }
                        ?>
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-white">
                                <?= date(Yii::t('app', 'l jS F, Y'), $ev_time) ?>
                            </span>
                        </li>
                        <!-- /.timeline-label -->

                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class="fa fa-<?= ($isOngoing ? 'lock' : 'calendar') ?> bg-<?= ($isOngoing ? 'red' : 'blue') ?>"></i>
                            <div class="timeline-item <?= ($isOngoing ? 'ongoing' : '') ?>" 
                                aria-eventid="<?= $ev->event_id ?>" 
                                aria-charid="<?= (int)(isset($main_char) ? $main_char->char_id : 0) ?>" 
                                aria-rankid="<?= (int)(!Yii::$app->user->isGuest ? Yii::$app->user->identity->user_fk_rank : 99) ?>" 
                                aria-ongoing="<?= (bool)($isOngoing) ?>">
                                <span class="time"><i class="fa fa-clock-o"></i> <?= date(Yii::t('app', 'H:i'), $ev_time) ?></span>

                                <h3 class="timeline-header"><?= $ev->event_name ?></h3>

                                <div class="timeline-body">
                                    <div class="row"><div class="col-xs-12"><p><?= $ev->event_note ?></p></div></div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="info-box bg-yellow">
                                                <span class="info-box-icon"><i class="fa fa-shield"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Tanks</span>
                                                    <span class="info-box-number"><?= $tank_number ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="info-box bg-green">
                                                <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Healers</span>
                                                    <span class="info-box-number"><?= $healer_number ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="info-box bg-red">
                                                <span class="info-box-icon"><i class="fa fa-gavel"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Melee</span>
                                                    <span class="info-box-number"><?= $melee_number ?></span>
                                                </div>
                                            </div>
                                            <div class="info-box bg-red">
                                                <span class="info-box-icon"><i class="fa fa-bullseye"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Ranged</span>
                                                    <span class="info-box-number"><?= $ranged_number ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-footer">
                                    <?php if(Yii::$app->user->isGuest) : ?>
                                        <?php if($isOngoing) : ?>
                                            <p><?= sprintf(Yii::t('app', 'You cannot sign up for %s as it is ongoing.'), $ev->event_name) ?></p>
                                        <?php else : ?>
                                            <p><?= sprintf(Yii::t('app', 'You need to sign in to sign up for %s.'), $ev->event_name) ?></p>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <!-- END timeline item -->
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.box -->
    <?php endif; ?>
    <?php if(isset($reports)) : $reports = array_reverse($reports); ?>
        <div class="col-lg-4">
            <div class="box box-success recent">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= Yii::t('app','Recent Logs') ?></h3>
                    <div class="box-tools pull-right">
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="timeline">
                        <?php for($i = 0; $i < count($reports); $i++) : $rep = $reports[$i]; ?>
                        <li class="time-label">
                            <span class="bg-white">
                                <?= date('jS F, Y', ($rep->start/1000)) ?>
                            </span>
                        </li>
                        <li>
                            <i class="fa fa-list bg-green"></i>
                            <div class="timeline-item" aria-reportid="<?= $rep->id ?>">
                                <h3 class="timeline-header" style="border-width:0;"><?= $rep->title ?></h3>
                            </div>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    <?php endif; ?>
    <!-- /.box -->
    <div id="ongoing-dialog" title="Ongoing event" style="display:none;">
        <p>You cannot sign up to an ongoing event. Please sign up to an other event or ask an officer in guild if there's a free spot.</p>
    </div>
</div>
