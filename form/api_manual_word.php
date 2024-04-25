<?php
$HIDE_HEADER = 'Y';  
include "../include/comtop_user.php";
$API_SETTING_ID = $_GET['SETTING_ID'];
$SERVICE_ID = $_GET['SERVICE_ID'];

$sql = "SELECT * FROM M_SERVICE_MANAGE
WHERE 1 = 1 AND SERVICE_MANAGE_ID = '" . $SERVICE_ID . "'";
$qry = db::query($sql);
$i = 0;
$rec = db::fetch_array($qry);


header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");
header("Content-Disposition: attachment;filename=" . $rec['SERVICE_NAME'] . ".doc");
header("Content-Transfer-Encoding: binary");
?>
<html xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:w="urn:schemas-microsoft-com:office:word"
xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=ProgId content=Word.Document>
<meta name=Generator content="Microsoft Word 15">
<meta name=Originator content="Microsoft Word 15">
<link rel=File-List href="<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/filelist.xml">
<!--[if gte mso 9]><xml>
 <o:DocumentProperties>
  <o:Author>Bizpotential Company</o:Author>
  <o:LastAuthor>Office18 bizpotential</o:LastAuthor>
  <o:Revision>2</o:Revision>
  <o:TotalTime>1</o:TotalTime>
  <o:LastPrinted>2023-11-06T14:57:00Z</o:LastPrinted>
  <o:Created>2023-12-07T11:06:00Z</o:Created>
  <o:LastSaved>2023-12-07T11:06:00Z</o:LastSaved>
  <o:Pages>3</o:Pages>
  <o:Words>47</o:Words>
  <o:Characters>270</o:Characters>
  <o:Lines>2</o:Lines>
  <o:Paragraphs>1</o:Paragraphs>
  <o:CharactersWithSpaces>316</o:CharactersWithSpaces>
  <o:Version>16.00</o:Version>
 </o:DocumentProperties>
 <o:OfficeDocumentSettings>
  <o:RelyOnVML/>
  <o:AllowPNG/>
 </o:OfficeDocumentSettings>
</xml><![endif]-->
<link rel=dataStoreItem href="<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/item0001.xml"
target="<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/props002.xml">
<link rel=themeData href="<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/themedata.thmx">
<link rel=colorSchemeMapping href="<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/colorschememapping.xml">
<!--[if gte mso 9]><xml>
 <w:WordDocument>
  <w:SpellingState>Clean</w:SpellingState>
  <w:GrammarState>Clean</w:GrammarState>
  <w:TrackMoves>false</w:TrackMoves>
  <w:TrackFormatting/>
  <w:PunctuationKerning/>
  <w:ValidateAgainstSchemas/>
  <w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid>
  <w:IgnoreMixedContent>false</w:IgnoreMixedContent>
  <w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText>
  <w:DoNotPromoteQF/>
  <w:LidThemeOther>EN-US</w:LidThemeOther>
  <w:LidThemeAsian>ZH-CN</w:LidThemeAsian>
  <w:LidThemeComplexScript>TH</w:LidThemeComplexScript>
  <w:Compatibility>
   <w:BreakWrappedTables/>
   <w:SnapToGridInCell/>
   <w:ApplyBreakingRules/>
   <w:WrapTextWithPunct/>
   <w:UseAsianBreakRules/>
   <w:DontGrowAutofit/>
   <w:SplitPgBreakAndParaMark/>
   <w:EnableOpenTypeKerning/>
   <w:DontFlipMirrorIndents/>
   <w:OverrideTableStyleHps/>
  </w:Compatibility>
  <m:mathPr>
   <m:mathFont m:val="Cambria Math"/>
   <m:brkBin m:val="before"/>
   <m:brkBinSub m:val="&#45;-"/>
   <m:smallFrac m:val="off"/>
   <m:dispDef/>
   <m:lMargin m:val="0"/>
   <m:rMargin m:val="0"/>
   <m:defJc m:val="centerGroup"/>
   <m:wrapIndent m:val="1440"/>
   <m:intLim m:val="subSup"/>
   <m:naryLim m:val="undOvr"/>
  </m:mathPr></w:WordDocument>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <w:LatentStyles DefLockedState="false" DefUnhideWhenUsed="false"
  DefSemiHidden="false" DefQFormat="false" DefPriority="99"
  LatentStyleCount="376">
  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Normal"/>
  <w:LsdException Locked="false" Priority="9" QFormat="true" Name="heading 1"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 2"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 3"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 4"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 5"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 6"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 7"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 8"/>
  <w:LsdException Locked="false" Priority="9" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="heading 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index 9"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="toc 1"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="toc 2"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="toc 3"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 4"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 5"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 6"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 7"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 8"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" Name="toc 9"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Indent"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="footnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation text"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="header"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   QFormat="true" Name="footer"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="index heading"/>
  <w:LsdException Locked="false" Priority="35" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="caption"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of figures"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="envelope return"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="footnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="line number"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="page number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote reference"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="endnote text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="table of authorities"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="macro"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="toa heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Bullet 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Number 5"/>
  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Title"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Closing"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Signature"/>
  <w:LsdException Locked="false" Priority="1" SemiHidden="true"
   UnhideWhenUsed="true" Name="Default Paragraph Font"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="Body Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="List Continue 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Message Header"/>
  <w:LsdException Locked="false" Priority="0" QFormat="true" Name="Subtitle"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Salutation"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Date"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text First Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Note Heading"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text 2"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="Body Text 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Body Text Indent 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Block Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Hyperlink"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="FollowedHyperlink"/>
  <w:LsdException Locked="false" Priority="22" QFormat="true" Name="Strong"/>
  <w:LsdException Locked="false" Priority="20" QFormat="true" Name="Emphasis"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="Document Map"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="Plain Text"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="E-mail Signature"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Top of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Bottom of Form"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal (Web)"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Acronym"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Address"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Cite"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Code"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Definition"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Keyboard"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Preformatted"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Sample"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Typewriter"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="HTML Variable"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Normal Table"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="annotation subject"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="No List"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Outline List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Simple 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Classic 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Colorful 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Columns 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Grid 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 4"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 5"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 7"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table List 8"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table 3D effects 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Contemporary"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Elegant"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Professional"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Subtle 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 1"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 2"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Table Web 3"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Balloon Text"/>
  <w:LsdException Locked="false" Priority="39" Name="Table Grid"/>
  <w:LsdException Locked="false" Priority="0" SemiHidden="true"
   UnhideWhenUsed="true" Name="Table Theme"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Placeholder Text"/>
  <w:LsdException Locked="false" Priority="1" QFormat="true" Name="No Spacing"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 1"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 1"/>
  <w:LsdException Locked="false" SemiHidden="true" Name="Revision"/>
  <w:LsdException Locked="false" Priority="34" QFormat="true"
   Name="List Paragraph"/>
  <w:LsdException Locked="false" Priority="29" QFormat="true" Name="Quote"/>
  <w:LsdException Locked="false" Priority="30" QFormat="true"
   Name="Intense Quote"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 1"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 1"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 1"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 1"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 1"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 2"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 2"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 2"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 2"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 2"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 2"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 3"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 3"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 3"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 3"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 3"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 3"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 4"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 4"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 4"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 4"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 4"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 4"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 5"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 5"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 5"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 5"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 5"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 5"/>
  <w:LsdException Locked="false" Priority="60" Name="Light Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="61" Name="Light List Accent 6"/>
  <w:LsdException Locked="false" Priority="62" Name="Light Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="63" Name="Medium Shading 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="64" Name="Medium Shading 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="65" Name="Medium List 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="66" Name="Medium List 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="67" Name="Medium Grid 1 Accent 6"/>
  <w:LsdException Locked="false" Priority="68" Name="Medium Grid 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="69" Name="Medium Grid 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="70" Name="Dark List Accent 6"/>
  <w:LsdException Locked="false" Priority="71" Name="Colorful Shading Accent 6"/>
  <w:LsdException Locked="false" Priority="72" Name="Colorful List Accent 6"/>
  <w:LsdException Locked="false" Priority="73" Name="Colorful Grid Accent 6"/>
  <w:LsdException Locked="false" Priority="19" QFormat="true"
   Name="Subtle Emphasis"/>
  <w:LsdException Locked="false" Priority="21" QFormat="true"
   Name="Intense Emphasis"/>
  <w:LsdException Locked="false" Priority="31" QFormat="true"
   Name="Subtle Reference"/>
  <w:LsdException Locked="false" Priority="32" QFormat="true"
   Name="Intense Reference"/>
  <w:LsdException Locked="false" Priority="33" QFormat="true" Name="Book Title"/>
  <w:LsdException Locked="false" Priority="37" SemiHidden="true"
   UnhideWhenUsed="true" Name="Bibliography"/>
  <w:LsdException Locked="false" Priority="39" SemiHidden="true"
   UnhideWhenUsed="true" QFormat="true" Name="TOC Heading"/>
  <w:LsdException Locked="false" Priority="41" Name="Plain Table 1"/>
  <w:LsdException Locked="false" Priority="42" Name="Plain Table 2"/>
  <w:LsdException Locked="false" Priority="43" Name="Plain Table 3"/>
  <w:LsdException Locked="false" Priority="44" Name="Plain Table 4"/>
  <w:LsdException Locked="false" Priority="45" Name="Plain Table 5"/>
  <w:LsdException Locked="false" Priority="40" Name="Grid Table Light"/>
  <w:LsdException Locked="false" Priority="46" Name="Grid Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="Grid Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="Grid Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="Grid Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="Grid Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="Grid Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="Grid Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="Grid Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="Grid Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="Grid Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="46" Name="List Table 1 Light"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark"/>
  <w:LsdException Locked="false" Priority="51" Name="List Table 6 Colorful"/>
  <w:LsdException Locked="false" Priority="52" Name="List Table 7 Colorful"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 1"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 1"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 1"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 1"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 1"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 1"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 2"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 2"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 2"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 2"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 2"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 2"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 3"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 3"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 3"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 3"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 3"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 3"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 4"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 4"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 4"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 4"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 4"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 4"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 5"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 5"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 5"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 5"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 5"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 5"/>
  <w:LsdException Locked="false" Priority="46"
   Name="List Table 1 Light Accent 6"/>
  <w:LsdException Locked="false" Priority="47" Name="List Table 2 Accent 6"/>
  <w:LsdException Locked="false" Priority="48" Name="List Table 3 Accent 6"/>
  <w:LsdException Locked="false" Priority="49" Name="List Table 4 Accent 6"/>
  <w:LsdException Locked="false" Priority="50" Name="List Table 5 Dark Accent 6"/>
  <w:LsdException Locked="false" Priority="51"
   Name="List Table 6 Colorful Accent 6"/>
  <w:LsdException Locked="false" Priority="52"
   Name="List Table 7 Colorful Accent 6"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Mention"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Smart Hyperlink"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Hashtag"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Unresolved Mention"/>
  <w:LsdException Locked="false" SemiHidden="true" UnhideWhenUsed="true"
   Name="Smart Link"/>
 </w:LatentStyles>
</xml><![endif]-->
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:Wingdings;
	panose-1:5 0 0 0 0 0 0 0 0 0;
	mso-font-charset:2;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:0 268435456 0 0 -2147483648 0;}
@font-face
	{font-family:SimSun;
	panose-1:2 1 6 0 3 1 1 1 1 1;
	mso-font-alt:宋体;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:515 680460288 22 0 262145 0;}
@font-face
	{font-family:"Angsana New";
	panose-1:2 2 6 3 5 4 5 2 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"Cordia New";
	panose-1:2 11 3 4 2 2 2 2 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-536869121 1107305727 33554432 0 415 0;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-469750017 -1073732485 9 0 511 0;}
@font-face
	{font-family:"Calibri Light";
	panose-1:2 15 3 2 2 2 4 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-469750017 -1073732485 9 0 511 0;}
@font-face
	{font-family:Verdana;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-1610610945 1073750107 16 0 415 0;}
@font-face
	{font-family:"Arial Unicode MS";
	panose-1:2 11 6 4 2 2 2 2 2 4;
	mso-font-charset:128;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-134238209 -371195905 63 0 4129279 0;}
@font-face
	{font-family:Cambria;
	panose-1:2 4 5 3 5 4 6 3 2 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-536869121 1107305727 33554432 0 415 0;}
@font-face
	{font-family:"TH SarabunPSK";
	panose-1:2 11 5 0 4 2 0 2 0 3;
	mso-font-charset:222;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-1593835409 1342185562 0 0 65939 0;}
@font-face
	{font-family:"TH Sarabun New";
	panose-1:2 11 5 0 4 2 0 2 0 3;
	mso-font-alt:"Browallia New";
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-1593835409 1342185562 0 0 65923 0;}
@font-face
	{font-family:Tahoma;
	panose-1:2 11 6 4 3 5 4 4 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-520081665 -1073717157 41 0 66047 0;}
@font-face
	{font-family:"Segoe UI";
	panose-1:2 11 5 2 4 2 4 2 2 3;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-469750017 -1073683329 9 0 511 0;}
@font-face
	{font-family:EucrosiaUPC;
	panose-1:2 2 6 3 5 4 5 2 3 4;
	mso-font-charset:0;
	mso-generic-font-family:roman;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:FreesiaUPC;
	panose-1:2 11 6 4 2 2 2 2 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"Browallia New";
	panose-1:2 11 6 4 2 2 2 2 2 4;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:Leelawadee;
	panose-1:2 11 5 2 4 2 4 2 2 3;
	mso-font-charset:0;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-2130706429 0 0 0 65537 0;}
@font-face
	{font-family:"\@SimSun";
	panose-1:2 1 6 0 3 1 1 1 1 1;
	mso-font-charset:134;
	mso-generic-font-family:auto;
	mso-font-pitch:variable;
	mso-font-signature:515 680460288 22 0 262145 0;}
