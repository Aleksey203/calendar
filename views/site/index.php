<?php
/* @var $this yii\web\View */
$this->title = 'Alpha Clients';
?>
<div class="mastersGraph graph">
    <?php foreach ($masters as $k=>$v) {
        $checked = ($k==0) ? 'checked' : '';
         ?>
        <div class="master <?=$checked;?>"
             data-master-id="<?=$v['id'];?>">
            <div class="photowrapper">
                <img src="/images/man.png">
            </div>
            <div
                class="name"><?=$v['name'];?></div>
            <div class="profession"><?=$v['status'];?></div>
        </div>
    <?php } ?>
</div>
