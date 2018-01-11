<?php
/* @var $this yii\web\View */

$this->title = 'Event: '.$event->event_name;
$this->params['breadcrumbs'][] = $this->title;

$tanks = [];
$healers = [];
$ranged = [];
$melee = [];

$tanks_signed_total = 0; $tanks_maybe_total = 0; $tanks_notattending_total = 0; $tanks_drafted_total = 0; $tanks_reserve_total = 0;
$healers_signed_total = 0; $healers_maybe_total = 0; $healers_notattending_total = 0; $healers_drafted_total = 0; $healers_reserve_total = 0;
$ranged_signed_total = 0; $ranged_maybe_total = 0; $ranged_notattending_total = 0; $ranged_drafted_total = 0; $ranged_reserve_total = 0;
$melee_signed_total = 0; $melee_maybe_total = 0; $melee_notattending_total = 0; $melee_drafted_total = 0; $melee_reserve_total = 0;

$amIsigned = false;
$amImaybe = false;
$amIreserve = false;
$amIdrafted = false;
$amIna = false;

if(isset($draftees)) {
    foreach($draftees as $signee) {
        switch($signee['char']->char_id) {
            case Yii::$app->user->identity->user_id:
                $amIdrafted = true;
                break;
        }
        switch($signee['char']->char_mainrole) {
            case 1:
                $tanks_drafted_total++;
                $tanks['drafted'][] = $signee['char']->char_name;
                break;
            case 2:
                $healers_drafted_total++;
                $healers['drafted'][] = $signee['char']->char_name;
                break;
            case 3:
                $ranged_drafted_total++;
                $ranged['drafted'][] = $signee['char']->char_name;
                break;
            case 4:
                $melee_drafted_total++;
                $melee['drafted'][] = $signee['char']->char_name;
                break;
        }
    }
}
if(isset($signups)) {
    foreach($signups as $signee) {
        switch($signee['char']->char_id) {
            case Yii::$app->user->identity->user_id:
                $amIsigned = true;
                break;
        }
        switch($signee['char']->char_mainrole) {
            case 1:
                $tanks_signed_total++;
                $tanks['signed'][] = $signee['char']->char_name;
                break;
            case 2:
                $healers_signed_total++;
                $healers['signed'][] = $signee['char']->char_name;
                break;
            case 3:
                $ranged_signed_total++;
                $ranged['signed'][] = $signee['char']->char_name;
                break;
            case 4:
                $melee_signed_total++;
                $melee['signed'][] = $signee['char']->char_name;
                break;
        }
    }
}
if(isset($maybes)) {
    foreach($maybes as $signee) {
        switch($signee['char']->char_id) {
            case Yii::$app->user->identity->user_id:
                $amImaybe = true;
                break;
        }
        switch($signee['char']->char_mainrole) {
            case 1:
                $tanks_maybe_total++;
                $tanks['maybe'][] = $signee['char']->char_name;
                break;
            case 2:
                $healers_maybe_total++;
                $healers['maybe'][] = $signee['char']->char_name;
                break;
            case 3:
                $ranged_maybe_total++;
                $ranged['maybe'][] = $signee['char']->char_name;
                break;
            case 4:
                $melee_maybe_total++;
                $melee['maybe'][] = $signee['char']->char_name;
                break;
        }
    }
}
if(isset($notavailables)) {
    foreach($notavailables as $signee) {
        switch($signee['char']->char_id) {
            case Yii::$app->user->identity->user_id:
                $amIna = true;
                break;
        }
        switch($signee['char']->char_mainrole) {
            case 1:
                $tanks_notattending_total++;
                $tanks['notattending'][] = $signee['char']->char_name;
                break;
            case 2:
                $healers_notattending_total++;
                $healers['notattending'][] = $signee['char']->char_name;
                break;
            case 3:
                $ranged_notattending_total++;
                $ranged['notattending'][] = $signee['char']->char_name;
                break;
            case 4:
                $melee_notattending_total++;
                $melee['notattending'][] = $signee['char']->char_name;
                break;
        }
    }
}
if(isset($reserves)) {
    foreach($reserves as $signee) {
        switch($signee['char']->char_id) {
            case Yii::$app->user->identity->user_id:
                $amIreserve = true;
                break;
        }
        switch($signee['char']->char_mainrole) {
            case 1:
                $tanks_reserve_total++;
                $tanks['reserve'][] = $signee['char']->char_name;
                break;
            case 2:
                $healers_reserve_total++;
                $healers['reserve'][] = $signee['char']->char_name;
                break;
            case 3:
                $ranged_reserve_total++;
                $ranged['reserve'][] = $signee['char']->char_name;
                break;
            case 4:
                $melee_reserve_total++;
                $melee['reserve'][] = $signee['char']->char_name;
                break;
        }
    }
}


