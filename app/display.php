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

$maxRows_rstransacon = 6;
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
<!doctype html>
<html>
<head>
    <title>Queue Management System</title>
	<link href="css/styles.css" rel="stylesheet">
<script type="text/javascript" src="//code.jquery.com/jquery-1.10.1.js"></script>
<script type="text/javascript">
$(window).load(function(){

var auto_refresh = setInterval(function () {
    $('.refresh').fadeOut('slow', function() {
        $(this).load('/echo/json/', function() {
            $(this).fadeIn('slow');
        });
    });
}, 5000); // refresh every 15000 milliseconds

});

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
</script>
</head>
<body onload="startTime()">
	<div class="container">
		<div id="left-side">
<iframe width="950px" height="660px" src="https://www.youtube.com/embed/?listType=playlist&list=PLGdTIBB1FcmPGyKvWGkuhmfd8aZyQWpxm" frameborder="0" allowfullscreen>
</iframe>
<hr/>
<p align="center"><b>DENR MIMAROPA QUEUING SYSTEM:</b>
A project by Surveys and Mapping Division trough Regional Information and Comunications Unit and Regional Public Affairs Office. Copyright 2017-<?php echo date('Y'); ?></p>
		</div>
		<div id="right" class="refresh">
			
			<div id="column1">
				<h1>NOW SERVING</h1>
			</div>
				<hr color="white">
			<div id="column2">
				<div id="sample">
					<h1><?php echo $row_rstransacfin['transaction_id']; ?> <?php //echo $row_rstransacfin['name']; ?></h1>
				</div>
				<hr color="white">
				<div id="sampol">
					<h1><?php echo $row_rstransacfin['counter']; ?></h1>
				</div>
			</div>
			
			<hr color="white">
			
			<div id="next">
				<h1>NEXT IN LINE</h1>
			</div>
			<hr color="white">
            <!--list of Ongoing Transaction -->
            <?php do { ?>
			<div id="column3">
				<div class="text1">
					<h1><?php echo $row_rstransacon['transaction_id']; ?> <?php //echo $row_rstransacon['name']; ?></h1>
				</div>
				<hr color="white">
				<div class="text2">
					<h1><?php echo $row_rstransacon['trasaction_type']; ?></h1>
				</div>
				<hr color="white">
			</div>
			<?php } while ($row_rstransacon = mysql_fetch_assoc($rstransacon)); ?>
<!-- END -->

			
		</div>
		<div id="footer">
			<div id="wan">
				<div id="tri">
					<h4><?php echo date('l'); ?></h4>
				</div>
				<div id="por">
					<h4><div id="txt"></div></h4>
				</div>
			</div>
			<div class="tu">
				<h3>If your number does not appear on this screen please ask the information officer | Tel.(02)755-3300 local 2713</h3>
			</div>
		</div>
	</div>
</body>
</html>
<?php
mysql_free_result($rstransacon);

mysql_free_result($rstransacfin);
?>