@font-face
	{font-family:"\@Arial Unicode MS";
	panose-1:2 11 6 4 2 2 2 2 2 4;
	mso-font-charset:128;
	mso-generic-font-family:swiss;
	mso-font-pitch:variable;
	mso-font-signature:-134238209 -371195905 63 0 4129279 0;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:107%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
h1
	{mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Heading 1 Char";
	mso-style-next:Normal;
	margin-top:6.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:.3in;
	text-indent:-.3in;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:1;
	mso-list:l0 level1 lfo5;
	tab-stops:40.5pt;
	font-size:18.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	mso-font-kerning:0pt;
	font-weight:bold;}
h2
	{mso-style-name:"Heading 2\,Sub-section\,Reset numbering\,Heading 2 Managment";
	mso-style-update:auto;
	mso-style-qformat:yes;
	mso-style-link:"Heading 2 Char\,Sub-section Char\,Reset numbering Char\,Heading 2 Managment Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.4in;
	mso-add-space:auto;
	text-indent:-.4in;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:2;
	mso-list:l0 level2 lfo5;
	tab-stops:22.5pt 45.0pt 544.5pt;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h2.CxSpFirst
	{mso-style-name:"Heading 2\,Sub-section\,Reset numbering\,Heading 2 ManagmentCxSpFirst";
	mso-style-update:auto;
	mso-style-qformat:yes;
	mso-style-link:"Heading 2 Char\,Sub-section Char\,Reset numbering Char\,Heading 2 Managment Char";
	mso-style-next:Normal;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.4in;
	mso-add-space:auto;
	text-indent:-.4in;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:2;
	mso-list:l0 level2 lfo5;
	tab-stops:22.5pt 45.0pt 544.5pt;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h2.CxSpMiddle
	{mso-style-name:"Heading 2\,Sub-section\,Reset numbering\,Heading 2 ManagmentCxSpMiddle";
	mso-style-update:auto;
	mso-style-qformat:yes;
	mso-style-link:"Heading 2 Char\,Sub-section Char\,Reset numbering Char\,Heading 2 Managment Char";
	mso-style-next:Normal;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.4in;
	mso-add-space:auto;
	text-indent:-.4in;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:2;
	mso-list:l0 level2 lfo5;
	tab-stops:22.5pt 45.0pt 544.5pt;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h2.CxSpLast
	{mso-style-name:"Heading 2\,Sub-section\,Reset numbering\,Heading 2 ManagmentCxSpLast";
	mso-style-update:auto;
	mso-style-qformat:yes;
	mso-style-link:"Heading 2 Char\,Sub-section Char\,Reset numbering Char\,Heading 2 Managment Char";
	mso-style-next:Normal;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.4in;
	mso-add-space:auto;
	text-indent:-.4in;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:2;
	mso-list:l0 level2 lfo5;
	tab-stops:22.5pt 45.0pt 544.5pt;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	font-weight:normal;
	mso-bidi-font-weight:bold;}
h3
	{mso-style-name:"Heading 3\,Level 1 - 1";
	mso-style-priority:9;
	mso-style-qformat:yes;
	mso-style-link:"Heading 3 Char\,Level 1 - 1 Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	text-indent:-.5in;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:3;
	mso-list:l0 level3 lfo5;
	tab-stops:58.5pt 63.0pt;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	color:#243F60;
	mso-themecolor:accent1;
	mso-themeshade:127;
	font-weight:normal;}
h4
	{mso-style-name:"Heading 4\,Level 2 - a";
	mso-style-qformat:yes;
	mso-style-link:"Heading 4 Char\,Level 2 - a Char";
	mso-style-next:Normal;
	margin-top:2.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:192.1pt;
	text-indent:-.6in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:4;
	mso-list:l0 level4 lfo5;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#365F91;
	mso-themecolor:accent1;
	mso-themeshade:191;
	font-weight:normal;
	font-style:italic;}
h5
	{mso-style-name:"Heading 5\,Level 3 - i";
	mso-style-qformat:yes;
	mso-style-link:"Heading 5 Char\,Level 3 - i Char";
	mso-style-next:Normal;
	margin-top:2.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:0in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:5;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#365F91;
	mso-themecolor:accent1;
	mso-themeshade:191;
	font-weight:normal;}
h6
	{mso-style-name:"Heading 6\,Legal Level 1\.\,Bullet list";
	mso-style-qformat:yes;
	mso-style-link:"Heading 6 Char\,Legal Level 1\. Char\,Bullet list Char";
	mso-style-next:Normal;
	margin-top:2.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.8in;
	text-indent:-.8in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:6;
	mso-list:l0 level6 lfo5;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#243F60;
	mso-themecolor:accent1;
	mso-themeshade:127;
	font-weight:normal;}
p.MsoHeading7, li.MsoHeading7, div.MsoHeading7
	{mso-style-qformat:yes;
	mso-style-link:"Heading 7 Char";
	mso-style-next:Normal;
	margin-top:2.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.9in;
	text-indent:-.9in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:7;
	mso-list:l0 level7 lfo5;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#243F60;
	mso-themecolor:accent1;
	mso-themeshade:127;
	font-style:italic;}
p.MsoHeading8, li.MsoHeading8, div.MsoHeading8
	{mso-style-priority:9;
	mso-style-qformat:yes;
	mso-style-link:"Heading 8 Char";
	mso-style-next:Normal;
	margin-top:2.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:1.0in;
	text-indent:-1.0in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:8;
	mso-list:l0 level8 lfo5;
	font-size:10.5pt;
	mso-bidi-font-size:13.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#272727;
	mso-themecolor:text1;
	mso-themetint:216;}
p.MsoHeading9, li.MsoHeading9, div.MsoHeading9
	{mso-style-priority:9;
	mso-style-qformat:yes;
	mso-style-link:"Heading 9 Char";
	mso-style-next:Normal;
	margin-top:2.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:1.1in;
	text-indent:-1.1in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:9;
	mso-list:l0 level9 lfo5;
	font-size:10.5pt;
	mso-bidi-font-size:13.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#272727;
	mso-themecolor:text1;
	mso-themetint:216;
	font-style:italic;}
p.MsoToc1, li.MsoToc1, div.MsoToc1
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-qformat:yes;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:42.55pt;
	text-indent:-42.55pt;
	mso-pagination:none;
	tab-stops:44.0pt right dotted 450.8pt;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:Calibri;
	text-transform:uppercase;
	mso-bidi-language:AR-SA;
	mso-no-proof:yes;}
p.MsoToc2, li.MsoToc2, div.MsoToc2
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-qformat:yes;
	mso-style-next:Normal;
	margin:0in;
	text-indent:40.5pt;
	mso-pagination:none;
	tab-stops:44.0pt 66.0pt right dotted 450.8pt;
	font-size:10.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	font-variant:small-caps;
	mso-bidi-language:AR-SA;}
p.MsoToc3, li.MsoToc3, div.MsoToc3
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-qformat:yes;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:22.0pt;
	line-height:115%;
	mso-pagination:none;
	font-size:10.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;
	font-style:italic;}
p.MsoToc4, li.MsoToc4, div.MsoToc4
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:33.0pt;
	line-height:115%;
	mso-pagination:none;
	font-size:9.0pt;
	mso-bidi-font-size:10.5pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;}
p.MsoToc5, li.MsoToc5, div.MsoToc5
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:44.0pt;
	line-height:115%;
	mso-pagination:none;
	font-size:9.0pt;
	mso-bidi-font-size:10.5pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;}
p.MsoToc6, li.MsoToc6, div.MsoToc6
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:55.0pt;
	line-height:115%;
	mso-pagination:none;
	font-size:9.0pt;
	mso-bidi-font-size:10.5pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;}
p.MsoToc7, li.MsoToc7, div.MsoToc7
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:66.0pt;
	line-height:115%;
	mso-pagination:none;
	font-size:9.0pt;
	mso-bidi-font-size:10.5pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;}
p.MsoToc8, li.MsoToc8, div.MsoToc8
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:77.0pt;
	line-height:115%;
	mso-pagination:none;
	font-size:9.0pt;
	mso-bidi-font-size:10.5pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;}
p.MsoToc9, li.MsoToc9, div.MsoToc9
	{mso-style-update:auto;
	mso-style-priority:39;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:88.0pt;
	line-height:115%;
	mso-pagination:none;
	font-size:9.0pt;
	mso-bidi-font-size:10.5pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;}
p.MsoFootnoteText, li.MsoFootnoteText, div.MsoFootnoteText
	{mso-style-update:auto;
	mso-style-unhide:no;
	mso-style-link:"Footnote Text Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Angsana New";
	mso-bidi-font-family:"Browallia New";
	mso-ansi-language:EN-NZ;
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;}
p.MsoCommentText, li.MsoCommentText, div.MsoCommentText
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Comment Text Char";
	margin:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Arial Unicode MS";
	border:none;
	mso-bidi-language:AR-SA;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{mso-style-link:"Header Char";
	margin:0in;
	mso-pagination:widow-orphan;
	tab-stops:center 225.65pt right 451.3pt;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{mso-style-priority:99;
	mso-style-qformat:yes;
	mso-style-link:"Footer Char";
	margin:0in;
	mso-pagination:widow-orphan;
	tab-stops:center 225.65pt right 451.3pt;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
p.MsoCaption, li.MsoCaption, div.MsoCaption
	{mso-style-name:"Caption\,Caption0\,Caption Char\,capion";
	mso-style-priority:35;
	mso-style-qformat:yes;
	mso-style-link:"Caption Char1\,Caption0 Char\,Caption Char Char\,capion Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0in;
	line-height:115%;
	mso-pagination:none;
	font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-language:AR-SA;
	font-weight:bold;}
p.MsoTof, li.MsoTof, div.MsoTof
	{mso-style-priority:99;
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:22.0pt;
	text-indent:-22.0pt;
	line-height:107%;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	mso-bidi-font-size:11.5pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	font-variant:small-caps;}
span.MsoFootnoteReference
	{mso-style-unhide:no;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	vertical-align:super;}
span.MsoCommentReference
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;}
span.MsoEndnoteReference
	{mso-style-noshow:yes;
	mso-style-priority:99;
	vertical-align:super;}
p.MsoEndnoteText, li.MsoEndnoteText, div.MsoEndnoteText
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"Endnote Text Char";
	margin:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"Angsana New";}
p.MsoMacroText, li.MsoMacroText, div.MsoMacroText
	{mso-style-unhide:no;
	mso-style-parent:"";
	mso-style-link:"Macro Text Char";
	margin:0in;
	mso-pagination:widow-orphan;
	tab-stops:24.0pt 48.0pt 1.0in 96.0pt 120.0pt 2.0in 168.0pt 192.0pt 3.0in;
	font-size:14.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:EucrosiaUPC;}
p.MsoToaHeading, li.MsoToaHeading, div.MsoToaHeading
	{mso-style-unhide:no;
	mso-style-next:Normal;
	margin-top:6.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Angsana New";
	mso-bidi-font-family:"Browallia New";
	mso-ansi-language:EN-NZ;
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;
	font-weight:bold;}
p.MsoTitle, li.MsoTitle, div.MsoTitle
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Title Char";
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:0in;
	text-align:center;
	mso-pagination:widow-orphan;
	mso-outline-level:1;
	font-size:24.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Angsana New";
	mso-bidi-font-family:"Browallia New";
	mso-font-kerning:14.0pt;
	mso-ansi-language:EN-NZ;
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;
	font-weight:bold;}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{mso-style-name:"Body Text\,BT";
	mso-style-unhide:no;
	mso-style-link:"Body Text Char\,BT Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Arial;
	mso-bidi-language:HE;}
p.MsoSubtitle, li.MsoSubtitle, div.MsoSubtitle
	{mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Subtitle Char";
	mso-style-next:Normal;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:0in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	mso-bidi-font-size:15.0pt;
	font-family:"Cambria",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:#4F81BD;
	letter-spacing:.75pt;
	font-style:italic;}
p.MsoBodyText3, li.MsoBodyText3, div.MsoBodyText3
	{mso-style-link:"Body Text 3 Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"Angsana New";}
a:link, span.MsoHyperlink
	{mso-style-priority:99;
	mso-style-parent:"";
	color:blue;
	text-decoration:underline;
	text-underline:single;}
a:visited, span.MsoHyperlinkFollowed
	{mso-style-priority:99;
	color:purple;
	mso-themecolor:followedhyperlink;
	text-decoration:underline;
	text-underline:single;}
p.MsoDocumentMap, li.MsoDocumentMap, div.MsoDocumentMap
	{mso-style-unhide:no;
	mso-style-link:"Document Map Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	mso-pagination:widow-orphan;
	background:navy;
	font-size:12.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Angsana New";
	mso-bidi-font-family:"Browallia New";
	mso-ansi-language:EN-NZ;
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;}
p.MsoPlainText, li.MsoPlainText, div.MsoPlainText
	{mso-style-unhide:no;
	mso-style-link:"Plain Text Char";
	margin:0in;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	font-family:"Cordia New",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";
	mso-ansi-language:X-NONE;
	mso-fareast-language:X-NONE;}
p
	{mso-style-priority:99;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Times New Roman";}
code
	{mso-style-noshow:yes;
	mso-style-priority:99;
	font-family:"Courier New";
	mso-ascii-font-family:"Courier New";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Courier New";
	mso-bidi-font-family:"Courier New";}
pre
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-link:"HTML Preformatted Char";
	margin:0in;
	mso-pagination:widow-orphan;
	tab-stops:45.8pt 91.6pt 137.4pt 183.2pt 229.0pt 274.8pt 320.6pt 366.4pt 412.2pt 458.0pt 503.8pt 549.6pt 595.4pt 641.2pt 687.0pt 732.8pt;
	font-size:10.0pt;
	font-family:"Courier New";
	mso-fareast-font-family:"Times New Roman";}
p.MsoCommentSubject, li.MsoCommentSubject, div.MsoCommentSubject
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"Comment Text";
	mso-style-link:"Comment Subject Char";
	mso-style-next:"Comment Text";
	margin:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Arial Unicode MS";
	border:none;
	mso-bidi-language:AR-SA;
	font-weight:bold;}
p.MsoAcetate, li.MsoAcetate, div.MsoAcetate
	{mso-style-priority:99;
	mso-style-link:"Balloon Text Char";
	margin:0in;
	mso-pagination:none;
	font-size:8.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-language:AR-SA;}
p.MsoNoSpacing, li.MsoNoSpacing, div.MsoNoSpacing
	{mso-style-name:"No Spacing\,No Spacing1\,NS";
	mso-style-priority:1;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"";
	mso-style-link:"No Spacing Char\,No Spacing1 Char\,NS Char";
	margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;
	mso-fareast-language:JA;
	mso-bidi-language:AR-SA;}
