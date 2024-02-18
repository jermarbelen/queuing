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

mysql_select_db($database_connection, $connection);
$query_rstransac = "SELECT * FROM trasaction_tb ORDER BY transaction_id DESC";
$rstransac = mysql_query($query_rstransac, $connection) or die(mysql_error());
$row_rstransac = mysql_fetch_assoc($rstransac);
$totalRows_rstransac = mysql_num_rows($rstransac);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print</title>

<!-- Change redirect time: content="20 -->
<meta http-equiv="refresh" content="20;URL='index.php'" />

<link href="assets/A.css%2c%2c_materialize.min.css%2bjs%2c%2c_plugins%2c%2c_perfect-scrollbar%2c%2c_perfect-scrollbar.css%2cMcc.Mf0aw0Oa_F.css.pagespeed.cf.Ge_QCEjHhJ.css" type="text/css" rel=stylesheet media="screen,projection"/>
<style>.btn-queue{padding:25px;font-size:47px;line-height:36px;height:auto;margin:10px;letter-spacing:0;text-transform:none}</style>
<link href="assets/css/A.style.min.css.pagespeed.cf.mJfUwXhfzO.css" type="text/css" rel=stylesheet media="screen,projection">
</head>

<body>
<table width="200" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td>
    <div class="card-panel center-align" style="margin-bottom:0">

<span style="font-size:45px">TRANSACTION NO.</span><br>

<span id="num0" style="font-size:100px;color:red;font-weight:bold;line-height:1.5"><?php echo $row_rstransac['transaction_id']; ?></span><br>

<span style="text-transform:uppercase;font-size:40px"><?php echo $row_rstransac['trasaction_type']; ?></span><br>

<span id="cou0" style="text-transform:uppercase;font-size:80px; color:red;line-height:1.5"><?php echo $row_rstransac['counter']; ?></span><br />

<!-- <a href="javascript:window.print()"><button>PRINT</button></a> |--> <a href="index.php"><button>FINISH</button></a>
    
    </div>
    </td>
  </tr>
</table>



</body>
</html>
<?php
mysql_free_result($rstransac);
?>
