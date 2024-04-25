<?php

$teb1Id = 'detailOrg';
$teb1Name = 'ข้อมูลหน่วยงาน';
$teb2Id = 'adminOrg';
$teb2Name = 'เจ้าหน้าที่ของหน่วยงาน';
$teb3Id = 'apiOrg';
$teb3Name = 'กำหนดการเข้าถึง API';

?>
<ul class="nav nav-tabs  tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#<?php echo $teb1Id; ?>_tab" role="tab" aria-expanded="false">
            <?php echo $teb1Name; ?></a>
    </li>
    <?php if ($orgId != '') { ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#<?php echo $teb2Id; ?>_tab" role="tab" aria-expanded="true"><?php echo $teb2Name; ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#<?php echo $teb3Id; ?>_tab" role="tab" aria-expanded="true"><?php echo $teb3Name; ?></a>
        </li>
        <?php /*
        <li class="nav-item">
            <a class="nav-link" href="<?php echo create_link('../form/api_org_manage_service.php', $_GET, array(), array('wf_order', 'wf_order_type')); ?>"><?php echo $teb2Name; ?></a>
        </li>
         */ ?>
    <?php } ?>
</ul>