p.MsoRMPane, li.MsoRMPane, div.MsoRMPane
	{mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"";
	margin:0in;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	mso-bidi-font-size:15.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
	{mso-style-name:"List Paragraph\,Number Bullet Paragraph";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"List Paragraph Char\,Number Bullet Paragraph Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-fareast-font-family:"TH Sarabun New";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
	{mso-style-name:"List Paragraph\,Number Bullet ParagraphCxSpFirst";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"List Paragraph Char\,Number Bullet Paragraph Char";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-fareast-font-family:"TH Sarabun New";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
	{mso-style-name:"List Paragraph\,Number Bullet ParagraphCxSpMiddle";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"List Paragraph Char\,Number Bullet Paragraph Char";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-fareast-font-family:"TH Sarabun New";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
	{mso-style-name:"List Paragraph\,Number Bullet ParagraphCxSpLast";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"List Paragraph Char\,Number Bullet Paragraph Char";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:10.0pt;
	margin-left:.5in;
	mso-add-space:auto;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-fareast-font-family:"TH Sarabun New";}
p.MsoTocHeading, li.MsoTocHeading, div.MsoTocHeading
	{mso-style-priority:39;
	mso-style-qformat:yes;
	mso-style-parent:"Heading 1";
	mso-style-next:Normal;
	margin-top:.25in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:.3in;
	text-indent:-.3in;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-list:l0 level1 lfo5;
	font-size:22.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	mso-fareast-language:JA;
	mso-bidi-language:AR-SA;
	font-weight:bold;}
span.Heading1Char
	{mso-style-name:"Heading 1 Char";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 1";
	mso-ansi-font-size:18.0pt;
	mso-bidi-font-size:18.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ascii-font-family:"TH SarabunPSK";
	mso-fareast-font-family:"TH SarabunPSK";
	mso-hansi-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"TH SarabunPSK";
	font-weight:bold;}
span.Heading2Char
	{mso-style-name:"Heading 2 Char\,Sub-section Char\,Reset numbering Char\,Heading 2 Managment Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 2\,Sub-section\,Reset numbering\,Heading 2 Managment";
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ascii-font-family:"TH SarabunPSK";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"TH SarabunPSK";
	mso-bidi-font-weight:bold;}
span.Heading3Char
	{mso-style-name:"Heading 3 Char\,Level 1 - 1 Char";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 3\,Level 1 - 1";
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ascii-font-family:"TH SarabunPSK";
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"TH SarabunPSK";
	color:#243F60;
	mso-themecolor:accent1;
	mso-themeshade:127;}
span.Heading4Char
	{mso-style-name:"Heading 4 Char\,Level 2 - a Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 4\,Level 2 - a";
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#365F91;
	mso-themecolor:accent1;
	mso-themeshade:191;
	font-style:italic;}
span.Heading5Char
	{mso-style-name:"Heading 5 Char\,Level 3 - i Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 5\,Level 3 - i";
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#365F91;
	mso-themecolor:accent1;
	mso-themeshade:191;}
span.Heading6Char
	{mso-style-name:"Heading 6 Char\,Legal Level 1\. Char\,Bullet list Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 6\,Legal Level 1\.\,Bullet list";
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#243F60;
	mso-themecolor:accent1;
	mso-themeshade:127;}
span.Heading7Char
	{mso-style-name:"Heading 7 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 7";
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#243F60;
	mso-themecolor:accent1;
	mso-themeshade:127;
	font-style:italic;}
span.Heading8Char
	{mso-style-name:"Heading 8 Char";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 8";
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:13.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#272727;
	mso-themecolor:text1;
	mso-themetint:216;}
span.Heading9Char
	{mso-style-name:"Heading 9 Char";
	mso-style-priority:9;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Heading 9";
	mso-ansi-font-size:10.5pt;
	mso-bidi-font-size:13.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-ascii-theme-font:major-latin;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	mso-hansi-font-family:Cambria;
	mso-hansi-theme-font:major-latin;
	mso-bidi-font-family:"Angsana New";
	mso-bidi-theme-font:major-bidi;
	color:#272727;
	mso-themecolor:text1;
	mso-themetint:216;
	font-style:italic;}
span.HeaderChar
	{mso-style-name:"Header Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Header;}
span.FooterChar
	{mso-style-name:"Footer Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Footer;}
span.ListParagraphChar
	{mso-style-name:"List Paragraph Char\,Number Bullet Paragraph Char";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:"List Paragraph\,Number Bullet Paragraph";
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-ascii-font-family:"TH Sarabun New";
	mso-fareast-font-family:"TH Sarabun New";
	mso-hansi-font-family:"TH Sarabun New";
	mso-bidi-font-family:"TH Sarabun New";}
span.CaptionChar1
	{mso-style-name:"Caption Char1\,Caption0 Char\,Caption Char Char\,capion Char";
	mso-style-priority:35;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:"Caption\,Caption0\,Caption Char\,capion";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-language:AR-SA;
	font-weight:bold;}
span.BalloonTextChar
	{mso-style-name:"Balloon Text Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Balloon Text";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:8.0pt;
	font-family:"Tahoma",sans-serif;
	mso-ascii-font-family:Tahoma;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:Tahoma;
	mso-bidi-language:AR-SA;}
span.NoSpacingChar
	{mso-style-name:"No Spacing Char\,No Spacing1 Char\,NS Char";
	mso-style-priority:1;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"";
	mso-style-link:"No Spacing\,No Spacing1\,NS";
	mso-bidi-font-size:11.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-language:JA;
	mso-bidi-language:AR-SA;}
span.apple-converted-space
	{mso-style-name:apple-converted-space;
	mso-style-unhide:no;
	mso-style-parent:"";}
span.z-TopofFormChar
	{mso-style-name:"z-Top of Form Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"z-Top of Form";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-ascii-font-family:Arial;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:"Cordia New";
	display:none;
	mso-hide:all;}
span.z-BottomofFormChar
	{mso-style-name:"z-Bottom of Form Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"z-Bottom of Form";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-ascii-font-family:Arial;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:"Cordia New";
	display:none;
	mso-hide:all;}
p.Tableheading, li.Tableheading, div.Tableheading
	{mso-style-name:Tableheading;
	mso-style-unhide:no;
	margin-top:5.0pt;
	margin-right:0in;
	margin-bottom:5.0pt;
	margin-left:0in;
	mso-pagination:none;
	font-size:10.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:black;
	mso-bidi-language:AR-SA;
	layout-grid-mode:line;
	font-weight:bold;}
span.CommentTextChar
	{mso-style-name:"Comment Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Comment Text";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Arial Unicode MS";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	border:none;
	mso-bidi-language:AR-SA;}
span.CommentSubjectChar
	{mso-style-name:"Comment Subject Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"Comment Text Char";
	mso-style-link:"Comment Subject";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Arial Unicode MS";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	border:none;
	mso-bidi-language:AR-SA;
	font-weight:bold;}
span.BalloonTextChar1
	{mso-style-name:"Balloon Text Char1";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-ansi-font-size:9.0pt;
	mso-bidi-font-size:11.0pt;
	font-family:"Segoe UI",sans-serif;
	mso-ascii-font-family:"Segoe UI";
	mso-hansi-font-family:"Segoe UI";
	mso-bidi-font-family:"Angsana New";}
span.z-TopofFormChar1
	{mso-style-name:"z-Top of Form Char1";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-ascii-font-family:Arial;
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:"Cordia New";
	display:none;
	mso-hide:all;}
span.z-BottomofFormChar1
	{mso-style-name:"z-Bottom of Form Char1";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-ascii-font-family:Arial;
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:"Cordia New";
	display:none;
	mso-hide:all;}
p.FigureCaption, li.FigureCaption, div.FigureCaption
	{mso-style-name:"Figure Caption";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin:0in;
	text-align:center;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:EucrosiaUPC;
	font-weight:bold;
	mso-bidi-font-weight:normal;}
p.Bullet1, li.Bullet1, div.Bullet1
	{mso-style-name:Bullet1;
	mso-style-unhide:no;
	margin:0in;
	text-indent:-.25in;
	mso-pagination:widow-orphan;
	mso-list:l41 level1 lfo6;
	tab-stops:list 0in;
	font-size:14.0pt;
	font-family:"Cordia New",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";}
p.MMTopic1, li.MMTopic1, div.MMTopic1
	{mso-style-name:"MM Topic 1";
	mso-style-unhide:no;
	mso-style-parent:"Heading 1";
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.25in;
	text-indent:-.25in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:1;
	mso-list:l62 level2 lfo7;
	font-size:16.0pt;
	mso-bidi-font-size:20.0pt;
	font-family:"Cambria",serif;
	mso-fareast-font-family:Cambria;
	mso-bidi-font-family:"Angsana New";
	color:#365F91;}
p.MMTopic3, li.MMTopic3, div.MMTopic3
	{mso-style-name:"MM Topic 3";
	mso-style-unhide:no;
	mso-style-parent:"Heading 3\,Level 1 - 1";
	margin-top:2.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:0in;
	text-indent:0in;
	line-height:107%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:3;
	mso-list:l62 level3 lfo7;
	font-size:16.0pt;
	mso-bidi-font-size:15.0pt;
	font-family:"Cambria",serif;
	mso-fareast-font-family:Cambria;
	mso-bidi-font-family:"Angsana New";
	color:#243F60;}
span.rStyle
	{mso-style-name:rStyle;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-ascii-font-family:"TH Sarabun New";
	mso-hansi-font-family:"TH Sarabun New";
	mso-bidi-font-family:"TH Sarabun New";}
p.pStyle1, li.pStyle1, div.pStyle1
	{mso-style-name:pStyle1;
	mso-style-unhide:no;
	mso-style-parent:"";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:4.0pt;
	margin-left:0in;
	line-height:107%;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:Arial;}
span.rStyle1
	{mso-style-name:rStyle1;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:18.0pt;
	mso-bidi-font-size:18.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-ascii-font-family:"TH Sarabun New";
	mso-hansi-font-family:"TH Sarabun New";
	mso-bidi-font-family:"TH Sarabun New";
	font-weight:bold;
	mso-bidi-font-weight:normal;}
p.pStyle, li.pStyle, div.pStyle
	{mso-style-name:pStyle;
	mso-style-unhide:no;
	mso-style-parent:"";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:2.5pt;
	margin-left:0in;
	text-align:center;
	line-height:107%;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:Arial;}
p.AxureHeading1, li.AxureHeading1, div.AxureHeading1
	{mso-style-name:AxureHeading1;
	mso-style-unhide:no;
	margin-top:6.0pt;
	margin-right:0in;
	margin-bottom:12.0pt;
	margin-left:0in;
	text-indent:0in;
	mso-pagination:widow-orphan;
	mso-list:l68 level1 lfo8;
	tab-stops:list .25in;
	font-size:14.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	color:#404040;
	mso-themecolor:text1;
	mso-themetint:191;
	mso-bidi-language:AR-SA;
	font-weight:bold;
	mso-bidi-font-weight:normal;}
p.AxureHeading2, li.AxureHeading2, div.AxureHeading2
	{mso-style-name:AxureHeading2;
	mso-style-unhide:no;
	margin-top:6.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	text-indent:0in;
	mso-pagination:widow-orphan;
	mso-list:l68 level2 lfo8;
	tab-stops:list .55in;
	font-size:13.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	color:#404040;
	mso-themecolor:text1;
	mso-themetint:191;
	mso-bidi-language:AR-SA;
	font-weight:bold;
	mso-bidi-font-weight:normal;}
p.AxureHeading3, li.AxureHeading3, div.AxureHeading3
	{mso-style-name:AxureHeading3;
	mso-style-unhide:no;
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	text-indent:0in;
	mso-pagination:widow-orphan;
	mso-list:l68 level3 lfo8;
	tab-stops:list 1.0in;
	font-size:10.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	color:#404040;
	mso-themecolor:text1;
	mso-themetint:191;
	mso-bidi-language:AR-SA;
	font-weight:bold;
	mso-bidi-font-weight:normal;}
p.AxureHeading4, li.AxureHeading4, div.AxureHeading4
	{mso-style-name:AxureHeading4;
	mso-style-unhide:no;
	margin-top:12.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	text-indent:0in;
	mso-pagination:widow-orphan;
	mso-list:l68 level4 lfo8;
	tab-stops:list 1.25in;
	font-size:10.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	color:#404040;
	mso-themecolor:text1;
	mso-themetint:191;
	mso-bidi-language:AR-SA;
	font-weight:bold;
	mso-bidi-font-weight:normal;
	font-style:italic;
	mso-bidi-font-style:normal;}
p.AxureImageParagraph, li.AxureImageParagraph, div.AxureImageParagraph
	{mso-style-name:AxureImageParagraph;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:6.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	text-align:center;
	mso-pagination:widow-orphan;
	font-size:9.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-language:AR-SA;}
span.HTMLPreformattedChar
	{mso-style-name:"HTML Preformatted Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"HTML Preformatted";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Courier New";
	mso-ascii-font-family:"Courier New";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Courier New";
	mso-bidi-font-family:"Courier New";}
p.KBody, li.KBody, div.KBody
	{mso-style-name:"K Body";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"Body Text 3";
	mso-style-link:"K Body Char";
	margin-top:4.0pt;
	margin-right:0in;
	margin-bottom:2.0pt;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:FreesiaUPC;}
span.KBodyChar
	{mso-style-name:"K Body Char";
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"K Body";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"Arial",sans-serif;
	mso-ascii-font-family:Arial;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Arial;
	mso-bidi-font-family:FreesiaUPC;}
span.BodyText3Char
	{mso-style-name:"Body Text 3 Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Body Text 3";
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ascii-font-family:"TH SarabunPSK";
	mso-fareast-font-family:"TH SarabunPSK";
	mso-hansi-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"Angsana New";}
p.NormalParagraph, li.NormalParagraph, div.NormalParagraph
	{mso-style-name:"Normal Paragraph";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-link:"Normal Paragraph Char";
	margin:0in;
	text-align:justify;
	text-justify:inter-cluster;
	text-indent:35.3pt;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";}
span.NormalParagraphChar
	{mso-style-name:"Normal Paragraph Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Normal Paragraph";
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ascii-font-family:"TH SarabunPSK";
	mso-fareast-font-family:"TH SarabunPSK";
	mso-hansi-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"TH SarabunPSK";}
p.TableBullet, li.TableBullet, div.TableBullet
	{mso-style-name:"Table Bullet";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:35.25pt;
	mso-add-space:auto;
	text-indent:-22.3pt;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:EucrosiaUPC;}
p.TableBulletCxSpFirst, li.TableBulletCxSpFirst, div.TableBulletCxSpFirst
	{mso-style-name:"Table BulletCxSpFirst";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:35.25pt;
	mso-add-space:auto;
	text-indent:-22.3pt;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:EucrosiaUPC;}
p.TableBulletCxSpMiddle, li.TableBulletCxSpMiddle, div.TableBulletCxSpMiddle
	{mso-style-name:"Table BulletCxSpMiddle";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:35.25pt;
	mso-add-space:auto;
	text-indent:-22.3pt;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:EucrosiaUPC;}
p.TableBulletCxSpLast, li.TableBulletCxSpLast, div.TableBulletCxSpLast
	{mso-style-name:"Table BulletCxSpLast";
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:35.25pt;
	mso-add-space:auto;
	text-indent:-22.3pt;
	mso-pagination:widow-orphan;
	font-size:14.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:EucrosiaUPC;}
p.MS-BodyText, li.MS-BodyText, div.MS-BodyText
	{mso-style-name:"MS-Body Text";
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Cordia New";}
p.UseCaseNumber, li.UseCaseNumber, div.UseCaseNumber
	{mso-style-name:"Use Case Number";
	mso-style-unhide:no;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	text-indent:-.25in;
	mso-pagination:widow-orphan;
	mso-list:l65 level1 lfo9;
	tab-stops:list .5in;
	font-size:11.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Angsana New";
	mso-bidi-font-family:"Arial Unicode MS";
	mso-bidi-language:AR-SA;
	mso-bidi-font-weight:bold;}
span.DocumentMapChar
	{mso-style-name:"Document Map Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Document Map";
	mso-ansi-font-size:12.0pt;
	font-family:"Tahoma",sans-serif;
	mso-ascii-font-family:Tahoma;
	mso-fareast-font-family:"Angsana New";
	mso-hansi-font-family:Tahoma;
	mso-bidi-font-family:"Browallia New";
	background:navy;
	mso-ansi-language:EN-NZ;
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;}
span.1
	{mso-style-name:"ผังเอกสาร อักขระ1";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Leelawadee",sans-serif;
	mso-ascii-font-family:Leelawadee;
	mso-hansi-font-family:Leelawadee;
	mso-bidi-font-family:"Angsana New";}
span.DocumentMapChar1
	{mso-style-name:"Document Map Char1";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-ansi-font-size:8.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Segoe UI",sans-serif;
	mso-ascii-font-family:"Segoe UI";
	mso-fareast-font-family:"TH SarabunPSK";
	mso-hansi-font-family:"Segoe UI";
	mso-bidi-font-family:"Angsana New";}
p.introbody, li.introbody, div.introbody
	{mso-style-name:"intro body";
	mso-style-unhide:no;
	margin-top:0in;
	margin-right:.3in;
	margin-bottom:3.0pt;
	margin-left:27.35pt;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Browallia New";
	mso-bidi-language:AR-SA;}
span.TitleChar
	{mso-style-name:"Title Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Title;
	mso-ansi-font-size:24.0pt;
	mso-bidi-font-size:24.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Angsana New";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Browallia New";
	mso-font-kerning:14.0pt;
	mso-ansi-language:EN-NZ;
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;
	font-weight:bold;}
span.Charbold
	{mso-style-name:Charbold;
	mso-style-unhide:no;
	mso-bidi-font-size:22.0pt;
	font-family:"Verdana",sans-serif;
	mso-ascii-font-family:Verdana;
	mso-hansi-font-family:Verdana;
	mso-bidi-font-family:Arial;
	mso-ansi-language:EN-US;
	mso-fareast-language:EN-US;
	mso-bidi-language:AR-SA;
	font-weight:bold;
	mso-bidi-font-weight:normal;}
span.SubtitleChar
	{mso-style-name:"Subtitle Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:Subtitle;
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:15.0pt;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Cambria;
	mso-bidi-font-family:"Angsana New";
	color:#4F81BD;
	letter-spacing:.75pt;
	font-style:italic;}
p.Default, li.Default, div.Default
	{mso-style-name:Default;
	mso-style-unhide:no;
	mso-style-parent:"";
	margin:0in;
	mso-pagination:none;
	mso-layout-grid-align:none;
	text-autospace:none;
	font-size:12.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	color:black;}
p.TookDefault1, li.TookDefault1, div.TookDefault1
	{mso-style-name:"Took Default1";
	mso-style-update:auto;
	mso-style-unhide:no;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:12.0pt;
	mso-line-height-rule:exactly;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	mso-bidi-font-size:22.0pt;
	font-family:"Verdana",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Arial;
	mso-bidi-language:AR-SA;}
span.FootnoteTextChar
	{mso-style-name:"Footnote Text Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Footnote Text";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Angsana New";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Browallia New";
	mso-ansi-language:EN-NZ;
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;}
p.FootNOTE, li.FootNOTE, div.FootNOTE
	{mso-style-name:FootNOTE;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:Footer;
	mso-style-link:"FootNOTE Char";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	mso-pagination:widow-orphan;
	tab-stops:center 207.65pt right 415.3pt 503.25pt;
	font-size:9.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Angsana New";
	mso-bidi-font-family:"Browallia New";
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;
	font-style:italic;}
span.FootNOTEChar
	{mso-style-name:"FootNOTE Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"Header Char";
	mso-style-link:FootNOTE;
	mso-ansi-font-size:9.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Angsana New";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Browallia New";
	mso-fareast-language:ZH-CN;
	mso-bidi-language:AR-SA;
	font-style:italic;}
p.StyleJustified, li.StyleJustified, div.StyleJustified
	{mso-style-name:"Style Justified";
	mso-style-unhide:no;
	margin:0in;
	text-align:justify;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-fareast-language:ZH-CN;}
p.StyleHeading3LatinArial11ptJustifiedBefore6ptA, li.StyleHeading3LatinArial11ptJustifiedBefore6ptA, div.StyleHeading3LatinArial11ptJustifiedBefore6ptA
	{mso-style-name:"Style Heading 3 + \(Latin\) Arial 11 pt Justified Before\:  6 pt A\.\.\.";
	mso-style-unhide:no;
	mso-style-parent:"Heading 3\,Level 1 - 1";
	margin-top:6.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	text-align:justify;
	text-indent:0in;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:3;
	mso-list:l0 level3 lfo5;
	tab-stops:list 0in left 56.7pt 92.15pt;
	font-size:12.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	font-weight:bold;}
p.font5, li.font5, div.font5
	{mso-style-name:font5;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Tahoma;
	color:black;}
p.xl63, li.xl63, div.xl63
	{mso-style-name:xl63;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	text-align:center;
	mso-pagination:widow-orphan;
	background:#FAC090;
	font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Tahoma;
	font-weight:bold;}
p.xl64, li.xl64, div.xl64
	{mso-style-name:xl64;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Times New Roman";}
p.xl65, li.xl65, div.xl65
	{mso-style-name:xl65;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	font-size:12.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Times New Roman";}
p.xl66, li.xl66, div.xl66
	{mso-style-name:xl66;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	text-align:center;
	mso-pagination:widow-orphan;
	background:#FAC090;
	border:none;
	mso-border-alt:solid windowtext .5pt;
	padding:0in;
	mso-padding-alt:0in 0in 0in 0in;
	font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Tahoma;
	font-weight:bold;}
p.xl67, li.xl67, div.xl67
	{mso-style-name:xl67;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	text-align:center;
	mso-pagination:widow-orphan;
	background:#FAC090;
	border:none;
	mso-border-alt:solid windowtext .5pt;
	padding:0in;
	mso-padding-alt:0in 0in 0in 0in;
	font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Tahoma;
	font-weight:bold;}
p.xl68, li.xl68, div.xl68
	{mso-style-name:xl68;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	border:none;
	mso-border-alt:solid windowtext .5pt;
	padding:0in;
	mso-padding-alt:0in 0in 0in 0in;
	font-size:12.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Times New Roman";}
p.xl69, li.xl69, div.xl69
	{mso-style-name:xl69;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	border:none;
	mso-border-alt:solid windowtext .5pt;
	padding:0in;
	mso-padding-alt:0in 0in 0in 0in;
	font-size:12.0pt;
	font-family:"Tahoma",sans-serif;
	mso-fareast-font-family:"Times New Roman";}
p.xl70, li.xl70, div.xl70
	{mso-style-name:xl70;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	border:none;
	mso-border-alt:solid windowtext .5pt;
	padding:0in;
	mso-padding-alt:0in 0in 0in 0in;
	font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Tahoma;}
p.xl71, li.xl71, div.xl71
	{mso-style-name:xl71;
	mso-style-unhide:no;
	mso-margin-top-alt:auto;
	margin-right:0in;
	mso-margin-bottom-alt:auto;
	margin-left:0in;
	mso-pagination:widow-orphan;
	border:none;
	mso-border-alt:solid windowtext .5pt;
	padding:0in;
	mso-padding-alt:0in 0in 0in 0in;
	font-size:10.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:Tahoma;}
span.BodyTextChar
	{mso-style-name:"Body Text Char\,BT Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Body Text\,BT";
	mso-bidi-font-size:11.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:Arial;
	mso-bidi-language:HE;}
p.TableText, li.TableText, div.TableText
	{mso-style-name:"Table Text";
	mso-style-unhide:no;
	margin-top:3.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:0in;
	mso-pagination:none;
	mso-list:skip;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:9.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	color:black;
	mso-ansi-language:EN-CA;
	mso-bidi-language:AR-SA;}
p.TableHeading0, li.TableHeading0, div.TableHeading0
	{mso-style-name:"Table Heading";
	mso-style-unhide:no;
	mso-style-next:Normal;
	margin-top:3.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:0in;
	text-align:center;
	mso-pagination:none;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	color:black;
	mso-ansi-language:EN-CA;
	mso-bidi-language:AR-SA;
	font-weight:bold;
	mso-bidi-font-weight:normal;
	font-style:italic;
	mso-bidi-font-style:normal;}
p.StyleHeading1LatinArial20ptBefore6ptAfter6pt, li.StyleHeading1LatinArial20ptBefore6ptAfter6pt, div.StyleHeading1LatinArial20ptBefore6ptAfter6pt
	{mso-style-name:"Style Heading 1 + \(Latin\) Arial 20 pt Before\:  6 pt After\:  6 pt\.\.\.";
	mso-style-unhide:no;
	mso-style-parent:"Heading 1";
	margin-top:6.0pt;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:.25in;
	text-align:justify;
	text-indent:-.25in;
	page-break-before:always;
	mso-pagination:widow-orphan;
	page-break-after:avoid;
	mso-outline-level:1;
	tab-stops:56.7pt;
	font-size:20.0pt;
	mso-bidi-font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Times New Roman";
	mso-font-kerning:14.0pt;
	mso-fareast-language:ZH-CN;
	font-weight:bold;}
p.Readerscomments, li.Readerscomments, div.Readerscomments
	{mso-style-name:"Reader\0027s comments";
	mso-style-unhide:no;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:6.0pt;
	margin-left:0in;
	mso-pagination:widow-orphan;
	mso-layout-grid-align:none;
	punctuation-wrap:simple;
	text-autospace:none;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:#CC00CC;
	mso-bidi-language:AR-SA;
	font-style:italic;}
p.BulletsL1, li.BulletsL1, div.BulletsL1
	{mso-style-name:"Bullets L1";
	mso-style-unhide:no;
	margin-top:3.0pt;
	margin-right:0in;
	margin-bottom:3.0pt;
	margin-left:.25in;
	text-indent:-.25in;
	mso-pagination:widow-orphan;
	tab-stops:list .25in;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	mso-bidi-language:AR-SA;}
span.MacroTextChar
	{mso-style-name:"Macro Text Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Macro Text";
	mso-ansi-font-size:14.0pt;
	font-family:"Times New Roman",serif;
	mso-ascii-font-family:"Times New Roman";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Times New Roman";
	mso-bidi-font-family:EucrosiaUPC;}
span.PlainTextChar
	{mso-style-name:"Plain Text Char";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Plain Text";
	mso-ansi-font-size:14.0pt;
	font-family:"Cordia New",sans-serif;
	mso-ascii-font-family:"Cordia New";
	mso-fareast-font-family:"Cordia New";
	mso-hansi-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";
	mso-ansi-language:X-NONE;
	mso-fareast-language:X-NONE;}
p.LegalLevel11, li.LegalLevel11, div.LegalLevel11
	{mso-style-name:"Legal Level 1\.1";
	mso-style-priority:9;
	mso-style-qformat:yes;
	mso-style-next:Normal;
	margin-top:10.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:251.45pt;
	text-indent:-9.0pt;
	line-height:115%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:6;
	font-size:16.0pt;
	font-family:"Cambria",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:#243F60;
	font-style:italic;}
p.LegalLevel111, li.LegalLevel111, div.LegalLevel111
	{mso-style-name:"Legal Level 1\.1\.1";
	mso-style-priority:9;
	mso-style-qformat:yes;
	mso-style-next:Normal;
	margin-top:10.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:287.45pt;
	text-indent:-.25in;
	line-height:115%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:7;
	font-size:16.0pt;
	font-family:"Cambria",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:#404040;
	font-style:italic;}
p.LegalLevel1111, li.LegalLevel1111, div.LegalLevel1111
	{mso-style-name:"Legal Level 1\.1\.1\.1";
	mso-style-priority:9;
	mso-style-qformat:yes;
	mso-style-next:Normal;
	margin-top:10.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:323.45pt;
	text-indent:-.25in;
	line-height:115%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:8;
	font-size:10.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"Cambria",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:#404040;}
p.LegalLevel11111, li.LegalLevel11111, div.LegalLevel11111
	{mso-style-name:"Legal Level 1\.1\.1\.1\.1";
	mso-style-priority:9;
	mso-style-qformat:yes;
	mso-style-next:Normal;
	margin-top:10.0pt;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:359.45pt;
	text-indent:-9.0pt;
	line-height:115%;
	mso-pagination:widow-orphan lines-together;
	page-break-after:avoid;
	mso-outline-level:9;
	font-size:10.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"Cambria",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:#404040;
	font-style:italic;}
span.UnresolvedMention1
	{mso-style-name:"Unresolved Mention1";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	color:gray;
	background:#E6E6E6;}
span.Heading6Char1
	{mso-style-name:"Heading 6 Char1";
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Cordia New";
	font-weight:bold;}
span.Heading7Char1
	{mso-style-name:"Heading 7 Char1";
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:15.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Cordia New";}
span.Heading8Char1
	{mso-style-name:"Heading 8 Char1";
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:12.0pt;
	mso-bidi-font-size:15.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Calibri;
	mso-bidi-font-family:"Cordia New";
	font-style:italic;}
span.Heading9Char1
	{mso-style-name:"Heading 9 Char1";
	mso-style-noshow:yes;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri Light",sans-serif;
	mso-ascii-font-family:"Calibri Light";
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:"Calibri Light";
	mso-bidi-font-family:"Angsana New";}
span.rStyle2
	{mso-style-name:rStyle2;
	mso-style-unhide:no;
	mso-style-parent:"";
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH Sarabun New",sans-serif;
	mso-ascii-font-family:"TH Sarabun New";
	mso-hansi-font-family:"TH Sarabun New";
	mso-bidi-font-family:"TH Sarabun New";
	font-weight:bold;
	mso-bidi-font-weight:normal;}
span.EndnoteTextChar
	{mso-style-name:"Endnote Text Char";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-link:"Endnote Text";
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ascii-font-family:"TH SarabunPSK";
	mso-fareast-font-family:"TH SarabunPSK";
	mso-hansi-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"Angsana New";}
p.10, li.10, div.10
	{mso-style-name:สไตล์1;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	mso-style-link:"สไตล์1 อักขระ";
	mso-style-next:"Heading 9";
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:53.45pt;
	mso-add-space:auto;
	text-indent:-.25in;
	mso-pagination:widow-orphan;
	mso-list:l75 level1 lfo10;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	font-weight:bold;}
p.10CxSpFirst, li.10CxSpFirst, div.10CxSpFirst
	{mso-style-name:สไตล์1CxSpFirst;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	mso-style-link:"สไตล์1 อักขระ";
	mso-style-next:"Heading 9";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:53.45pt;
	mso-add-space:auto;
	text-indent:-.25in;
	mso-pagination:widow-orphan;
	mso-list:l75 level1 lfo10;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	font-weight:bold;}
p.10CxSpMiddle, li.10CxSpMiddle, div.10CxSpMiddle
	{mso-style-name:สไตล์1CxSpMiddle;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	mso-style-link:"สไตล์1 อักขระ";
	mso-style-next:"Heading 9";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:53.45pt;
	mso-add-space:auto;
	text-indent:-.25in;
	mso-pagination:widow-orphan;
	mso-list:l75 level1 lfo10;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	font-weight:bold;}
p.10CxSpLast, li.10CxSpLast, div.10CxSpLast
	{mso-style-name:สไตล์1CxSpLast;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-parent:"List Paragraph\,Number Bullet Paragraph";
	mso-style-link:"สไตล์1 อักขระ";
	mso-style-next:"Heading 9";
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:53.45pt;
	mso-add-space:auto;
	text-indent:-.25in;
	mso-pagination:widow-orphan;
	mso-list:l75 level1 lfo10;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"TH SarabunPSK";
	font-weight:bold;}
span.11
	{mso-style-name:"สไตล์1 อักขระ";
	mso-style-unhide:no;
	mso-style-locked:yes;
	mso-style-parent:"List Paragraph Char\,Number Bullet Paragraph Char";
	mso-style-link:สไตล์1;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ascii-font-family:"TH SarabunPSK";
	mso-fareast-font-family:"TH SarabunPSK";
	mso-hansi-font-family:"TH SarabunPSK";
	mso-bidi-font-family:"TH SarabunPSK";
	font-weight:bold;}
p.MediumGrid1-Accent21, li.MediumGrid1-Accent21, div.MediumGrid1-Accent21
	{mso-style-name:"Medium Grid 1 - Accent 21";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";}
p.MediumGrid1-Accent21CxSpFirst, li.MediumGrid1-Accent21CxSpFirst, div.MediumGrid1-Accent21CxSpFirst
	{mso-style-name:"Medium Grid 1 - Accent 21CxSpFirst";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";}
p.MediumGrid1-Accent21CxSpMiddle, li.MediumGrid1-Accent21CxSpMiddle, div.MediumGrid1-Accent21CxSpMiddle
	{mso-style-name:"Medium Grid 1 - Accent 21CxSpMiddle";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";}
p.MediumGrid1-Accent21CxSpLast, li.MediumGrid1-Accent21CxSpLast, div.MediumGrid1-Accent21CxSpLast
	{mso-style-name:"Medium Grid 1 - Accent 21CxSpLast";
	mso-style-priority:34;
	mso-style-unhide:no;
	mso-style-qformat:yes;
	mso-style-type:export-only;
	margin-top:0in;
	margin-right:0in;
	margin-bottom:0in;
	margin-left:.5in;
	mso-add-space:auto;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	mso-bidi-font-size:12.5pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";}
span.12
	{mso-style-name:"ข้อความอ้างอิงท้ายเรื่อง อักขระ1";
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-ansi-font-size:10.0pt;
	mso-bidi-font-size:12.5pt;}
span.select2-selectionrendered
	{mso-style-name:select2-selection__rendered;
	mso-style-unhide:no;}
span.SpellE
	{mso-style-name:"";
	mso-spl-e:yes;}
.MsoChpDefault
	{mso-style-type:export-only;
	mso-default-props:yes;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-fareast-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;
	mso-font-kerning:0pt;
	mso-ligatures:none;}
.MsoPapDefault
	{mso-style-type:export-only;
	margin-bottom:10.0pt;
	line-height:115%;}
 /* Page Definitions */
 @page
	{mso-footnote-separator:url("<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/header.htm") fs;
	mso-footnote-continuation-separator:url("<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/header.htm") fcs;
	mso-endnote-separator:url("<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/header.htm") es;
	mso-endnote-continuation-separator:url("<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/header.htm") ecs;}
@page WordSection1
	{size:595.3pt 841.9pt;
	margin:64.1pt 1.0in 1.0in 1.0in;
	mso-header-margin:.25in;
	mso-footer-margin:27.35pt;
	mso-header:url("<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/header.htm") h1;
	mso-footer:url("<?php echo $WF_URL;?>/form/LED_SERVICE_62_files/header.htm") f1;
	mso-paper-source:0;}
div.WordSection1
	{page:WordSection1;}
 /* List Definitions */
 @list l0
	{mso-list-id:48651487;
	mso-list-template-ids:1669608808;}
@list l0:level1
	{mso-level-style-link:"Heading 1";
	mso-level-text:"บทที่ %1";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.3in;
	text-indent:-.3in;
	mso-ansi-font-size:20.0pt;
	mso-bidi-font-size:20.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;
	mso-bidi-language:TH;}
@list l0:level2
	{mso-level-style-link:"Heading 2";
	mso-level-text:"%1\.%2";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.4in;
	text-indent:-.4in;
	mso-ansi-font-size:18.0pt;
	mso-bidi-font-size:18.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
@list l0:level3
	{mso-level-style-link:"Heading 3";
	mso-level-text:"%1\.%2\.%3";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.5in;
	text-indent:-.5in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l0:level4
	{mso-level-style-link:"Heading 4";
	mso-level-text:"%1\.%2\.%3\.%4";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:192.1pt;
	text-indent:-.6in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;
	mso-bidi-language:TH;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l0:level5
	{mso-level-text:"%1\.%2\.%3\.%4\.%5";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.7in;
	text-indent:-.7in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;}
@list l0:level6
	{mso-level-style-link:"Heading 6";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.8in;
	text-indent:-.8in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;}
@list l0:level7
	{mso-level-style-link:"Heading 7";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.9in;
	text-indent:-.9in;}
@list l0:level8
	{mso-level-style-link:"Heading 8";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-1.0in;}
@list l0:level9
	{mso-level-style-link:"Heading 9";
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.1in;
	text-indent:-1.1in;}
@list l1
	{mso-list-id:88474349;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l1:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l1:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l1:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l1:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l1:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l1:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l1:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l1:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l1:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l2
	{mso-list-id:122846289;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l2:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l2:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:89.5pt;
	text-indent:-.25in;}
@list l2:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:125.5pt;
	text-indent:-9.0pt;}
@list l2:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:161.5pt;
	text-indent:-.25in;}
@list l2:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:197.5pt;
	text-indent:-.25in;}
@list l2:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:233.5pt;
	text-indent:-9.0pt;}
@list l2:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:269.5pt;
	text-indent:-.25in;}
@list l2:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:305.5pt;
	text-indent:-.25in;}
@list l2:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:341.5pt;
	text-indent:-9.0pt;}
@list l3
	{mso-list-id:128406185;
	mso-list-type:hybrid;
	mso-list-template-ids:-1442050050 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l3:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l3:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l3:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l3:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l3:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l3:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l3:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l3:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l3:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l4
	{mso-list-id:136998334;
	mso-list-type:hybrid;
	mso-list-template-ids:-843925958 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l4:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l4:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l4:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l4:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l4:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l4:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l4:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l4:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l4:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l5
	{mso-list-id:229078637;
	mso-list-type:hybrid;
	mso-list-template-ids:1542645262 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l5:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l5:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l5:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l5:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l5:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l5:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l5:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l5:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l5:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l6
	{mso-list-id:237523530;
	mso-list-type:hybrid;
	mso-list-template-ids:1615261014 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l6:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l6:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l6:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l6:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l6:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l6:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l6:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l6:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l6:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l7
	{mso-list-id:274754954;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l7:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l7:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l7:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l7:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l7:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l7:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l7:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l7:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l7:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l8
	{mso-list-id:312874988;
	mso-list-type:hybrid;
	mso-list-template-ids:-442740036 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l8:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l8:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l8:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l8:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l8:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l8:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l8:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l8:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l8:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l9
	{mso-list-id:384185799;
	mso-list-type:hybrid;
	mso-list-template-ids:1367264572 672069552 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l9:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l9:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l9:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l9:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l9:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l9:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l9:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l9:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l9:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l10
	{mso-list-id:447746376;
	mso-list-type:hybrid;
	mso-list-template-ids:1313523040 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l10:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l10:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l10:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l10:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l10:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l10:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l10:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l10:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l10:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l11
	{mso-list-id:450781407;
	mso-list-type:hybrid;
	mso-list-template-ids:608338834 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l11:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l11:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l11:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l11:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l11:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l11:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l11:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l11:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l11:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l12
	{mso-list-id:452335473;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 -1 -1 -1 -1 -1 -1 -1 -1 -1;}
@list l12:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l12:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l12:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l12:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l12:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l12:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l12:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l12:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l12:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l13
	{mso-list-id:487939553;
	mso-list-type:hybrid;
	mso-list-template-ids:2098991874 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l13:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l13:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l13:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l13:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l13:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l13:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l13:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l13:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l13:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l14
	{mso-list-id:524447126;
	mso-list-type:hybrid;
	mso-list-template-ids:-1373589050 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l14:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l14:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l14:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l14:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l14:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l14:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l14:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l14:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l14:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l15
	{mso-list-id:531457805;
	mso-list-type:hybrid;
	mso-list-template-ids:1176695748 -748246360 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l15:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l15:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l15:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l15:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l15:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l16
	{mso-list-id:538204259;
	mso-list-type:hybrid;
	mso-list-template-ids:27934726 -1303901464 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l16:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l16:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l16:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l16:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l16:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l16:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l16:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l16:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l16:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l17
	{mso-list-id:638612053;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l17:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l17:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l17:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l17:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l17:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l17:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l17:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l17:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l17:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l18
	{mso-list-id:677579985;
	mso-list-type:hybrid;
	mso-list-template-ids:-472196424 422762426 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l18:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l18:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l18:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l18:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l18:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l18:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l18:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l18:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l18:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l19
	{mso-list-id:683633810;
	mso-list-template-ids:-2075485910;
	mso-list-style-priority:99;
	mso-list-style-name:วงเล็บจ้า;}
@list l19:level1
	{mso-level-start-at:3;
	mso-level-text:"%1\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
@list l19:level2
	{mso-level-text:"%1\.%2\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.5in;
	text-indent:-.5in;
	mso-ansi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-bidi-font-family:"Times New Roman";}
@list l19:level3
	{mso-level-text:"%1\.%2\)%3\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.0in;
	text-indent:-.5in;}
@list l19:level4
	{mso-level-text:"%1\.%2\)%3\.%4\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.75in;
	text-indent:-.75in;}
@list l19:level5
	{mso-level-text:"%1\.%2\)%3\.%4\.%5\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.25in;
	text-indent:-.75in;}
@list l19:level6
	{mso-level-text:"%1\.%2\)%3\.%4\.%5\.%6\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:4.0in;
	text-indent:-1.0in;}
@list l19:level7
	{mso-level-text:"%1\.%2\)%3\.%4\.%5\.%6\.%7\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:4.5in;
	text-indent:-1.0in;}
@list l19:level8
	{mso-level-text:"%1\.%2\)%3\.%4\.%5\.%6\.%7\.%8\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:5.25in;
	text-indent:-1.25in;}
@list l19:level9
	{mso-level-text:"%1\.%2\)%3\.%4\.%5\.%6\.%7\.%8\.%9\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:5.75in;
	text-indent:-1.25in;}
@list l20
	{mso-list-id:695041767;
	mso-list-type:hybrid;
	mso-list-template-ids:-923484734 1238532832 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l20:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;}
@list l20:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l20:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l20:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l20:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l20:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l20:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l20:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l20:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l21
	{mso-list-id:697124337;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l21:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l21:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l21:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l21:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l21:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l21:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l21:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l21:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l21:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l22
	{mso-list-id:747657624;
	mso-list-type:hybrid;
	mso-list-template-ids:1981818504 672069552 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l22:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l22:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l22:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l22:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l22:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l22:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l22:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l22:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l22:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l23
	{mso-list-id:787772489;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l23:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l23:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l23:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l23:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l23:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l23:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l23:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l23:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l23:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l24
	{mso-list-id:844439659;
	mso-list-type:hybrid;
	mso-list-template-ids:-574034728 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l24:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l24:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l24:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l24:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l24:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l24:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l24:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l24:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l24:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l25
	{mso-list-id:939029878;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l25:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l25:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:96.6pt;
	text-indent:-.25in;}
@list l25:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:132.6pt;
	text-indent:-9.0pt;}
@list l25:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:168.6pt;
	text-indent:-.25in;}
@list l25:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:204.6pt;
	text-indent:-.25in;}
@list l25:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:240.6pt;
	text-indent:-9.0pt;}
@list l25:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:276.6pt;
	text-indent:-.25in;}
@list l25:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:312.6pt;
	text-indent:-.25in;}
@list l25:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:348.6pt;
	text-indent:-9.0pt;}
@list l26
	{mso-list-id:940718756;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 -1 -1 -1 -1 -1 -1 -1 -1 -1;}
@list l26:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l26:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l26:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l26:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l26:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l26:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l26:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l26:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l26:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l27
	{mso-list-id:960302839;
	mso-list-type:hybrid;
	mso-list-template-ids:1415744516 361558318 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l27:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l27:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l27:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l27:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l27:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l27:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l27:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l27:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l27:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l28
	{mso-list-id:973219137;
	mso-list-template-ids:-390944694;
	mso-list-style-priority:99;
	mso-list-style-name:Style2;}
@list l28:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l28:level2
	{mso-level-text:"%1\.%2\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.55in;
	text-indent:-.3in;}
@list l28:level3
	{mso-level-text:"%1\.%2\.%3\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.85in;
	text-indent:-.35in;}
@list l28:level4
	{mso-level-number-format:none;
	mso-level-text:"1\.1\.2\.1";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.2in;
	text-indent:-.45in;}
@list l28:level5
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.55in;
	text-indent:-.55in;}
@list l28:level6
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.9in;
	text-indent:-.65in;}
@list l28:level7
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.75in;}
@list l28:level8
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.6in;
	text-indent:-.85in;}
@list l28:level9
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.0in;
	text-indent:-1.0in;}
@list l29
	{mso-list-id:983391467;
	mso-list-type:hybrid;
	mso-list-template-ids:-14907834 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l29:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l29:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l29:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l29:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l29:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l29:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l29:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l29:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l29:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l30
	{mso-list-id:1070418496;
	mso-list-type:hybrid;
	mso-list-template-ids:1579326302 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l30:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l30:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l30:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l30:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l30:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l30:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l30:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l30:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l30:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l31
	{mso-list-id:1102530634;
	mso-list-type:hybrid;
	mso-list-template-ids:-80820666 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l31:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l31:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l31:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l31:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l31:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l31:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l31:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l31:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l31:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l32
	{mso-list-id:1119954047;
	mso-list-type:hybrid;
	mso-list-template-ids:-475746710 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;
	mso-list-style-priority:99;
	mso-list-style-name:Style21;}
@list l32:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l32:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l32:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l32:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l32:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l32:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l32:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l32:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l32:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l33
	{mso-list-id:1122459860;
	mso-list-type:hybrid;
	mso-list-template-ids:-607876622 -1261665382 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l33:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l33:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:89.5pt;
	text-indent:-.25in;}
@list l33:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:125.5pt;
	text-indent:-9.0pt;}
@list l33:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:161.5pt;
	text-indent:-.25in;}
@list l33:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:197.5pt;
	text-indent:-.25in;}
@list l33:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:233.5pt;
	text-indent:-9.0pt;}
@list l33:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:269.5pt;
	text-indent:-.25in;}
@list l33:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:305.5pt;
	text-indent:-.25in;}
@list l33:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:341.5pt;
	text-indent:-9.0pt;}
@list l34
	{mso-list-id:1137648512;
	mso-list-template-ids:1928237256;
	mso-list-style-priority:99;
	mso-list-style-name:Style11;}
@list l34:level1
	{mso-level-text:"บทที่ %1";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.3in;
	text-indent:-.3in;
	mso-ansi-font-size:20.0pt;
	mso-bidi-font-size:20.0pt;
	mso-bidi-language:TH;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l34:level2
	{mso-level-text:"%1\.%2";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.4in;
	text-indent:-.4in;
	font-variant:normal !important;
	mso-text-animation:none;
	mso-hide:none;
	text-transform:none;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-kerning:0pt;
	mso-ligatures:none;
	mso-number-form:default;
	mso-number-spacing:default;
	mso-stylistic-set:0;
	mso-contextual-alternates:no;
	text-effect:none;
	text-shadow:none;
	text-effect:none;
	text-effect:none;
	mso-style-textoutline-type:none;
	mso-style-textoutline-outlinestyle-dpiwidth:0pt;
	mso-style-textoutline-outlinestyle-linecap:round;
	mso-style-textoutline-outlinestyle-join:bevel;
	mso-style-textoutline-outlinestyle-pctmiterlimit:0%;
	mso-style-textoutline-outlinestyle-dash:solid;
	mso-style-textoutline-outlinestyle-align:center;
	mso-style-textoutline-outlinestyle-compound:simple;
	mso-style-style3d-lightrigtype:13;
	mso-style-style3d-lightrigdirection:2;
	mso-style-style3d-lightrigrotation-anglatitude:0;
	mso-style-style3d-lightrigrotation-anglongitude:0;
	mso-style-style3d-lightrigrotation-angrevolution:0;
	mso-effects-glow-color:black;
	mso-effects-glow-alpha:100.0%;
	mso-effects-glow-rad:0pt;
	mso-effects-shadow-color:black;
	mso-effects-shadow-alpha:100.0%;
	mso-effects-shadow-dpiradius:0pt;
	mso-effects-shadow-dpidistance:0pt;
	mso-effects-shadow-angledirection:0;
	mso-effects-shadow-align:none;
	mso-effects-shadow-pctsx:0%;
	mso-effects-shadow-pctsy:0%;
	mso-effects-shadow-anglekx:0;
	mso-effects-shadow-angleky:0;
	mso-effects-reflection-dpiradius:0pt;
	mso-effects-reflection-dpidistance:0pt;
	mso-effects-reflection-angdirection:0;
	mso-effects-reflection-pctsx:0%;
	mso-effects-reflection-pctsy:0%;
	mso-effects-reflection-anglekx:0;
	mso-effects-reflection-angleky:0;
	mso-effects-reflection-pctalphastart:0%;
	mso-effects-reflection-pctstartpos:0%;
	mso-effects-reflection-pctalphaend:0%;
	mso-effects-reflection-pctendpos:0%;
	mso-effects-reflection-angfadedirection:0;
	mso-effects-reflection-align:none;
	mso-bevel-captop-bevelstyle:0;
	mso-bevel-captop-dpiwidth:0pt;
	mso-bevel-captop-dpiheight:0pt;
	mso-bevel-capbot-bevelstyle:0;
	mso-bevel-capbot-dpiwidth:0pt;
	mso-bevel-capbot-dpiheight:0pt;
	mso-bevel-material:0;
	mso-bevel-dpiextrusion:0pt;
	mso-bevel-dpicontour:0pt;
	mso-ansi-language:EN-US;
	font-emphasize:none;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	mso-no-proof:no;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;
	vertical-align:baseline;}
@list l34:level3
	{mso-level-text:"%1\.%2\.%3";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.5in;
	text-indent:-.5in;
	font-variant:normal !important;
	color:black;
	mso-themecolor:text1;
	mso-text-animation:none;
	mso-hide:none;
	text-transform:none;
	position:relative;
	top:0pt;
	mso-text-raise:0pt;
	letter-spacing:0pt;
	mso-font-kerning:0pt;
	mso-ligatures:none;
	mso-number-form:default;
	mso-number-spacing:default;
	mso-stylistic-set:0;
	mso-contextual-alternates:no;
	text-effect:none;
	text-shadow:none;
	text-effect:none;
	text-effect:none;
	mso-style-textoutline-type:none;
	mso-style-textoutline-outlinestyle-dpiwidth:0pt;
	mso-style-textoutline-outlinestyle-linecap:round;
	mso-style-textoutline-outlinestyle-join:bevel;
	mso-style-textoutline-outlinestyle-pctmiterlimit:0%;
	mso-style-textoutline-outlinestyle-dash:solid;
	mso-style-textoutline-outlinestyle-align:center;
	mso-style-textoutline-outlinestyle-compound:simple;
	mso-style-style3d-lightrigtype:13;
	mso-style-style3d-lightrigdirection:2;
	mso-style-style3d-lightrigrotation-anglatitude:0;
	mso-style-style3d-lightrigrotation-anglongitude:0;
	mso-style-style3d-lightrigrotation-angrevolution:0;
	mso-effects-glow-color:black;
	mso-effects-glow-alpha:100.0%;
	mso-effects-glow-rad:0pt;
	mso-effects-shadow-color:black;
	mso-effects-shadow-alpha:100.0%;
	mso-effects-shadow-dpiradius:0pt;
	mso-effects-shadow-dpidistance:0pt;
	mso-effects-shadow-angledirection:0;
	mso-effects-shadow-align:none;
	mso-effects-shadow-pctsx:0%;
	mso-effects-shadow-pctsy:0%;
	mso-effects-shadow-anglekx:0;
	mso-effects-shadow-angleky:0;
	mso-effects-reflection-dpiradius:0pt;
	mso-effects-reflection-dpidistance:0pt;
	mso-effects-reflection-angdirection:0;
	mso-effects-reflection-pctsx:0%;
	mso-effects-reflection-pctsy:0%;
	mso-effects-reflection-anglekx:0;
	mso-effects-reflection-angleky:0;
	mso-effects-reflection-pctalphastart:0%;
	mso-effects-reflection-pctstartpos:0%;
	mso-effects-reflection-pctalphaend:0%;
	mso-effects-reflection-pctendpos:0%;
	mso-effects-reflection-angfadedirection:0;
	mso-effects-reflection-align:none;
	mso-bevel-captop-bevelstyle:0;
	mso-bevel-captop-dpiwidth:0pt;
	mso-bevel-captop-dpiheight:0pt;
	mso-bevel-capbot-bevelstyle:0;
	mso-bevel-capbot-dpiwidth:0pt;
	mso-bevel-capbot-dpiheight:0pt;
	mso-bevel-material:0;
	mso-bevel-dpiextrusion:0pt;
	mso-bevel-dpicontour:0pt;
	font-emphasize:none;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;
	mso-no-proof:no;
	text-decoration:none;
	text-underline:none;
	text-decoration:none;
	text-line-through:none;
	vertical-align:baseline;}
@list l34:level4
	{mso-level-text:"%1\.%2\.%3\.%4";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.6in;
	text-indent:-.6in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;
	mso-bidi-language:TH;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l34:level5
	{mso-level-text:"%1\.%2\.%3\.%4\.%5";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.7in;
	text-indent:-.7in;}
@list l34:level6
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.8in;
	text-indent:-.8in;}
@list l34:level7
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.9in;
	text-indent:-.9in;}
@list l34:level8
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-1.0in;}
@list l34:level9
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.1in;
	text-indent:-1.1in;}
@list l35
	{mso-list-id:1140805334;
	mso-list-type:hybrid;
	mso-list-template-ids:2098991874 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l35:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l35:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l35:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l35:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l35:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l35:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l35:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l35:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l35:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l36
	{mso-list-id:1190215256;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l36:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l36:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l36:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l36:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l36:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l36:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l36:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l36:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l36:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l37
	{mso-list-id:1198663294;
	mso-list-type:hybrid;
	mso-list-template-ids:-574034728 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l37:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l37:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l37:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l37:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l37:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l37:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l37:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l37:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l37:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l38
	{mso-list-id:1227062408;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 -1 -1 -1 -1 -1 -1 -1 -1 -1;}
@list l38:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l38:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l38:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l38:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l38:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l38:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l38:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l38:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l38:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l39
	{mso-list-id:1275399993;
	mso-list-type:hybrid;
	mso-list-template-ids:1982114418 1087900362 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l39:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l39:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l39:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l39:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l39:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l39:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l39:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l39:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l39:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l40
	{mso-list-id:1291282909;
	mso-list-type:hybrid;
	mso-list-template-ids:1524685574 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l40:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l40:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l40:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l40:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l40:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l40:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l40:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l40:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l40:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l41
	{mso-list-id:1300260141;
	mso-list-template-ids:-2020829494;}
@list l41:level1
	{mso-level-number-format:bullet;
	mso-level-style-link:Bullet1;
	mso-level-text:-;
	mso-level-tab-stop:0in;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:-.25in;
	font-family:SimSun;
	mso-bidi-font-family:"Times New Roman";}
@list l41:level2
	{mso-level-tab-stop:59.25pt;
	mso-level-number-position:left;
	margin-left:59.25pt;
	text-indent:-.25in;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l41:level3
	{mso-level-number-format:bullet;
	mso-level-text:;
	mso-level-tab-stop:95.25pt;
	mso-level-number-position:left;
	margin-left:95.25pt;
	text-indent:-.25in;
	font-family:"Times New Roman",serif;
	mso-hansi-font-family:Wingdings;}
@list l41:level4
	{mso-level-number-format:bullet;
	mso-level-text:;
	mso-level-tab-stop:131.25pt;
	mso-level-number-position:left;
	margin-left:131.25pt;
	text-indent:-.25in;
	font-family:"Times New Roman",serif;
	mso-hansi-font-family:Symbol;}
@list l41:level5
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:167.25pt;
	mso-level-number-position:left;
	margin-left:167.25pt;
	text-indent:-.25in;
	font-family:"Courier New";
	mso-bidi-font-family:"Times New Roman";}
@list l41:level6
	{mso-level-number-format:bullet;
	mso-level-text:;
	mso-level-tab-stop:203.25pt;
	mso-level-number-position:left;
	margin-left:203.25pt;
	text-indent:-.25in;
	font-family:"Times New Roman",serif;
	mso-hansi-font-family:Wingdings;}
@list l41:level7
	{mso-level-number-format:bullet;
	mso-level-text:;
	mso-level-tab-stop:239.25pt;
	mso-level-number-position:left;
	margin-left:239.25pt;
	text-indent:-.25in;
	font-family:"Times New Roman",serif;
	mso-hansi-font-family:Symbol;}
@list l41:level8
	{mso-level-number-format:bullet;
	mso-level-text:o;
	mso-level-tab-stop:275.25pt;
	mso-level-number-position:left;
	margin-left:275.25pt;
	text-indent:-.25in;
	font-family:"Courier New";
	mso-bidi-font-family:"Times New Roman";}
@list l41:level9
	{mso-level-number-format:bullet;
	mso-level-text:;
	mso-level-tab-stop:311.25pt;
	mso-level-number-position:left;
	margin-left:311.25pt;
	text-indent:-.25in;
	font-family:"Times New Roman",serif;
	mso-hansi-font-family:Wingdings;}
@list l42
	{mso-list-id:1329478571;
	mso-list-type:hybrid;
	mso-list-template-ids:27934726 -1303901464 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l42:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l42:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l42:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l42:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l42:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l42:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l42:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l42:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l42:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l43
	{mso-list-id:1330212104;
	mso-list-type:hybrid;
	mso-list-template-ids:-923484734 1238532832 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l43:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;}
@list l43:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l43:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l43:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l43:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l43:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l43:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l43:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l43:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l44
	{mso-list-id:1372338216;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 -1 -1 -1 -1 -1 -1 -1 -1 -1;}
@list l44:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l44:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l44:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l44:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l44:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l44:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l44:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l44:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l44:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l45
	{mso-list-id:1408261795;
	mso-list-type:hybrid;
	mso-list-template-ids:-1300055248 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l45:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l45:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l45:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l45:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l45:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l45:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l45:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l45:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l45:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l46
	{mso-list-id:1471630909;
	mso-list-type:hybrid;
	mso-list-template-ids:-607876622 -1261665382 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l46:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l46:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l46:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l46:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l46:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l46:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l46:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l46:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l46:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l47
	{mso-list-id:1488519186;
	mso-list-template-ids:-603162222;
	mso-list-style-priority:99;
	mso-list-style-name:Style1;}
@list l47:level1
	{mso-level-text:"บทที่ %1";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:92.5pt;
	text-indent:-.3in;
	mso-ansi-font-size:20.0pt;
	mso-bidi-font-size:20.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
@list l47:level2
	{mso-level-text:"%1\.%2";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.4in;
	text-indent:-.4in;
	mso-ansi-font-size:18.0pt;
	mso-bidi-font-size:18.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:black;
	mso-themecolor:text1;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l47:level3
	{mso-level-text:"%1\.%2\.%3";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:85.5pt;
	text-indent:-.5in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;}
@list l47:level4
	{mso-level-text:"%1\.%2\.%3\.%4";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:196.2pt;
	text-indent:-.6in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	color:windowtext;
	mso-bidi-language:TH;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l47:level5
	{mso-level-number-format:none;
	mso-level-text:"1\.1\.2\.1";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.7in;
	text-indent:-.7in;
	mso-ansi-font-size:16.0pt;
	mso-bidi-font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:SimSun;
	mso-fareast-theme-font:major-fareast;
	color:windowtext;
	mso-bidi-language:TH;
	mso-ansi-font-weight:normal;
	mso-bidi-font-weight:normal;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l47:level6
	{mso-level-text:"%1\.%2\.%3\.%4\.2";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.8in;
	text-indent:-.8in;
	font-family:"TH SarabunPSK",sans-serif;
	color:black;
	mso-themecolor:text1;}
@list l47:level7
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.9in;
	text-indent:-.9in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l47:level8
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-1.0in;}
@list l47:level9
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.1in;
	text-indent:-1.1in;}
@list l48
	{mso-list-id:1490058263;
	mso-list-type:hybrid;
	mso-list-template-ids:649262944 1517292154 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l48:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:center;
	margin-left:32.2pt;
	text-indent:-.25in;}
@list l48:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l48:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l48:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l48:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l48:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l48:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l48:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l48:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l49
	{mso-list-id:1513303572;
	mso-list-type:hybrid;
	mso-list-template-ids:1415744516 361558318 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l49:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l49:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l49:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l49:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l49:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l49:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l49:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l49:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l49:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l50
	{mso-list-id:1513375486;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 -1 -1 -1 -1 -1 -1 -1 -1 -1;}
@list l50:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l50:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l50:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l50:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l50:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l50:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l50:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l50:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l50:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l51
	{mso-list-id:1515801358;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l51:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l51:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:75.3pt;
	text-indent:-.25in;}
@list l51:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:111.3pt;
	text-indent:-9.0pt;}
@list l51:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:147.3pt;
	text-indent:-.25in;}
@list l51:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:183.3pt;
	text-indent:-.25in;}
@list l51:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:219.3pt;
	text-indent:-9.0pt;}
@list l51:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:255.3pt;
	text-indent:-.25in;}
@list l51:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:291.3pt;
	text-indent:-.25in;}
@list l51:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:327.3pt;
	text-indent:-9.0pt;}
@list l52
	{mso-list-id:1533612367;
	mso-list-type:hybrid;
	mso-list-template-ids:1305216532 -1430342918 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l52:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l52:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l52:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l52:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l52:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l52:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l52:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l52:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l52:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l53
	{mso-list-id:1566069115;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l53:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l53:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
@list l53:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:1.25in;
	text-indent:-9.0pt;}
@list l53:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.75in;
	text-indent:-.25in;}
@list l53:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l53:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:2.75in;
	text-indent:-9.0pt;}
@list l53:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.25in;
	text-indent:-.25in;}
@list l53:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l53:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:4.25in;
	text-indent:-9.0pt;}
@list l54
	{mso-list-id:1612396953;
	mso-list-type:hybrid;
	mso-list-template-ids:-480451272 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l54:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l54:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
@list l54:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:1.25in;
	text-indent:-9.0pt;}
@list l54:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.75in;
	text-indent:-.25in;}
@list l54:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l54:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:2.75in;
	text-indent:-9.0pt;}
@list l54:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.25in;
	text-indent:-.25in;}
@list l54:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l54:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:4.25in;
	text-indent:-9.0pt;}
@list l55
	{mso-list-id:1634142299;
	mso-list-type:hybrid;
	mso-list-template-ids:-1894246854 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l55:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l55:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l55:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l55:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l55:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l55:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l55:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l55:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l55:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l56
	{mso-list-id:1652253438;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l56:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l56:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:125.0pt;
	text-indent:-.25in;}
@list l56:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:161.0pt;
	text-indent:-9.0pt;}
@list l56:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:197.0pt;
	text-indent:-.25in;}
@list l56:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:233.0pt;
	text-indent:-.25in;}
@list l56:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:269.0pt;
	text-indent:-9.0pt;}
@list l56:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:305.0pt;
	text-indent:-.25in;}
@list l56:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:341.0pt;
	text-indent:-.25in;}
@list l56:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:377.0pt;
	text-indent:-9.0pt;}
@list l57
	{mso-list-id:1667434121;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l57:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l57:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l57:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l57:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l57:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l57:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l57:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l57:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l57:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l58
	{mso-list-id:1687438498;
	mso-list-type:hybrid;
	mso-list-template-ids:1367264572 672069552 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l58:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l58:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l58:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l58:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l58:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l58:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l58:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l58:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l58:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l59
	{mso-list-id:1746759478;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l59:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l59:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l59:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l59:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l59:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l59:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l59:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l59:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l59:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l60
	{mso-list-id:1779566154;
	mso-list-type:hybrid;
	mso-list-template-ids:571630320 -903429592 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l60:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l60:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l60:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l60:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l60:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l60:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l60:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l60:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l60:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l61
	{mso-list-id:1825122179;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l61:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l61:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l61:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l61:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l61:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l61:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l61:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l61:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l61:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l62
	{mso-list-id:1841045403;
	mso-list-template-ids:2051969314;}
@list l62:level1
	{mso-level-style-link:"MM Topic 1";
	mso-level-suffix:space;
	mso-level-text:%1;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l62:level2
	{mso-level-style-link:"MM Topic 1";
	mso-level-suffix:space;
	mso-level-text:"%1\.%2";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l62:level3
	{mso-level-style-link:"MM Topic 3";
	mso-level-suffix:space;
	mso-level-text:"%1\.%2\.%3";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l62:level4
	{mso-level-text:"\(%4\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.0in;
	text-indent:-.25in;}
@list l62:level5
	{mso-level-number-format:alpha-lower;
	mso-level-text:"\(%5\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.25in;
	text-indent:-.25in;}
@list l62:level6
	{mso-level-number-format:roman-lower;
	mso-level-text:"\(%6\)";
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.5in;
	text-indent:-.25in;}
@list l62:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.75in;
	text-indent:-.25in;}
@list l62:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.0in;
	text-indent:-.25in;}
@list l62:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l63
	{mso-list-id:1861577937;
	mso-list-type:hybrid;
	mso-list-template-ids:1189496876 -1 -1 -1 -1 -1 -1 -1 -1 -1;}
@list l63:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;}
@list l63:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.75in;
	text-indent:-.25in;}
@list l63:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:1.25in;
	text-indent:-9.0pt;}
@list l63:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:1.75in;
	text-indent:-.25in;}
@list l63:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.25in;}
@list l63:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:2.75in;
	text-indent:-9.0pt;}
@list l63:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.25in;
	text-indent:-.25in;}
@list l63:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:3.75in;
	text-indent:-.25in;}
@list l63:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:4.25in;
	text-indent:-9.0pt;}
@list l64
	{mso-list-id:1898583678;
	mso-list-type:hybrid;
	mso-list-template-ids:996558030 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l64:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l64:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l64:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l64:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l64:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l64:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l64:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l64:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l64:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l65
	{mso-list-id:1906256436;
	mso-list-type:hybrid;
	mso-list-template-ids:-714957814 -207088450 67698691 67698693 67698689 67698691 67698693 67698689 67698691 67698693;}
@list l65:level1
	{mso-level-style-link:"Use Case Number";
	mso-level-text:"%1\)";
	mso-level-tab-stop:.5in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:"Arial",sans-serif;
	mso-bidi-font-family:"Arial Unicode MS";}
@list l65:level2
	{mso-level-number-format:bullet;
	mso-level-text:;
	mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	text-indent:-.25in;
	font-family:Symbol;}
@list l65:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:1.5in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l65:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l65:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:3.0in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l65:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:4.0in;
	mso-level-number-position:left;
	text-indent:-.25in;}
@list l65:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:4.5in;
	mso-level-number-position:right;
	text-indent:-9.0pt;}
@list l66
	{mso-list-id:1950358765;
	mso-list-type:hybrid;
	mso-list-template-ids:-435122320 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l66:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l66:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l66:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l66:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l66:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l66:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l66:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l66:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l66:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l67
	{mso-list-id:1991202493;
	mso-list-type:hybrid;
	mso-list-template-ids:-1278168536 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l67:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l67:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l67:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l67:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l67:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l67:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l67:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l67:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l67:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l68
	{mso-list-id:2020304330;
	mso-list-template-ids:1925762612;}
@list l68:level1
	{mso-level-style-link:AxureHeading1;
	mso-level-suffix:space;
	mso-level-tab-stop:.25in;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l68:level2
	{mso-level-style-link:AxureHeading2;
	mso-level-suffix:space;
	mso-level-text:"%1\.%2\.";
	mso-level-tab-stop:.55in;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l68:level3
	{mso-level-style-link:AxureHeading3;
	mso-level-suffix:space;
	mso-level-text:"%1\.%2\.%3\.";
	mso-level-tab-stop:1.0in;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l68:level4
	{mso-level-style-link:AxureHeading4;
	mso-level-suffix:space;
	mso-level-text:"%1\.%2\.%3\.%4\.";
	mso-level-tab-stop:1.25in;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l68:level5
	{mso-level-suffix:space;
	mso-level-text:"%1\.%2\.%3\.%4\.%5\.";
	mso-level-tab-stop:1.75in;
	mso-level-number-position:left;
	margin-left:0in;
	text-indent:0in;}
@list l68:level6
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.";
	mso-level-tab-stop:2.0in;
	mso-level-number-position:left;
	margin-left:1.9in;
	text-indent:-.65in;}
@list l68:level7
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.";
	mso-level-tab-stop:2.5in;
	mso-level-number-position:left;
	margin-left:2.25in;
	text-indent:-.75in;}
@list l68:level8
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.";
	mso-level-tab-stop:2.75in;
	mso-level-number-position:left;
	margin-left:2.6in;
	text-indent:-.85in;}
@list l68:level9
	{mso-level-text:"%1\.%2\.%3\.%4\.%5\.%6\.%7\.%8\.%9\.";
	mso-level-tab-stop:3.25in;
	mso-level-number-position:left;
	margin-left:3.0in;
	text-indent:-1.0in;}
@list l69
	{mso-list-id:2034839878;
	mso-list-type:hybrid;
	mso-list-template-ids:127150966 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l69:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l69:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l69:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l69:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l69:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l69:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l69:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l69:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l69:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l70
	{mso-list-id:2043554757;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l70:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l70:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:117.9pt;
	text-indent:-.25in;}
@list l70:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:153.9pt;
	text-indent:-9.0pt;}
@list l70:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:189.9pt;
	text-indent:-.25in;}
@list l70:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:225.9pt;
	text-indent:-.25in;}
@list l70:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:261.9pt;
	text-indent:-9.0pt;}
@list l70:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:297.9pt;
	text-indent:-.25in;}
@list l70:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:333.9pt;
	text-indent:-.25in;}
@list l70:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:369.9pt;
	text-indent:-9.0pt;}
@list l71
	{mso-list-id:2044404307;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l71:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l71:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l71:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l71:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l71:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l71:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l71:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l71:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l71:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l72
	{mso-list-id:2046832082;
	mso-list-type:hybrid;
	mso-list-template-ids:277770780 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l72:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l72:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:61.1pt;
	text-indent:-.25in;}
@list l72:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:97.1pt;
	text-indent:-9.0pt;}
@list l72:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:133.1pt;
	text-indent:-.25in;}
@list l72:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:169.1pt;
	text-indent:-.25in;}
@list l72:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:205.1pt;
	text-indent:-9.0pt;}
@list l72:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:241.1pt;
	text-indent:-.25in;}
@list l72:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:277.1pt;
	text-indent:-.25in;}
