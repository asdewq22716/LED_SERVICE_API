
<style> 
p.test {
    width: 100%; 
    border: 0px solid #000000;
    word-wrap: break-word;
    font-size:15px;
}
</style>
</div>
    <div class="form-group row">
        <div id="TOKEN_ID_BSF_AREA" class="col-md-2 ">
            <label for="TOKEN_ID" class="form-control-label wf-right">TOKEN_ID</label>
        </div>
        <div id="TOKEN_ID_BSF_AREA" class="col-md-4 wf-left">
            <p class="test">
                <?php echo($WF['TOKEN_ID']); ?>
            </p>
        </div>
    </div>

    <?php 

    $sql = db::query("SELECT * FROM M_SYSTEM WHERE SYSTEM_ID = '".$WF['DEP_ID']."'");
    $data = db::fetch_array($sql);
    ?>
    <div class="form-group row">
        <div id="DEP_ID_BSF_AREA" class="col-md-2 ">
            <label for="DEP_ID" class="form-control-label wf-right">DEP_ID</label>
        </div>
        <div id="DEP_ID_BSF_AREA" class="col-md-4 wf-left">
                <?php echo($data['SYS_NAME']); ?>
        </div>
    </div>


    <?php 
    
    $sql1 = db::query("SELECT TO_CHAR(LOG_DATE, 'YYYY-MM-DD hh24:mi:ss') AS DATELOG  FROM M_LOG WHERE LOG_ID = '".$WF['LOG_ID']."'");
    $data1 = db::fetch_array($sql1);

    $datadate = $data1['DATELOG'];

    $setdate = substr($datadate,0,10);
    $time = substr($datadate,11,19);
    $date = db2date($setdate);
 
    ?>
    <div class="form-group row">
        <div id="LOG_DATE_BSF_AREA" class="col-md-2 ">
            <label for="LOG_DATE" class="form-control-label wf-right">LOG_DATE</label>
        </div>
        <div id="LOG_DATE_BSF_AREA" class="col-md-4 wf-left">
                <?php echo $date.' '.$time; ?>
        </div>
    </div>

