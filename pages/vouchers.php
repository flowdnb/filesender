<?php

/*
 * FileSender www.filesender.org
 * 
 * Copyright (c) 2009-2011, AARNet, HEAnet, SURFnet, UNINETT
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 * 
 * *	Redistributions of source code must retain the above copyright
 * 	notice, this list of conditions and the following disclaimer.
 * *	Redistributions in binary form must reproduce the above copyright
 * 	notice, this list of conditions and the following disclaimer in the
 * 	documentation and/or other materials provided with the distribution.
 * *	Neither the name of AARNet, HEAnet, SURFnet and UNINETT nor the
 * 	names of its contributors may be used to endorse or promote products
 * 	derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/* ---------------------------------
 * Vouchers Page
 * ---------------------------------
 * 
 */
 ?>
<script>
var maximumDate= '<?php echo $config['default_daysvalid'] ?>';
var maxEmailRecipients = <?php echo $config['max_email_recipients'] ?>;
var datepickerDateFormat = '<?php echo lang('_DP_dateFormat'); ?>';
	
var selectedVoucher = "";
$(function() {
	//$("#fileto_msg").hide();
	$("#expiry_msg").hide();
	
	// stripe every second row in the tables
	$("#vouchertable tr:odd").addClass('altcolor');
	$("#datepicker" ).datepicker({ minDate: 1, maxDate: "+"+maximumDate+"D",altField: "#altdate", altFormat: "d-m-yy",currentText:maximumDate });
	$("#datepicker" ).datepicker( "option", "dateFormat", "<?php echo lang('_DP_dateFormat'); ?>" );
	$("#datepicker").datepicker("setDate", new Date()+maximumDate);
	
	// set datepicker language
	$.datepicker.setDefaults({
	closeText: '<?php echo lang("_DP_closeText"); ?>',
	prevText: '<?php echo lang("_DP_prevText"); ?>',
	nextText: '<?php echo lang("_DP_nextText"); ?>',
	currentText: '<?php echo lang("_DP_currentText"); ?>',
	monthNames: <?php echo lang("_DP_monthNames"); ?>,
	monthNamesShort: <?php echo lang("_DP_monthNamesShort"); ?>,
	dayNames: <?php echo lang("_DP_dayNames"); ?>,
	dayNamesShort: <?php echo lang("_DP_dayNamesShort"); ?>,
	dayNamesMin: <?php echo lang("_DP_dayNamesMin"); ?>,
	weekHeader: '<?php echo lang("_DP_weekHeader"); ?>',
	dateFormat: '<?php echo lang("_DP_dateFormat"); ?>',
	firstDay: <?php echo lang("_DP_firstDay"); ?>,
	isRTL: <?php echo lang("_DP_isRTL"); ?>,
	showMonthAfterYear: <?php echo lang("_DP_showMonthAfterYear"); ?>,
	yearSuffix: '<?php echo lang("_DP_yearSuffix"); ?>'});
	
	$("#dialog-delete").dialog({ autoOpen: false, height: 140, modal: true,
	
	buttons: {
			<?php echo lang("_CANCEL") ?>: function() {
				$( this ).dialog( "close" );
			},
			<?php echo lang("_DELETE") ?>: function() { 
			deletevoucher();
			$( this ).dialog( "close" );
			}
	}
	});
});

function validateForm()
	{
		$("#fileto_msg").hide();
		if(!validate_fileto()){return false;}
		if(!validate_expiry() ){return false;}
		document.forms['form1'].submit();//return true;
	}
		
function deletevoucher()
	{
		window.location.href="index.php?s=vouchers&a=del&id=" + selectedVoucher;
	}

function confirmdelete(vid)
	{
		selectedVoucher = vid;
		$("#dialog-delete").dialog("open");
	}

	</script>
<?php 