@list l72:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:313.1pt;
	text-indent:-9.0pt;}
@list l73
	{mso-list-id:2047681290;
	mso-list-type:hybrid;
	mso-list-template-ids:1367264572 672069552 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l73:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:.25in;
	text-indent:-.25in;
	mso-ansi-font-style:normal;
	mso-bidi-font-style:normal;}
@list l73:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:68.2pt;
	text-indent:-.25in;}
@list l73:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:104.2pt;
	text-indent:-9.0pt;}
@list l73:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:140.2pt;
	text-indent:-.25in;}
@list l73:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:176.2pt;
	text-indent:-.25in;}
@list l73:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:212.2pt;
	text-indent:-9.0pt;}
@list l73:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:248.2pt;
	text-indent:-.25in;}
@list l73:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:284.2pt;
	text-indent:-.25in;}
@list l73:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:320.2pt;
	text-indent:-9.0pt;}
@list l74
	{mso-list-id:2058238297;
	mso-list-type:hybrid;
	mso-list-template-ids:-1595760742 67698703 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l74:level1
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:25.1pt;
	text-indent:-.25in;}
@list l74:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:82.4pt;
	text-indent:-.25in;}
@list l74:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:118.4pt;
	text-indent:-9.0pt;}
@list l74:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:154.4pt;
	text-indent:-.25in;}
