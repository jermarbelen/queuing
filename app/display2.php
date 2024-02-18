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

$maxRows_rstransacon = 3;
$pageNum_rstransacon = 0;
if (isset($_GET['pageNum_rstransacon'])) {
  $pageNum_rstransacon = $_GET['pageNum_rstransacon'];
}
$startRow_rstransacon = $pageNum_rstransacon * $maxRows_rstransacon;

mysql_select_db($database_connection, $connection);
$query_rstransacon = "SELECT * FROM trasaction_tb WHERE called_status ='N' ORDER BY transaction_id ASC";
$query_limit_rstransacon = sprintf("%s LIMIT %d, %d", $query_rstransacon, $startRow_rstransacon, $maxRows_rstransacon);
$rstransacon = mysql_query($query_limit_rstransacon, $connection) or die(mysql_error());
$row_rstransacon = mysql_fetch_assoc($rstransacon);

if (isset($_GET['totalRows_rstransacon'])) {
  $totalRows_rstransacon = $_GET['totalRows_rstransacon'];
} else {
  $all_rstransacon = mysql_query($query_rstransacon);
  $totalRows_rstransacon = mysql_num_rows($all_rstransacon);
}
$totalPages_rstransacon = ceil($totalRows_rstransacon/$maxRows_rstransacon)-1;

mysql_select_db($database_connection, $connection);
$query_rstransacfin = "SELECT * FROM trasaction_tb WHERE called_status ='F' OR called_status ='T' ORDER BY transaction_id DESC";
$rstransacfin = mysql_query($query_rstransacfin, $connection) or die(mysql_error());
$row_rstransacfin = mysql_fetch_assoc($rstransacfin);
$totalRows_rstransacfin = mysql_num_rows($rstransacfin);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="10;URL='display2.php'" />
<title>DISPLAY</title>

</head>
<body class="loaded">
<div id="loader-wrapper">
<div id="loader"></div>
<div class="loader-section section-left"></div>
<div class="loader-section section-right"></div>
</div>
<header id="header" class="page-topbar">
<div class="navbar-fixed">
<nav class="navbar-color">
<div class="nav-wrapper">
<ul class="left">
<li><h1 class=logo-wrapper><a href=login.html class="brand-logo darken-1"><img src="assets/images/logo.png" alt="materialize logo"></a><span class=logo-text>DENR</span></h1></li>
</ul>
<ul class="right hide-on-med-and-down">
<li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a></li>
</ul>
<ul class="right">
<span class="truncate" style="margin-right:20px;font-size:20px">QUEUE SYSTEM</span>
</ul>
</div>
</nav>
</div>
</header>
<div id="main" style="padding: 15px 15px 0px; min-height: 524px;">
<div class="wrapper">
<section id="content">
<div id="callarea" class="row" style="line-height:1.23">
<div class="col m4">
<div class="card-panel center-align" style="margin-bottom:0">

<!--list of Ongoing Transaction -->
<?php do { ?>
<div style="border-bottom:1px solid #ddd">
<span id="num1" style="font-size:55px;font-weight:bold;line-height:1.45">
<?php echo $row_rstransacon['transaction_id']; ?> <?php //echo $row_rstransacon['name']; ?>
</span><br>
<small id="cou1" style="text-transform:uppercase;font-size:20px"><?php echo $row_rstransacon['trasaction_type']; ?></small>
</div>
<?php } while ($row_rstransacon = mysql_fetch_assoc($rstransacon)); ?>
<!-- END -->

</div>
</div>
<div class="col m8">

<div class="card-panel center-align" style="margin-bottom:0">

<span style="font-size:45px">TRANSACTION NO.</span><br>

<span id="num0" style="font-size:100px;color:red;font-weight:bold;line-height:1.5"><?php echo $row_rstransacfin['transaction_id']; ?> <?php //echo $row_rstransacfin['name']; ?></span><br>

<span style="font-size:40px;text-transform:uppercase"><?php echo $row_rstransacfin['trasaction_type']; ?></span><br>

<span id="cou0" style="text-transform:uppercase;font-size:80px; color:red;line-height:1.5"><?php echo $row_rstransacfin['counter']; ?></span>

</div>

</div>
</div>
<div class="row" style="margin-bottom:0;font-size:15px;color:rgba(68,3,226,0.96)">
<marquee>Advertising - - - - - - - - - - - - - - - - </marquee>
</div>
</section>
</div>
</div>
<footer class="page-footer" style="padding:0;margin-top:0">
<div class="footer-copyright">
<div class="container">
<span>Powered by <a class="grey-text text-lighten-3" href="#" target="_blank">DENR-MIMAROPA</a> All rights reserved.</span>
<span class="right"> <span class="grey-text text-lighten-3">Version</span> 0.2b</span>
</div>
</div>
</footer>
<link href="assets/A.css%2c%2c_materialize.min.css%2bjs%2c%2c_plugins%2c%2c_perfect-scrollbar%2c%2c_perfect-scrollbar.css%2cMcc.Mf0aw0Oa_F.css.pagespeed.cf.Ge_QCEjHhJ.css" type="text/css" rel=stylesheet media="screen,projection"/>
<style>.btn-queue{padding:25px;font-size:47px;line-height:36px;height:auto;margin:10px;letter-spacing:0;text-transform:none}</style>
<link href="assets/css/A.style.min.css.pagespeed.cf.mJfUwXhfzO.css" type="text/css" rel=stylesheet media="screen,projection">

<script src="assets/js/plugins/jquery-1.11.2.min.js.pagespeed.jm.J-8M9bCq0j.js"></script>
<script src="assets/js/materialize.min.js.pagespeed.jm.OQ5Q0ODC0F.js"></script>
<script src="assets/js/plugins%2c_perfect-scrollbar%2c_perfect-scrollbar.min.js%2bplugins.min.js.pagespeed.jc.v_7n8RyfbT.js"></script><script>eval(mod_pagespeed_a5mfZXeHps);</script>
<script>eval(mod_pagespeed_sSsjFjS4KJ);</script>
<script>$(function(){$('#main').css({'min-height':$(window).height()-134+'px'});});$(window).resize(function(){$('#main').css({'min-height':$(window).height()-134+'px'});});function queue_dept(value){$('body').removeClass('loaded');var myForm2='<form id="hidfrm2" action="http://tokenq.justlabtech.com/queue" method="post"><input type="hidden" name="_token" value="P2xgryCwJGgmbgz5Zz5JCxOcah4gP9pahysN8PDQ"><input type="hidden" name="department" value="'+value+'"></form>';$('body').append(myForm2);myForm2=$('#hidfrm2');myForm2.submit();}</script>
<div class="hiddendiv common"></div>

</body></html>
<?php
mysql_free_result($rstransacon);

mysql_free_result($rstransacfin);
?>
