
<?php include 'comtop.php';
include 'include/comtop_user.php';
session_start();
?>
    <!--::header part start::-->
    <?php include 'header.php';
    $service_id = $_GET['SERVICE_ID'];
    $soap_request = db::query("SELECT
                              	b.*,
                                a.SERVICE_NAME,
                                a.SERVICE_CODE,
                                a.SERVICE_DESC
                              FROM
                              	M_SERVICE_MANAGE a
                              INNER JOIN M_SERVICE_REQUEST b ON a.SERVICE_MANAGE_ID = b.SERVICE_MANAGE_ID
                              WHERE a.SERVICE_MANAGE_ID = '".$service_id."'
                              ORDER BY b.REQUEST_ID ASC");
    $sql_main = db::query("SELECT
                                a.SERVICE_NAME,
                                a.SERVICE_CODE,
                                a.SERVICE_DESC
                              FROM
                              	M_SERVICE_MANAGE a
                              INNER JOIN M_SERVICE_REQUEST b ON a.SERVICE_MANAGE_ID = b.SERVICE_MANAGE_ID
                              WHERE a.SERVICE_MANAGE_ID = '".$service_id."'
                              ORDER BY b.REQUEST_ID ASC");
    $name = db::fetch_array($sql_main);
    $sql_response = db::query("SELECT
                                	b.*
                                FROM
                                	M_SERVICE_MANAGE a
                                	INNER JOIN M_SERVICE_RESPONSE b ON a.SERVICE_MANAGE_ID = b.SERVICE_MANAGE_ID
                                WHERE
                                	a.SERVICE_MANAGE_ID = '".$service_id."'
                                ORDER BY
                                	b.RESPONSE_ID");
    $sql_request = db::query("SELECT
                                b.*
                              FROM
                              	M_SERVICE_MANAGE a
                              INNER JOIN M_SERVICE_REQUEST b ON a.SERVICE_MANAGE_ID = b.SERVICE_MANAGE_ID
                              WHERE a.SERVICE_MANAGE_ID = '".$service_id."'
                              ORDER BY b.REQUEST_ID ASC");
    $num_req = db::query("SELECT DISTINCT
                          	b.REQUEST_NAME
                          FROM
                          	M_SERVICE_MANAGE a
                          	INNER JOIN M_SERVICE_REQUEST b ON a.SERVICE_MANAGE_ID = b.SERVICE_MANAGE_ID
                          WHERE
                          	a.SERVICE_MANAGE_ID = '".$service_id."'");
    $req_row = db::num_rows($num_req);
    if($req_row > 9){
      $scrollbar_req = "style=\"height: 410px; overflow-y: scroll;\"";
    }else{
      $scrollbar_req = "";
    }

    $num_res = db::query("SELECT DISTINCT
                          	b.RESPONSE_NAME
                          FROM
                          	M_SERVICE_MANAGE a
                          	INNER JOIN M_SERVICE_RESPONSE b ON a.SERVICE_MANAGE_ID = b.SERVICE_MANAGE_ID
                          WHERE
                          	a.SERVICE_MANAGE_ID = '".$service_id."'");
    $res_row = db::num_rows($num_res);
    if($res_row > 9){
      $scrollbar_res = "style=\"height: 410px; overflow-y: scroll;\"";
    }else{
      $scrollbar_req = "";
    }
    ?>
    <style>
      .table {
        margin-bottom: auto;
      }
      th {
        color: white;
      }
    </style>
    <!-- Header part end-->

    <!-- breadcrumb start -->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                            <h2>API Documentation</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb start-->


    <section id="tabs">
    	<div class="container">
      		<div class="row">
                <div class="col-md-4">
                <?php include 'left_menu.php';?>

                </div>
                <div class="col-md-8">
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6"><?php include 'api_service_list_menu.php';?></div>
                  </div>
                  <div class="row">
                    <div class="col-md-11"><h4>Service Name : <?php echo $name['SERVICE_NAME']." (".$name['SERVICE_CODE']." : ".$name['SERVICE_DESC'].")";?></h4></div>
                    <div class="col-md-1"></div>
                  </div>
                    <!-- show lis api -->

                    <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#apisoap">API SOAP</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#apirest">API REST</a>
    </li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="apisoap" class="container tab-pane active"><br>
      <h3>API SOAP</h3>
      <div class="mt-3 ">
        <div data-v-c38ff134="" class="prism-editor-wrapper my-editor">
          <div aria-hidden="true" class="prism-editor__line-numbers"></div>
        </div>

      <pre contenteditable="false" spellcheck="false" autocapitalize="off" autocomplete="off" autocorrect="off" data-gramm="false" class="prism-editor__code  language-text text-left">
        <!-- <code class=" language-text"> -->
  บริการ Track and Trace Web service(SOAP)
    การใช้งานสำหรับผู้ใช้บริการ
    1.นำ TokenID ที่ทำการสมัครสมาชิกไปใช้งานกับ web service (SOAP) ได้เลย
    2.ลูกค้าเรียกใช้งาน Web service โดยเรียก URL ไปยัง
    <label style="color:blue;">http://103.208.27.224:81/led_service_api/api/temp_wsdl.php?wsdl</label>
    โดยมี 2 function ให้ใช้งาน คือ
      - GetItems() สำหรับ WebService แบบ Real time
      - RequestItems() สำหรับ เรียกบริการแบบ Batch Jobs Process
        <!-- </code> -->
      </pre>
    </div>
    <br />
        <h5>Request Parameter</h5>
        <div class="table-responsive">
          <table class="table">
            <thead class="breadcrumb_bg">
              <tr>
                <th scope="col">KEY</th>
                <th scope="col">TYPE</th>
                <!-- <th scope="col">M/O</th> -->
                <th scope="col">คำอธิบาย</th>
                <th scope="col">ตัวอย่าง</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $a = 1;
              $req_soap_key = array();
              while ($rec_data = db::fetch_array($soap_request)) {
                if(sizeof($req_soap_key) == 0){
                  $req_soap_key[$a] = $rec_data['REQUEST_NAME'];
                  echo "<tr>
                  <td>".$rec_data['REQUEST_NAME']."</td>
                  <td>".$rec_data['REQUEST_TYPE']."</td>
                  <td>".$rec_data['REQUEST_DESC']."</td>
                  <td>".$rec_data['REQUEST_EX']."</td>
                  </tr>";
                  $a++;
                }else{
                  foreach ($req_soap_key as $key => $value) {
                    if(empty(array_search($rec_data['REQUEST_NAME'],$req_soap_key))){
                      echo "<tr>
                      <td>".$rec_data['REQUEST_NAME']."</td>
                      <td>".$rec_data['REQUEST_TYPE']."</td>
                      <td>".$rec_data['REQUEST_DESC']."</td>
                      <td>".$rec_data['REQUEST_EX']."</td>
                      </tr>";
                      $req_soap_key[$a] = $rec_data['REQUEST_NAME'];
                      $a++;
                    }
                  }
                }
              }?>
            </tbody>
          </table>
        </div>
        <h5>Body</h5>
        <div class="mt-3 ">
          <!-- <div data-v-c38ff134="" class="prism-editor-wrapper my-editor">
            <div aria-hidden="true" class="prism-editor__line-numbers"></div>
          </div> -->

        <!-- <pre contenteditable="false" spellcheck="false" autocapitalize="off" autocomplete="off" autocorrect="off" data-gramm="false" class="prism-editor__code  language-text"> -->
          <br />
<textarea rows="20" cols="85" style="border:none; resize:none;">
<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:urn="urn:LED_SERVICE">
    <soapenv:Header/>
    <soapenv:Body>
      <urn:civilCaseDetail soapenv:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">
        <civilCode xsi:type="xsd:string">?</civilCode>
        <courtCode xsi:type="xsd:string">?</courtCode>
        <deptCode xsi:type="xsd:string">?</deptCode>
        <prefixBlackCase xsi:type="xsd:string">?</prefixBlackCase>
        <blackCase xsi:type="xsd:string">?</blackCase>
        <plackYY xsi:type="xsd:string">?</plackYY>
        <prefixRedCase xsi:type="xsd:string">?</prefixRedCase>
        <redCase xsi:type="xsd:string">?</redCase>
        <redYY xsi:type="xsd:string">?</redYY>
        <dossId xsi:type="xsd:string">?</dossId>
        <dossControl xsi:type="xsd:string">?</dossControl>
      </urn:civilCaseDetail>
    </soapenv:Body>
</soapenv:Envelope>
</textarea>
        <!-- </pre> -->
      </div>

    </div>
    <div id="apirest" class="container tab-pane fade"><br>
      <h3>API REST</h3>
      <br />
        <h5>URL</h5>

        <div class="mt-3 ">
          <div data-v-c38ff134="" class="prism-editor-wrapper my-editor">
            <div aria-hidden="true" class="prism-editor__line-numbers"></div>
          </div>

        <pre contenteditable="false" spellcheck="false" autocapitalize="off" autocomplete="off" autocorrect="off" data-gramm="false" class="prism-editor__code  language-text">
          <code class=" language-text"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Endpoint:  http://103.208.27.224:81/led_service_api/api/public/<?php echo $name['SERVICE_NAME'];?><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Method  : &nbsp;POST
          </code>
        </pre>
      </div>
      <br />

      <h5>Header</h5>

      <div class="mt-3 ">
        <div data-v-c38ff134="" class="prism-editor-wrapper my-editor">
          <div aria-hidden="true" class="prism-editor__line-numbers"></div>
        </div>

      <pre contenteditable="false" spellcheck="false" autocapitalize="off" autocomplete="off" autocorrect="off" data-gramm="false" class="prism-editor__code  language-text">
        <code class=" language-text">
          content-type: application/json
        </code>
      </pre>
    </div>
    <br />

      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#request_rest">Request Parameter</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#response_rest">Response Parameter</a>
        </li>
      </ul>

      <div class="tab-content">
        <div id="request_rest" class="container tab-pane active">
          <table class="table">
            <thead class="breadcrumb_bg">
              <tr>
                <th scope="col">KEY</th>
                <th scope="col">TYPE</th>
                <!-- <th scope="col">M/O</th> -->
                <th scope="col">คำอธิบาย</th>
                <th scope="col">ตัวอย่าง</th>
              </tr>
            </thead>
          </table>
          <div class="table-responsive" <?php echo $scrollbar_req;?>>
            <table class="table">
              <!-- <thead class="breadcrumb_bg">
                <tr>
                  <th scope="col">KEY</th>
                  <th scope="col">TYPE</th> -->
                  <!-- <th scope="col">M/O</th> -->
                  <!-- <th scope="col">คำอธิบาย</th>
                  <th scope="col">ตัวอย่าง</th>
                </tr>
              </thead> -->
              <tbody>
                <?php
                $i = 1;
                $req_key = array();
                $req_ex = array();
                while ($rec_data = db::fetch_array($sql_request)) {
                  if(sizeof($req_key) == 0){
                    $req_key[$i] = $rec_data['REQUEST_NAME'];
                    $req_ex[$i] = $rec_data['REQUEST_EX'];
                    echo "<tr>
                    <td style=\"width:20%\">".$rec_data['REQUEST_NAME']."</td>
                    <td style=\"width:20%\">".$rec_data['REQUEST_TYPE']."</td>
                    <td style=\"width:25%\">".$rec_data['REQUEST_DESC']."</td>
                    <td>".$rec_data['REQUEST_EX']."</td>
                    </tr>";
                    $i++;
                  }else{
                    foreach ($req_key as $key => $value) {
                      if(empty(array_search($rec_data['REQUEST_NAME'],$req_key))){
                        echo "<tr>
                        <td style=\"width:20%\">".$rec_data['REQUEST_NAME']."</td>
                        <td style=\"width:20%\">".$rec_data['REQUEST_TYPE']."</td>
                        <td style=\"width:25%\">".$rec_data['REQUEST_DESC']."</td>
                        <td>".$rec_data['REQUEST_EX']."</td>
                        </tr>";
                        $req_key[$i] = $rec_data['REQUEST_NAME'];
                        $req_ex[$i] = $rec_data['REQUEST_EX'];
                        $i++;
                      }
                    }
                  }
                }?>
              </tbody>
            </table>
          </div>
        </div>

        <div id="response_rest" class="container tab-pane fade">
          <table class="table">
            <thead class="breadcrumb_bg">
              <tr>
                <th scope="col">KEY</th>
                <th scope="col">TYPE</th>
                <!-- <th scope="col">M/O</th> -->
                <th scope="col">คำอธิบาย</th>
                <th scope="col">ตัวอย่าง</th>
              </tr>
            </thead>
          </table>
          <div class="table-responsive" <?php echo $scrollbar_res;?>>
            <table class="table">
              <!-- <thead class="breadcrumb_bg">
                <tr>
                  <th scope="col">KEY</th>
                  <th scope="col">TYPE</th>
                  <th scope="col">M/O</th>
                  <th scope="col">คำอธิบาย</th>
                  <th scope="col">ตัวอย่าง</th>
                </tr>
              </thead> -->
              <tbody>
                <?php
                $j = 1;
                $res_key = array();
                $res_ex = array();
                while ($rec_data = db::fetch_array($sql_response)) {
                  if(sizeof($res_key) == 0){
                    echo "<tr>
                    <td style=\"width:20%\">".$rec_data['RESPONSE_NAME']."</td>
                    <td style=\"width:20%\">".$rec_data['RESPONSE_TYPE']."</td>
                    <td style=\"width:25%\">".$rec_data['RESPONSE_DESC']."</td>
                    <td>".$rec_data['RESPONSE_EX']."</td>
                    </tr>";
                    $res_key[$j] = $rec_data['RESPONSE_NAME'];
                    $res_ex[$j] = $rec_data['RESPONSE_EX'];
                    $j++;
                  }else{
                    foreach ($res_key as $key => $value) {
                      if(empty(array_search($rec_data['RESPONSE_NAME'],$res_key))){
                        echo "<tr>
                        <td style=\"width:20%\">".$rec_data['RESPONSE_NAME']."</td>
                        <td style=\"width:20%\">".$rec_data['RESPONSE_TYPE']."</td>
                        <td style=\"width:25%\">".$rec_data['RESPONSE_DESC']."</td>
                        <td>".$rec_data['RESPONSE_EX']."</td>
                        </tr>";
                        $res_key[$j] = $rec_data['RESPONSE_NAME'];
                        $res_ex[$j] = $rec_data['RESPONSE_EX'];
                        $j++;
                      }
                    }
                  }
                }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

        <br />
        <h5>Body Request</h5>

        <div class="mt-3 ">
          <div data-v-c38ff134="" class="prism-editor-wrapper my-editor">
            <div aria-hidden="true" class="prism-editor__line-numbers"></div>
          </div>

        <pre contenteditable="false" spellcheck="false" autocapitalize="off" autocomplete="off" autocorrect="off" data-gramm="false" class="prism-editor__code  language-text">
          <code class=" language-text">
            {
              <?php
              foreach ($req_key as $key => $value) {
                if($key == 1){
                  echo "<label>\"$value\" : \"$req_ex[$key]\"</label><br />";
                }else{
                  echo "<label>             ,\"$value\" : \"$req_ex[$key]\"</label><br />";
                }
              }
              ?>
            }
          </code>
        </pre>
      </div>
      <br />

      <h5>Body Response</h5>
      <div class="mt-3 ">
        <div data-v-c38ff134="" class="prism-editor-wrapper my-editor">
          <div aria-hidden="true" class="prism-editor__line-numbers"></div>
        </div>

      <pre contenteditable="false" spellcheck="false" autocapitalize="off" autocomplete="off" autocorrect="off" data-gramm="false" class="prism-editor__code  language-text">
        <code class=" language-text">
            {
              <?php
              foreach ($res_key as $key => $value) {
                if($key == 1){
                  echo "<label>\"$value\" : \"$res_ex[$key]\"</label><br />";
                }else{
                  echo "<label>             ,\"$value\" : \"$res_ex[$key]\"</label><br />";
                }
              }
              ?>
            }
        </code>
      </pre>
    </div>

    </div>

  </div>


                </div>
            </div>
    	</div>
    </section>

    <!-- footer part start-->
<?php include 'footer-1.php';?>