// add voucher
if(isset($_POST["fileto"]) && isset($_POST["altdate"]))
{
// insert voucher for each email
$emailto = str_replace(",",";",$_POST["fileto"]);
$emailArray = preg_split("/;/", $emailto);
foreach ($emailArray as $Email) { 
$functions->insertVoucher($Email,$_POST["altdate"]);
}
echo "<div id='message'>".lang("_VOUCHER_SENT")."</div>";
}
// del
if(isset($_REQUEST["a"]) && isset($_REQUEST["id"])) 
{
$myfileData = $functions->getVoucherData($_REQUEST['id']);
if($_REQUEST["a"] == "del" )
{
if($functions->deleteVoucher($myfileData[0]["fileid"]))
{
echo "<div id='message'>".lang("_VOUCHER_DELETED")."</div>";
}
}
}

// get file data
$filedata = $functions->getVouchers();
$json_o=json_decode($filedata,true);

?>
<form name="form1" method="post" action="index.php?s=vouchers"  onSubmit="return validateForm()">
    <div id="box">
  <?php echo '<div id="pageheading">'.lang("_VOUCHERS").'</div>'; ?>
    <table width="100%" border="0">
      <tr>
        <td colspan="2" class="formfieldheading"><?php echo html_entity_decode(lang("_SEND_NEW_VOUCHER")); ?></td>
      </tr>
      </table>
      </div>
      <div id="box">
       <table width="100%" border="0">
      <tr>
        <td class="mandatory" width="130"><?php echo lang("_SEND_VOUCHER_TO"); ?>:</td>
        <td>
        <input id="fileto" name="fileto" title="<?php echo lang("_EMAIL_SEPARATOR_MSG"); ?>"  type="text" size="45" onchange="validate_fileto()"/><br />
 		<div id="fileto_msg" class="validation_msg" style="display:none"><?php echo lang("_INVALID_MISSING_EMAIL"); ?></div>
        <div id="maxemails_msg" style="display: none" class="validation_msg"><?php echo lang("_MAXEMAILS"); ?> <?php echo $config['max_email_recipients'] ?>.</div>
 		</td>
      </tr>
      <tr>
        <td class="mandatory"><?php echo lang("_EXPIRY_DATE"); ?>:</td>
        <td><input id="datepicker" onchange="validate_expiry()" title="<?php echo lang('_DP_dateFormat'); ?>"></input> <div id="expiry_msg" class="validation_msg" style="display:none"><?php echo lang("_INVALID_EXPIRY_DATE"); ?></div></td>
      </tr>
      <tr>
        <td><input type="hidden" id="altdate" name="altdate" value="<?php echo date($config['datedisplayformat'],strtotime("+".$config['default_daysvalid']." day"));?>" /></td>
        <td><div class="menu" id="voucherbutton"><a href="#" onclick="validateForm()"><?php echo lang("_SEND_VOUCHER"); ?></a></div></td>
      </tr>
    </table>
     </div>
  </form>
  <div id="box">
  <table id="vouchertable" width="100%" border="0" cellspacing="1">
    <tr class="headerrow">
      <td><strong><?php echo lang("_TO"); ?></strong></td>
      <td><strong><?php echo lang("_CREATED"); ?></strong></td>
      <td><strong><?php echo lang("_EXPIRY"); ?></strong></td>
      <td></td>
    </tr>
    <?php 
foreach($json_o as $item) {
   echo "<tr><td>" .$item['fileto'] . "</td><td>" .date($config['datedisplayformat'],strtotime($item['filecreateddate'])) . "</td><td>" .date($config['datedisplayformat'],strtotime($item['fileexpirydate'])) . "</td><td><div  style='cursor:pointer;'><img src='images/shape_square_delete.png' title='".lang("_DELETE")."' onclick='confirmdelete(".'"' .$item['filevoucheruid'] . '"'. ")' border='0'></div></td></tr>"; //etc
}
?>
  </table>
</div>
<div id="dialog-delete" title="<?php echo lang("_DELETE_VOUCHER") ?>">
  <p><?php echo lang("_CONFIRM_DELETE_VOUCHER"); ?></p>
</div>