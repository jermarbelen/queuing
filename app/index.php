<?php require_once('../Connections/connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO trasaction_tb (transaction_id, `Client number`, name, trasaction_type, counter, called_status, called_time, field1, field2, field3, field4, field5) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['transaction_id'], "int"),
                       GetSQLValueString($_POST['Client_number'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['trasaction_type'], "text"),
					   GetSQLValueString($_POST['counter'], "text"),
					   GetSQLValueString($_POST['called_status'], "text"),
                       GetSQLValueString($_POST['called_time'], "text"),
                       GetSQLValueString($_POST['field1'], "text"),
                       GetSQLValueString($_POST['field2'], "text"),
                       GetSQLValueString($_POST['field3'], "text"),
                       GetSQLValueString($_POST['field4'], "text"),
                       GetSQLValueString($_POST['field5'], "text"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());

  $insertGoTo = "print_number.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
<meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<meta http-equiv=X-UA-Compatible content="IE=edge">
<meta name=msapplication-tap-highlight content=no>
<title>REQUEST</title>
<link href="assets/A.css%2c%2c_materialize.min.css%2bjs%2c%2c_plugins%2c%2c_perfect-scrollbar%2c%2c_perfect-scrollbar.css%2cMcc.Mf0aw0Oa_F.css.pagespeed.cf.Ge_QCEjHhJ.css" type="text/css" rel=stylesheet media="screen,projection"/>
<style>.btn-queue{padding:25px;font-size:47px;line-height:36px;height:auto;margin:10px;letter-spacing:0;text-transform:none}</style>
<link href="assets/css/A.style.min.css.pagespeed.cf.mJfUwXhfzO.css" type="text/css" rel=stylesheet media="screen,projection">
</head>
<body>
<div id=loader-wrapper>
<div id=loader></div>
<div class="loader-section section-left"></div>
<div class="loader-section section-right"></div>
</div>
<header id=header class=page-topbar>
<div class=navbar-fixed>
<nav class=navbar-color>
<div class=nav-wrapper>
<ul class=left>
<li><h1 class=logo-wrapper><a href=login.html class="brand-logo darken-1"><img src="assets/images/logo.png" alt="materialize logo"></a><span class=logo-text>DENR</span></h1></li>
</ul>
<ul class="right hide-on-med-and-down">
<li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class=mdi-action-settings-overscan></i></a></li>
</ul>
<ul class=right>
<span class=truncate style="margin-right:20px;font-size:20px">QUEUING SYSTEM </span>
</ul>
</div>
</nav>
</div>
</header>
<div id=main style="padding:15px;padding-bottom:0">
<div class=wrapper>
<section id=content>
<div class=row>
<div class="col s12">
<div class=card style="background:#f9f9f9;box-shadow:none">
<span class=card-title style="line-height:0;font-size:22px">Click 1 (one) transaction to issue request</span>
<div class=divider style="margin:10px 0 10px 0"></div>
<center>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<span class="btn btn-large btn-queue waves-effect waves-light" onclick="queue_dept(1)"><input type="submit" value="Approval"></span>
<input type="hidden" name="trasaction_type" value="APPROVAL" />
<input type="hidden" name="counter" value="COUNTER-1" />
<input type="hidden" name="called_status" value="N" />
<input type="hidden" name="MM_insert" value="form1" />
</form>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<span class="btn btn-large btn-queue waves-effect waves-light" onclick="queue_dept(1)"><input type="submit" value="Land Requirements"></span>
<input type="hidden" name="trasaction_type" value="LAND-REQUIREMENTS" />
<input type="hidden" name="counter" value="COUNTER-2" />
<input type="hidden" name="called_status" value="N" />
<input type="hidden" name="MM_insert" value="form1" />
</form>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
<span class="btn btn-large btn-queue waves-effect waves-light" onclick="queue_dept(1)"><input type="submit" value="Other Transactions"></span>
<input type="hidden" name="trasaction_type" value="OTHER-TRANSACTION" />
<input type="hidden" name="counter" value="COUNTER-3" />
<input type="hidden" name="called_status" value="N" />
<input type="hidden" name="MM_insert" value="form1" />
</form>

</center>
</div>
</div>
</div>
</section>
</div>
</div>
<footer class=page-footer style="padding:0;margin-top:0">
<div class=footer-copyright>
<div class=container>
<span>Powered by <a class="grey-text text-lighten-3" href="#" target=_blank>DENR-MIMAROPA</a> All rights reserved.</span>
<span class=right> <span class="grey-text text-lighten-3">Version</span> 1</span>
</div>
</div>
</footer>
<script src="assets/js/plugins/jquery-1.11.2.min.js.pagespeed.jm.J-8M9bCq0j.js"></script>
<script src="assets/js/materialize.min.js.pagespeed.jm.OQ5Q0ODC0F.js"></script>
<script src="assets/js/plugins%2c_perfect-scrollbar%2c_perfect-scrollbar.min.js%2bplugins.min.js.pagespeed.jc.v_7n8RyfbT.js"></script><script>eval(mod_pagespeed_a5mfZXeHps);</script>
<script>eval(mod_pagespeed_sSsjFjS4KJ);</script>
<script>$(function(){$('#main').css({'min-height':$(window).height()-134+'px'});});$(window).resize(function(){$('#main').css({'min-height':$(window).height()-134+'px'});});function queue_dept(value){$('body').removeClass('loaded');var myForm2='<form id="hidfrm2" action="http://tokenq.justlabtech.com/queue" method="post"><input type="hidden" name="_token" value="P2xgryCwJGgmbgz5Zz5JCxOcah4gP9pahysN8PDQ"><input type="hidden" name="department" value="'+value+'"></form>';$('body').append(myForm2);myForm2=$('#hidfrm2');myForm2.submit();}</script>
</body>
</html>