@list l74:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:190.4pt;
	text-indent:-.25in;}
@list l74:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:226.4pt;
	text-indent:-9.0pt;}
@list l74:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:262.4pt;
	text-indent:-.25in;}
@list l74:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:298.4pt;
	text-indent:-.25in;}
@list l74:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:334.4pt;
	text-indent:-9.0pt;}
@list l75
	{mso-list-id:2079396354;
	mso-list-type:hybrid;
	mso-list-template-ids:573629240 -1909916220 67698713 67698715 67698703 67698713 67698715 67698703 67698713 67698715;}
@list l75:level1
	{mso-level-style-link:สไตล์1;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:53.45pt;
	text-indent:-.25in;}
@list l75:level2
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:89.45pt;
	text-indent:-.25in;}
@list l75:level3
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:125.45pt;
	text-indent:-9.0pt;}
@list l75:level4
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:161.45pt;
	text-indent:-.25in;}
@list l75:level5
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:197.45pt;
	text-indent:-.25in;}
@list l75:level6
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:233.45pt;
	text-indent:-9.0pt;}
@list l75:level7
	{mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:269.45pt;
	text-indent:-.25in;}
@list l75:level8
	{mso-level-number-format:alpha-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:left;
	margin-left:305.45pt;
	text-indent:-.25in;}
