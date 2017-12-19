<?php
/* @var $this yii\web\View */

$this->title = 'Event: '.$event->event_name;
$this->params['breadcrumbs'][] = $this->title;

$tanks = [];
$healers = [];
$ranged = [];
$melee = [];

$tanks_total = 0;
$healers_total = 0;
$ranged_total = 0;
$melee_total = 0;

$amIsigned = false;
$amImaybe = false;
$amIreserve = false;
$amIdrafted = false;
$amIna = false;

if(isset($signups)) {
    foreach($signups as $signee) {
        switch($signee['char']->char_id) {
            case Yii::$app->user->identity->user_id:
                if($signee['status'] == 1) {
                    $amIna = true;
                } elseif($signee['status'] == 2) {
                    $amImaybe = true; 
                } elseif($signee['status'] == 3) {
                    $amIsigned = true;
                } elseif($signee['status'] == 4) {
                    $amIdrafted = true;
                }
                break;
        }
        switch($signee['char']->char_mainrole) {
            case 1:
                $tanks_total++;
                $tanks[$signee['status']][] = $signee['char']->char_name;
                break;
            case 2:
                $healers_total++;
                $healers[$signee['status']][] = $signee['char']->char_name;
                break;
            case 3:
                $ranged_total++;
                $ranged[$signee['status']][] = $signee['char']->char_name;
                break;
            case 4:
                $melee_total++;
                $melee[$signee['status']][] = $signee['char']->char_name;
                break;
        }
    }
}

?>
<div class="box box-primary single-event">
    <div class="box-header with-border">
        <span class="pull-right time"><?= date(Yii::t('app', 'l jS F, Y'), strtotime($event->event_date)) ?></span>
        <h3 class="box-title"><?= $this->title ?></h3>
    </div>
    <div class="box-body">
        <div class="row"><div class="col-xs-12"><p><?= $event->event_note ?></p></div></div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-shield"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tanks</span>
                            <span class="info-box-number"><?= $tanks_total ?></span>
                        </div>
                    </div>
                    <?php if(isset($tanks[4])) : foreach($tanks[4] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks[3])) : foreach($tanks[3] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks[2])) : foreach($tanks[2] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks[5])) : foreach($tanks[5] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks[1])) : foreach($tanks[1] as $t) : ?>
                    <span class="status not-available"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-3">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Healers</span>
                            <span class="info-box-number"><?= $healers_total ?></span>
                        </div>
                    </div>
                    <?php if(isset($healers[4])) : foreach($healers[4] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers[3])) : foreach($healers[3] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers[2])) : foreach($healers[2] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers[5])) : foreach($healers[5] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers[1])) : foreach($healers[1] as $t) : ?>
                    <span class="status not-available"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-3">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-gavel"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ranged</span>
                            <span class="info-box-number"><?= $ranged_total ?></span>
                        </div>
                    </div>
                    <?php if(isset($ranged[4])) : foreach($ranged[4] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged[3])) : foreach($ranged[3] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged[2])) : foreach($ranged[2] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged[5])) : foreach($ranged[5] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged[1])) : foreach($ranged[1] as $t) : ?>
                    <span class="status not-available"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-3">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-bullseye"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Melee</span>
                            <span class="info-box-number"><?= $melee_total ?></span>
                        </div>
                    </div>
                    <?php if(isset($melee[4])) : foreach($melee[4] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee[3])) : foreach($melee[3] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee[2])) : foreach($melee[2] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee[5])) : foreach($melee[5] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee[1])) : foreach($melee[1] as $t) : ?>
                    <span class="status not-available"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                </div>
            </div>
            <div class="row">&nbsp;</div>
            <div class="row">
                <?php if(Yii::$app->user->identity->user_fk_rank <= 2) : ?>
                <div class="col-lg-4">
                    <a class="sign-to-event btn btn-block btn-flat btn-success" href="#"><i class="fa fa-check" aria-hidden="true"></i> Sign up to <?= $event->event_name ?></a>
                </div>
                <div class="col-lg-4">
                    <a class="edit-event btn btn-block btn-flat btn-primary" href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit <?= $event->event_name ?></a>
                </div>
                <div class="col-lg-4">
                    <a class="show-invite-macro btn btn-block btn-flat btn-primary" href="#"><i class="fa fa-list" aria-hidden="true"></i> Show Invite Macro</a>
                </div>
                <?php else : ?>
                <div class="col-lg-offset-6 col-lg-6">
                    <a class="sign-to-event btn btn-block btn-flat btn-success" href="#"><i class="fa fa-check" aria-hidden="true"></i> Sign up to <?= $event->event_name ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>