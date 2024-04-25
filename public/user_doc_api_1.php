<?php include 'comtop.php';
include 'include/comtop_user.php';
session_start();
?>
<!--::header part start::-->
<?php include 'header.php';
$service_id = $_GET['SERVICE_ID'];
$setting_id = $_GET['SETTING_ID'];

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
        <?php include 'left_menu.php';
        $filters = str_replace("SERVICE_MANAGE_ID", "a.SERVICE_MANAGE_ID", $filter);
        $filters2 = str_replace("SERVICE_MANAGE_ID", "a.SERVICE_MANAGE_ID", $filter2);

        // Service Name
        $sql_main = "SELECT a.SERVICE_NAME, a.SERVICE_CODE, a.SERVICE_DESC, b.SERVICE_LIST FROM M_SERVICE_MANAGE a INNER JOIN M_API_SETTING b ON a.SERVICE_MANAGE_ID = b.SERVICE_ID WHERE a.SERVICE_MANAGE_ID = '$service_id' AND b.API_SETTING_ID = '$setting_id' {$filters} {$filters2}";
        $qry_main = db::query($sql_main);
        $name = db::fetch_array($qry_main);


        $sqlRequest = "SELECT C.API_LIST_ID, C.KEY, C.TYPE, C.STATUS, C.API_DESC, C.API_SAMPLE, A.SERVICE_MANAGE_ID, A.SERVICE_NAME, A.SERVICE_CODE, a.SERVICE_DESC  FROM M_SERVICE_MANAGE A INNER JOIN M_API_SETTING B ON A.SERVICE_MANAGE_ID = B.SERVICE_ID INNER JOIN M_API_LIST C ON b.API_SETTING_ID = c.API_SETTING_ID  WHERE C.API_STATUS = 0  AND a.SERVICE_MANAGE_ID = '$service_id' AND b.API_SETTING_ID = '$setting_id' {$filters} {$filters2} ORDER BY C.API_LIST_ID ASC";

        $sqlResponse = "SELECT C.API_LIST_ID, C.KEY, C.TYPE, C.STATUS, C.API_DESC, C.API_SAMPLE, A.SERVICE_MANAGE_ID, A.SERVICE_NAME, A.SERVICE_CODE, a.SERVICE_DESC  FROM M_SERVICE_MANAGE A INNER JOIN M_API_SETTING B ON A.SERVICE_MANAGE_ID = B.SERVICE_ID INNER JOIN M_API_LIST C ON b.API_SETTING_ID = c.API_SETTING_ID  WHERE C.API_STATUS = 1  AND a.SERVICE_MANAGE_ID = '$service_id' AND b.API_SETTING_ID = '$setting_id' {$filters} {$filters2} ORDER BY C.API_LIST_ID ASC";

        ?>

      </div>
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6"></div>
          <div class="col-md-6"><?php include 'api_service_list_menu.php'; ?></div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <h4>Service Name : <?php echo $name['SERVICE_NAME'] . " (" . $name['SERVICE_CODE'] . " : " . $name['SERVICE_DESC'] . ")"; ?></h4>
          </div>
          <div class="col-md-1"></div>
        </div>
        <div class="row">
          <div class="col-md-11">
            <h5>ชุดข้อมูล : <?php echo $name['SERVICE_LIST']; ?></h5>
          </div>
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
                    <th scope="col">คำอธิบาย</th>
                    <th scope="col">ตัวอย่าง</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $qryRequest = db::query($sqlRequest);
                  while ($rec_data = db::fetch_array($qryRequest)) {
                  ?>
                    <tr>
                      <td><?php echo $rec_data['KEY']; ?></td>
                      <td><?php echo $rec_data['TYPE']; ?></td>
                      <td><?php echo $rec_data['API_DESC']; ?></td>
                      <td><?php echo $rec_data['API_SAMPLE']; ?></td>
                    </tr>
                  <?php
                  } ?>
                </tbody>
              </table>
            </div>
            <h5>Body</h5>
            <div class="mt-3 ">
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
              <code class=" language-text"><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Endpoint:  http://103.208.27.224:81/led_service_api/api/public/<?php echo $name['SERVICE_NAME']; ?><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Method  : &nbsp;POST
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
                content-type: application/json<br />
                TOKENAPI: Token ของผู้ใช้งาน Service<br/>
                SETOPTION: <?php echo $setting_id; ?>
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
                      <th scope="col">M/O</th>
                      <th scope="col">คำอธิบาย</th>
                      <th scope="col">ตัวอย่าง</th>
                    </tr>
                  </thead>
                </table>
                <div class="table-responsive" <?php echo $scrollbar_req; ?>>
                  <table class="table">
                    <tbody>
                      <?php
                      $qryRequest = db::query($sqlRequest);
                      $i = 1;
                      while ($rec_data = db::fetch_array($qryRequest)) {
                        $req_key[$i] = $rec_data['KEY'];
                        $req_ex[$i] = $rec_data['API_SAMPLE'];
                      ?>
                        <tr>
                          <td style="width:20%"><?php echo $rec_data['KEY']; ?></td>
                          <td style="width:20%"><?php echo $rec_data['TYPE']; ?></td>
                          <td style="width:10%"><?php echo $rec_data['STATUS']; ?></td>
                          <td style="width:25%"><?php echo $rec_data['API_DESC']; ?></td>
                          <td><?php echo $rec_data['API_SAMPLE']; ?></td>
                        </tr>
                      <?php
                        $i++;
                      }
                      ?>
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
                      <th scope="col">คำอธิบาย</th>
                      <th scope="col">ตัวอย่าง</th>
                    </tr>
                  </thead>
                </table>
                <div class="table-responsive" <?php echo $scrollbar_res; ?>>
                  <table class="table">
                    <tbody>
                      <?php
                      $j = 1;
                      $qryResponse = db::query($sqlResponse);
                      while ($rec_data = db::fetch_array($qryResponse)) {
                        $res_key[$j] = $rec_data['KEY'];
                        $res_ex[$j] = $rec_data['API_SAMPLE'];
                      ?>
                        <tr>
                          <td style="width:20%"><?php echo $rec_data['KEY']; ?></td>
                          <td style="width:20%"><?php echo $rec_data['TYPE']; ?></td>
                          <td style="width:25%"><?php echo $rec_data['API_DESC']; ?></td>
                          <td><?php echo $rec_data['API_SAMPLE']; ?></td>
                        </tr>
                      <?php
                        $j++;
                      }
                      ?>
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
                if ($key == 1) {
                  echo "<label>\"$value\" : \"$req_ex[$key]\"</label><br />";
                } else {
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
                if ($key == 1) {
                  echo "<label>\"$value\" : \"$res_ex[$key]\"</label><br />";
                } else {
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
<style type="text/css">
  .modal {
    position: fixed;
    top: 40px;
    bottom: 40px;
    left: 0;
    right: 0;
    z-index: 1050;
    max-width: 800px;
    height: min-content;
    box-sizing: border-box;
    width: 90%;
    background: #fff;
    padding: 0px 10px;
    margin-left: auto;
    margin-right: auto;
  }

  .modal .modal-body {
    overflow-y: auto;
  }
</style>
<!-- Modal -->
<div class="modal fade" id="modalPer" tabindex="-1" role="dialog" aria-labelledby="modalPerTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h5 class="modal-title" id="modalPerTitle">แจ้งเตือน</h5>
      </div>
      <form id="form_user_sub" action="api_service_list.php" method="POST" role="form" enctype="multipart/form-data">
        <div class="modal-body text-center">
          <h3 class="modal-body">ไม่มีสิทธิ์ใช้งาน API นี้</h3>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-primary">OK</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- footer part start-->
<?php include 'footer-1.php'; ?>