?>
<div class="box box-primary single-event <?php
    if($amIdrafted) "drafted ";
    if($amIsigned) "signed ";
    if($amImaybe) "maybe ";
    if($amIna) "notavailable ";
?>">
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
                            <span class="info-box-number"><?= $tanks_drafted_total ?> | <?= $tanks_reserve_total ?></span><span class="info-box-number" style="color:#ccc;font-size:0.6em;"> ( <?= $tanks_signed_total ?> | <?= $tanks_maybe_total ?> | <?= $tanks_notattending_total ?> )</span>
                        </div>
                    </div>
                    <?php if(isset($tanks['drafted'])) : foreach($tanks['drafted'] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks['signed'])) : foreach($tanks['signed'] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks['maybe'])) : foreach($tanks['maybe'] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks['reserve'])) : foreach($tanks['reserve'] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($tanks['notattending'])) : foreach($tanks['notattending'] as $t) : ?>
                    <span class="status not-available"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-3">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-medkit"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Healers</span>
                            <span class="info-box-number"><?= $healers_drafted_total ?> | <?= $healers_reserve_total ?></span><span class="info-box-number" style="color:#ccc;font-size:0.6em;"> ( <?= $healers_signed_total ?> | <?= $healers_maybe_total ?> | <?= $healers_notattending_total ?> )</span>
                        </div>
                    </div>
                    <?php if(isset($healers['drafted'])) : foreach($healers['drafted'] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers['signed'])) : foreach($healers['signed'] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers['maybe'])) : foreach($healers['maybe'] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers['reserve'])) : foreach($healers['reserve'] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($healers['notattending'])) : foreach($healers['notattending'] as $t) : ?>
                    <span class="status not-available"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-3">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-gavel"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Ranged</span>
                            <span class="info-box-number"><?= $ranged_drafted_total ?> | <?= $ranged_reserve_total ?></span><span class="info-box-number" style="color:#ccc;font-size:0.6em;"> ( <?= $ranged_signed_total ?> | <?= $ranged_maybe_total ?> | <?= $ranged_notattending_total ?> )</span>
                        </div>
                    </div>
                    <?php if(isset($ranged['drafted'])) : foreach($ranged['drafted'] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged['signed'])) : foreach($ranged['signed'] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged['maybe'])) : foreach($ranged['maybe'] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged['reserve'])) : foreach($ranged['reserve'] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($ranged['notattending'])) : foreach($ranged['notattending'] as $t) : ?>
                    <span class="status not-available"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                </div>
                <div class="col-lg-3">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-bullseye"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Melee</span>
                            <span class="info-box-number"><?= $melee_drafted_total ?> | <?= $healers_reserve_total ?></span><span class="info-box-number" style="color:#ccc;font-size:0.6em;"> ( <?= $healers_signed_total ?> | <?= $healers_maybe_total ?> | <?= $healers_notattending_total ?> )</span>
                        </div>
                    </div>
                    <?php if(isset($melee['drafted'])) : foreach($melee['drafted'] as $t) : ?>
                    <span class="status drafted"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee['signed'])) : foreach($melee['signed'] as $t) : ?>
                    <span class="status signed"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee['maybe'])) : foreach($melee['maybe'] as $t) : ?>
                    <span class="status maybe"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee['reserve'])) : foreach($melee['reserve'] as $t) : ?>
                    <span class="status reserve"><?= $t ?></span><br/>
                    <?php endforeach; endif; ?>
                    <?php if(isset($melee['notattending'])) : foreach($melee['notattending'] as $t) : ?>
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