@list l75:level9
	{mso-level-number-format:roman-lower;
	mso-level-tab-stop:none;
	mso-level-number-position:right;
	margin-left:341.45pt;
	text-indent:-9.0pt;}
@list l41:level1 lfo6
	{mso-level-start-at:0;}
@list l41:level3 lfo6
	{mso-level-start-at:0;}
@list l41:level4 lfo6
	{mso-level-start-at:0;}
@list l41:level5 lfo6
	{mso-level-start-at:0;}
@list l41:level6 lfo6
	{mso-level-start-at:0;}
@list l41:level7 lfo6
	{mso-level-start-at:0;}
@list l41:level8 lfo6
	{mso-level-start-at:0;}
@list l41:level9 lfo6
	{mso-level-start-at:0;}
@list l65:level2 lfo9
	{mso-level-start-at:0;}
ol
	{margin-bottom:0in;}
ul
	{margin-bottom:0in;}
-->
</style>
<!--[if gte mso 10]>
<style>
 /* Style Definitions */
 table.MsoNormalTable
	{mso-style-name:"Table Normal";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-noshow:yes;
	mso-style-priority:99;
	mso-style-parent:"";
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-para-margin-top:0in;
	mso-para-margin-right:0in;
	mso-para-margin-bottom:10.0pt;
	mso-para-margin-left:0in;
	line-height:115%;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.MsoTableGrid
	{mso-style-name:"Table Grid";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:39;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.MsoTableTheme
	{mso-style-name:"Table Theme";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Cordia New",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";}
table.3
	{mso-style-name:เส้นตาราง3;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid black 1.0pt;
	mso-border-alt:solid black .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid black;
	mso-border-insidev:.5pt solid black;
	mso-para-margin-top:0in;
	mso-para-margin-right:-2.85pt;
	mso-para-margin-bottom:0in;
	mso-para-margin-left:-2.85pt;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:Calibri;}
table.5
	{mso-style-name:เส้นตาราง5;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid black 1.0pt;
	mso-border-alt:solid black .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid black;
	mso-border-insidev:.5pt solid black;
	mso-para-margin-top:0in;
	mso-para-margin-right:-2.85pt;
	mso-para-margin-bottom:0in;
	mso-para-margin-left:-2.85pt;
	mso-pagination:widow-orphan;
	font-size:16.0pt;
	font-family:"TH SarabunPSK",sans-serif;
	mso-fareast-font-family:Calibri;}
table.GridTable6Colorful-Accent41
	{mso-style-name:"Grid Table 6 Colorful - Accent 41";
	mso-tstyle-rowband-size:1;
	mso-tstyle-colband-size:1;
	mso-style-priority:51;
	mso-style-unhide:no;
	border:solid #B2A1C7 1.0pt;
	mso-border-themecolor:accent4;
	mso-border-themetint:153;
	mso-border-alt:solid #B2A1C7 .5pt;
	mso-border-themecolor:accent4;
	mso-border-themetint:153;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid #B2A1C7;
	mso-border-insideh-themecolor:accent4;
	mso-border-insideh-themetint:153;
	mso-border-insidev:.5pt solid #B2A1C7;
	mso-border-insidev-themecolor:accent4;
	mso-border-insidev-themetint:153;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:"Angsana New";
	mso-hansi-font-family:"Angsana New";
	mso-bidi-font-family:"Angsana New";
	color:#5F497A;
	mso-themecolor:accent4;
	mso-themeshade:191;}
table.GridTable6Colorful-Accent41FirstRow
	{mso-style-name:"Grid Table 6 Colorful - Accent 41";
	mso-table-condition:first-row;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-border-bottom:1.5pt solid #B2A1C7;
	mso-tstyle-border-bottom-themecolor:accent4;
	mso-tstyle-border-bottom-themetint:153;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent41LastRow
	{mso-style-name:"Grid Table 6 Colorful - Accent 41";
	mso-table-condition:last-row;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-border-top:1.5pt double #B2A1C7;
	mso-tstyle-border-top-themecolor:accent4;
	mso-tstyle-border-top-themetint:153;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent41FirstCol
	{mso-style-name:"Grid Table 6 Colorful - Accent 41";
	mso-table-condition:first-column;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent41LastCol
	{mso-style-name:"Grid Table 6 Colorful - Accent 41";
	mso-table-condition:last-column;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent41OddColumn
	{mso-style-name:"Grid Table 6 Colorful - Accent 41";
	mso-table-condition:odd-column;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-shading:#E5DFEC;
	mso-tstyle-shading-themecolor:accent4;
	mso-tstyle-shading-themetint:51;}
table.GridTable6Colorful-Accent41OddRow
	{mso-style-name:"Grid Table 6 Colorful - Accent 41";
	mso-table-condition:odd-row;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-shading:#E5DFEC;
	mso-tstyle-shading-themecolor:accent4;
	mso-tstyle-shading-themetint:51;}
table.TableGrid1
	{mso-style-name:"Table Grid1";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.GridTable6Colorful-Accent411
	{mso-style-name:"Grid Table 6 Colorful - Accent 411";
	mso-tstyle-rowband-size:1;
	mso-tstyle-colband-size:1;
	mso-style-priority:51;
	mso-style-unhide:no;
	border:solid #FFD966 1.0pt;
	mso-border-alt:solid #FFD966 .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid #FFD966;
	mso-border-insidev:.5pt solid #FFD966;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:"Angsana New";
	mso-hansi-font-family:"Angsana New";
	mso-bidi-font-family:"Angsana New";
	color:#BF8F00;}
table.GridTable6Colorful-Accent411FirstRow
	{mso-style-name:"Grid Table 6 Colorful - Accent 411";
	mso-table-condition:first-row;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-border-bottom:1.5pt solid #FFD966;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent411LastRow
	{mso-style-name:"Grid Table 6 Colorful - Accent 411";
	mso-table-condition:last-row;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-border-top:1.5pt double #FFD966;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent411FirstCol
	{mso-style-name:"Grid Table 6 Colorful - Accent 411";
	mso-table-condition:first-column;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent411LastCol
	{mso-style-name:"Grid Table 6 Colorful - Accent 411";
	mso-table-condition:last-column;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.GridTable6Colorful-Accent411OddColumn
	{mso-style-name:"Grid Table 6 Colorful - Accent 411";
	mso-table-condition:odd-column;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-shading:#FFF2CC;}
table.GridTable6Colorful-Accent411OddRow
	{mso-style-name:"Grid Table 6 Colorful - Accent 411";
	mso-table-condition:odd-row;
	mso-style-priority:51;
	mso-style-unhide:no;
	mso-tstyle-shading:#FFF2CC;}
table.30
	{mso-style-name:เส้นตาราง30;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-fareast-font-family:Calibri;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.myOwnTableStyle
	{mso-style-name:myOwnTableStyle;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"";
	border:solid black 1.0pt;
	mso-border-alt:solid black .75pt;
	mso-padding-alt:4.0pt 4.0pt 4.0pt 4.0pt;
	mso-border-insideh:.75pt solid black;
	mso-border-insidev:.75pt solid black;
	mso-para-margin-top:0in;
	mso-para-margin-right:0in;
	mso-para-margin-bottom:8.0pt;
	mso-para-margin-left:0in;
	line-height:107%;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:Arial;}
table.MediumList1-Accent11
	{mso-style-name:"Medium List 1 - Accent 11";
	mso-tstyle-rowband-size:1;
	mso-tstyle-colband-size:1;
	mso-style-priority:65;
	mso-style-unhide:no;
	border-top:solid #4F81BD 1.0pt;
	border-left:none;
	border-bottom:solid #4F81BD 1.0pt;
	border-right:none;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Times New Roman",serif;
	mso-fareast-font-family:"Times New Roman";
	mso-bidi-font-family:"Angsana New";
	color:black;}
table.MediumList1-Accent11FirstRow
	{mso-style-name:"Medium List 1 - Accent 11";
	mso-table-condition:first-row;
	mso-style-priority:65;
	mso-style-unhide:no;
	mso-tstyle-border-top:cell-none;
	mso-tstyle-border-bottom:1.0pt solid #4F81BD;
	font-family:"Cambria",serif;
	mso-ascii-font-family:Cambria;
	mso-fareast-font-family:"Times New Roman";
	mso-hansi-font-family:Cambria;
	mso-bidi-font-family:"Angsana New";}
table.MediumList1-Accent11LastRow
	{mso-style-name:"Medium List 1 - Accent 11";
	mso-table-condition:last-row;
	mso-style-priority:65;
	mso-style-unhide:no;
	mso-tstyle-border-top:1.0pt solid #4F81BD;
	mso-tstyle-border-bottom:1.0pt solid #4F81BD;
	color:#1F497D;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.MediumList1-Accent11FirstCol
	{mso-style-name:"Medium List 1 - Accent 11";
	mso-table-condition:first-column;
	mso-style-priority:65;
	mso-style-unhide:no;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.MediumList1-Accent11LastCol
	{mso-style-name:"Medium List 1 - Accent 11";
	mso-table-condition:last-column;
	mso-style-priority:65;
	mso-style-unhide:no;
	mso-tstyle-border-top:1.0pt solid #4F81BD;
	mso-tstyle-border-bottom:1.0pt solid #4F81BD;
	mso-ansi-font-weight:bold;
	mso-bidi-font-weight:bold;}
table.MediumList1-Accent11OddColumn
	{mso-style-name:"Medium List 1 - Accent 11";
	mso-table-condition:odd-column;
	mso-style-priority:65;
	mso-style-unhide:no;
	mso-tstyle-shading:#D3DFEE;}
table.MediumList1-Accent11OddRow
	{mso-style-name:"Medium List 1 - Accent 11";
	mso-table-condition:odd-row;
	mso-style-priority:65;
	mso-style-unhide:no;
	mso-tstyle-shading:#D3DFEE;}
table.TableGrid2
	{mso-style-name:"Table Grid2";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-unhide:no;
	border:solid black 1.0pt;
	mso-border-alt:solid black .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid black;
	mso-border-insidev:.5pt solid black;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Cordia New",sans-serif;
	mso-fareast-font-family:"Cordia New";
	mso-bidi-font-family:"Angsana New";}
table.TableGrid11
	{mso-style-name:"Table Grid11";
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:59;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-fareast-font-family:Calibri;
	mso-bidi-font-family:"Cordia New";}
table.myOwnTableStyle1
	{mso-style-name:myOwnTableStyle1;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:99;
	mso-style-unhide:no;
	mso-style-parent:"";
	border:solid black 1.0pt;
	mso-border-alt:solid black .75pt;
	mso-padding-alt:4.0pt 4.0pt 4.0pt 4.0pt;
	mso-border-insideh:.75pt solid black;
	mso-border-insidev:.75pt solid black;
	mso-para-margin-top:0in;
	mso-para-margin-right:0in;
	mso-para-margin-bottom:8.0pt;
	mso-para-margin-left:0in;
	line-height:107%;
	mso-pagination:widow-orphan;
	font-size:10.0pt;
	font-family:"Arial",sans-serif;
	mso-fareast-font-family:Arial;}
table.13
	{mso-style-name:เส้นตาราง1;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:39;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.2
	{mso-style-name:เส้นตาราง2;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:39;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.4
	{mso-style-name:เส้นตาราง4;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:39;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.6
	{mso-style-name:เส้นตาราง6;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:39;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
table.7
	{mso-style-name:เส้นตาราง7;
	mso-tstyle-rowband-size:0;
	mso-tstyle-colband-size:0;
	mso-style-priority:39;
	mso-style-unhide:no;
	border:solid windowtext 1.0pt;
	mso-border-alt:solid windowtext .5pt;
	mso-padding-alt:0in 5.4pt 0in 5.4pt;
	mso-border-insideh:.5pt solid windowtext;
	mso-border-insidev:.5pt solid windowtext;
	mso-para-margin:0in;
	mso-pagination:widow-orphan;
	font-size:11.0pt;
	mso-bidi-font-size:14.0pt;
	font-family:"Calibri",sans-serif;
	mso-ascii-font-family:Calibri;
	mso-ascii-theme-font:minor-latin;
	mso-hansi-font-family:Calibri;
	mso-hansi-theme-font:minor-latin;
	mso-bidi-font-family:"Cordia New";
	mso-bidi-theme-font:minor-bidi;}
</style>
<![endif]--><!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="2050"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
  <o:idmap v:ext="edit" data="2"/>
 </o:shapelayout></xml><![endif]-->
</head>

<body lang=EN-US link=blue vlink=purple style='tab-interval:.5in;word-wrap:
break-word'>

<div class=WordSection1>

<p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
line-height:normal'><b><span style='mso-bidi-font-size:11.0pt;font-family:"TH SarabunPSK",sans-serif'><o:p>&nbsp;</o:p></span></b></p>

<h2 style='mso-list:l0 level2 lfo5'><a name="_Toc150200216"><![if !supportLists]><b><span
style='font-size:18.0pt;mso-fareast-font-family:"TH SarabunPSK"'><span
style='mso-list:Ignore'>1.1<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;
</span></span></span></b><![endif]><b style='mso-ansi-font-weight:normal'><span
lang=TH><?php echo getSystem($rec['SYS_NAME']); ?></span></b></a></h2>

<h3 style='mso-list:l0 level3 lfo5'><![if !supportLists]><span
style='mso-fareast-font-family:"TH SarabunPSK";color:black;mso-themecolor:text1'><span
style='mso-list:Ignore'>1.1.1<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span></span></span><![endif]><span style='color:black;mso-themecolor:text1'><?php echo $rec['SERVICE_CODE']; ?>
<span lang=TH> <?php echo $rec['SERVICE_DESC']; ?> </span>(<span class=SpellE><?php echo $rec['SERVICE_NAME']; ?></span>)<o:p></o:p></span></h3>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <thead>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes'>
   <td width=601 colspan=5 valign=top style='width:450.8pt;border:solid windowtext 1.0pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
   <h4 style='margin-left:0in;text-indent:0in;line-height:normal;mso-list:none;
   tab-stops:106.35pt'><span style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
   color:black;mso-themecolor:text1;font-style:normal'>Data Request: <span
   class=SpellE><?php echo $rec['SERVICE_NAME']; ?></span><span lang=TH><o:p></o:p></span></span></h4>
   </td>
  </tr>
  <tr style='mso-yfti-irow:1'>
   <td width=45 valign=top style='width:33.4pt;border:solid windowtext 1.0pt;
   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
   solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:background1;
   mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
   <h4 align=center style='margin-left:0in;text-align:center;text-indent:0in;
   line-height:normal;mso-list:none;tab-stops:106.35pt'><span style='font-size:
   16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
   text1;font-style:normal'>No<o:p></o:p></span></h4>
   </td>
   <td width=148 valign=top style='width:111.05pt;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
   <h4 align=center style='margin-left:0in;text-align:center;text-indent:0in;
   line-height:normal;mso-list:none;tab-stops:106.35pt'><span style='font-size:
   16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
   text1;font-style:normal'>Field<o:p></o:p></span></h4>
   </td>
   <td width=92 valign=top style='width:69.25pt;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
   <h4 align=center style='margin-left:0in;text-align:center;text-indent:0in;
   line-height:normal;mso-list:none;tab-stops:106.35pt'><span style='font-size:
   16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
   text1;font-style:normal'>Data Type<o:p></o:p></span></h4>
   </td>
   <td width=93 valign=top style='width:69.55pt;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
   <h4 align=center style='margin-left:0in;text-align:center;text-indent:0in;
   line-height:normal;mso-list:none;tab-stops:106.35pt'><span style='font-size:
   16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
   text1;font-style:normal'>M/O<o:p></o:p></span></h4>
   </td>
   <td width=223 valign=top style='width:167.55pt;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt'>
   <h4 align=center style='margin-left:0in;text-align:center;text-indent:0in;
   line-height:normal;mso-list:none;tab-stops:106.35pt'><span style='font-size:
   16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
   text1;font-style:normal'>Description<o:p></o:p></span></h4>
   </td>
  </tr>
 </thead>
 <?php $sql_api_list = "SELECT * FROM M_API_LIST WHERE 1 = 1 
 AND API_SETTING_ID = '".$API_SETTING_ID."' AND API_STATUS = 0 ORDER BY API_LIST_ID ASC";
 $qry_api_list = db::query($sql_api_list);
 $i_list = 1;
while ($rec_api_list = db::fetch_array($qry_api_list)) {?>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes'>
 <td width=45 valign=top style='width:33.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoListParagraph align=center style='margin-top:0in;margin-right:
  0in;margin-bottom:0in;margin-left:.25in;mso-add-space:auto;text-align:center;
  text-indent:-16.45pt;line-height:normal;mso-list:l2 level1 lfo14'><![if !supportLists]><span
  style='font-family:"TH SarabunPSK",sans-serif;mso-fareast-font-family:"TH SarabunPSK";
  color:black;mso-themecolor:text1'><span style='mso-list:Ignore'>1.<span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]><span
  style='font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
  text1'><o:p>&nbsp;</o:p></span></p>
  </td>
  <td width=148 valign=top style='width:111.05pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
  class=SpellE><span style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
  color:black;mso-themecolor:text1'><?php echo $rec_api_list['KEY']; ?></span></span><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;
  mso-themecolor:text1'><o:p></o:p></span></p>
  </td>
  <td width=92 valign=top style='width:69.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;
  mso-themecolor:text1'><?php echo $rec_api_list['TYPE']; ?><o:p></o:p></span></p>
  </td>
  <td width=93 valign=top style='width:69.55pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
  height:17.3pt'>
  <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
  line-height:normal'><span style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
  color:black;mso-themecolor:text1'><?php echo $rec_api_list['STATUS']; ?><o:p></o:p></span></p>
  </td>
  <td width=223 valign=top style='width:167.55pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:17.3pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
  lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
  color:black;mso-themecolor:text1'><?php echo $rec_api_list['API_DESC']; ?></span><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;
  mso-themecolor:text1'><o:p></o:p></span></p>
  </td>
 </tr>
 <?php } ?>
</table>

<p class=MsoNormal><span style='font-size:3.0pt;mso-bidi-font-size:5.0pt;
line-height:107%;color:black;mso-themecolor:text1'><o:p>&nbsp;</o:p></span></p>

<span style='font-size:3.0pt;mso-bidi-font-size:5.0pt;line-height:115%;
font-family:"Calibri",sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:
Calibri;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;
mso-bidi-font-family:"Cordia New";mso-bidi-theme-font:minor-bidi;color:black;
mso-themecolor:text1;mso-ansi-language:EN-US;mso-fareast-language:EN-US;
mso-bidi-language:TH'><br clear=all style='mso-special-character:line-break;
page-break-before:always'>
</span>

<p class=MsoNormal style='margin-bottom:10.0pt;line-height:115%'><span
style='font-size:3.0pt;mso-bidi-font-size:5.0pt;line-height:115%;color:black;
mso-themecolor:text1'><o:p>&nbsp;</o:p></span></p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none;mso-border-alt:solid windowtext .5pt;
 mso-yfti-tbllook:1184;mso-padding-alt:0in 5.4pt 0in 5.4pt'>
 <thead>
  <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:2.8pt'>
   <td width=601 colspan=5 valign=top style='width:450.8pt;border:solid windowtext 1.0pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt;
   height:2.8pt'>
   <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
   style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;
   mso-themecolor:text1'>Data Response: <span class=SpellE><?php echo $rec['SERVICE_NAME']; ?></span><b><o:p></o:p></b></span></p>
   </td>
  </tr>
  <tr style='mso-yfti-irow:1;height:2.8pt'>
   <td width=46 valign=top style='width:34.4pt;border:solid windowtext 1.0pt;
   border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:
   solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:background1;
   mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt;height:2.8pt'>
   <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
   line-height:normal'><span style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
   color:black;mso-themecolor:text1'>No<span lang=TH><o:p></o:p></span></span></p>
   </td>
   <td width=143 valign=top style='width:107.1pt;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt;
   height:2.8pt'>
   <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
   line-height:normal'><span style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
   color:black;mso-themecolor:text1'>Field<o:p></o:p></span></p>
   </td>
   <td width=93 valign=top style='width:69.75pt;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt;
   height:2.8pt'>
   <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
   line-height:normal'><span style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
   color:black;mso-themecolor:text1'>Data Type<o:p></o:p></span></p>
   </td>
   <td width=168 valign=top style='width:1.75in;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt;
   height:2.8pt'>
   <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
   line-height:normal'><span style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
   color:black;mso-themecolor:text1'>Description<o:p></o:p></span></p>
   </td>
   <td width=151 valign=top style='width:113.55pt;border-top:none;border-left:
   none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
   mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
   mso-border-alt:solid windowtext .5pt;background:#D9D9D9;mso-background-themecolor:
   background1;mso-background-themeshade:217;padding:0in 5.4pt 0in 5.4pt;
   height:2.8pt'>
   <p class=MsoNormal align=center style='margin-bottom:0in;text-align:center;
   line-height:normal'><span lang=TH style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;
   color:black;mso-themecolor:text1'>หมายเหตุ</span><span style='font-size:
   16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
   text1'><o:p></o:p></span></p>
   </td>
  </tr>
 </thead>
 <?php 
 $sql_api_list2 = "SELECT * FROM M_API_LIST WHERE 1 = 1 AND API_SETTING_ID = '".$API_SETTING_ID."' 
 AND API_STATUS = 1 AND STATUS = 'S' ORDER BY API_LIST_ID ASC";
 $qry_api_list2 = db::query($sql_api_list2);
 $i_api_list2 = 1;
 while ($rec_api_list2 = db::fetch_array($qry_api_list2)) {
 ?>
 <tr style='mso-yfti-irow:2;mso-yfti-lastrow:yes;height:2.8pt'>
  <td width=46 valign=top style='width:34.4pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:2.8pt'><a name="_Hlk41916890"></a>
  <p class=MsoListParagraph align=center style='margin-top:0in;margin-right:
  0in;margin-bottom:0in;margin-left:25.1pt;mso-add-space:auto;text-align:center;
  text-indent:-.25in;line-height:normal;mso-list:l49 level1 lfo71'><span
  style='mso-bookmark:_Hlk41916890'><![if !supportLists]><span
  style='font-family:"TH SarabunPSK",sans-serif;mso-fareast-font-family:"TH SarabunPSK";
  color:black;mso-themecolor:text1'><span style='mso-list:Ignore'><?php echo $i_api_list2++.'.'; ?><span
  style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></span><![endif]></span><span
  style='mso-bookmark:_Hlk41916890'><span style='font-family:"TH SarabunPSK",sans-serif;
  color:black;mso-themecolor:text1'><o:p>&nbsp;</o:p></span></span></p>
  </td>
  <span style='mso-bookmark:_Hlk41916890'></span>
  <td width=143 valign=top style='width:107.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:2.8pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
  style='mso-bookmark:_Hlk41916890'><span class=SpellE><span style='font-size:
  16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:
  text1'><?php echo $rec_api_list2['KEY']; ?></span></span></span><span style='mso-bookmark:_Hlk41916890'><span
  style='font-size:16.0pt;font-family:"TH SarabunPSK",sans-serif;color:black;
  mso-themecolor:text1'><o:p></o:p></span></span></p>
  </td>
  <span style='mso-bookmark:_Hlk41916890'></span>
  <td width=93 valign=top style='width:69.75pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;height:2.8pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
  style='mso-bookmark:_Hlk41916890'><span style='font-size:16.0pt;font-family:
  "TH SarabunPSK",sans-serif;color:black;mso-themecolor:text1'><?php echo $rec_api_list2['TYPE']; ?><o:p></o:p></span></span></p>
  </td>
  <span style='mso-bookmark:_Hlk41916890'></span>
  <td width=168 valign=top style='width:1.75in;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0in 5.4pt 0in 5.4pt;
  height:2.8pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
  style='mso-bookmark:_Hlk41916890'><span lang=TH style='font-size:16.0pt;
  font-family:"TH SarabunPSK",sans-serif;color:black;mso-themecolor:text1'><?php echo $rec_api_list2['API_DESC']; ?><o:p></o:p></span></span></p>
  </td>
  <span style='mso-bookmark:_Hlk41916890'></span>
  <td width=151 valign=top style='width:113.55pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0in 5.4pt 0in 5.4pt;height:2.8pt'><span style='mso-bookmark:_Hlk41916890'></span>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'><span
  style='mso-bookmark:_Hlk41916890'><span style='font-size:16.0pt;font-family:
  "TH SarabunPSK",sans-serif;color:black;mso-themecolor:text1'><o:p>&nbsp;</o:p></span></span></p>
  </td>
  <span style='mso-bookmark:_Hlk41916890'></span>
 </tr>
 <?php } ?>
</table>

<span style='mso-bookmark:_Hlk41916890'></span><span style='font-size:16.0pt;
line-height:107%;font-family:"TH SarabunPSK",sans-serif;mso-fareast-font-family:
Calibri;mso-fareast-theme-font:minor-latin;color:black;mso-themecolor:text1;
mso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:TH'><br
clear=all style='mso-special-character:line-break;page-break-before:always'>
</span>

<p class=MsoNormal><span style='font-size:16.0pt;line-height:107%;font-family:
"TH SarabunPSK",sans-serif;color:black;mso-themecolor:text1'><o:p>&nbsp;</o:p></span></p>

</div>

</body>

</html>
