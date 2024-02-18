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
$query_rstransactions = "SELECT * FROM trasaction_tb WHERE trasaction_type = '" . $_GET['trasaction_type'] . "' AND called_time LIKE '%" . $_GET['called_time'] . "%' ORDER BY transaction_id ASC";
$rstransactions = mysql_query($query_rstransactions, $connection) or die(mysql_error());
$row_rstransactions = mysql_fetch_assoc($rstransactions);
$totalRows_rstransactions = mysql_num_rows($rstransactions);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PRINT REPORT</title>
</head>

<body>
<h1>SUMMARY REPORT DATED <?php echo $_GET['called_time']; ?></h1>
<table border="1" cellpadding="5" cellspacing="0" width="800px">
  <tr>
    <th>ID</th>
    <th>Client Number</th>
    <th>Name</th>
    <th>Trasaction Type</th>
    <th>Issued Time</th>
    <th>Called Time</th>
    <!--
    <th>Counter</th>
    <th>called_status</th>
    <th>field1</th>
    <th>field2</th>
    <th>field3</th>
    <th>field4</th>
    <th>field5</th>-->
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rstransactions['transaction_id']; ?></td>
      <td><?php echo $row_rstransactions['Client number']; ?></td>
      <td><?php echo $row_rstransactions['name']; ?></td>
      <td><?php echo $row_rstransactions['trasaction_type']; ?></td>
      <td><?php echo $row_rstransactions['issued_time']; ?></td>
      <td><?php echo $row_rstransactions['called_time']; ?></td>
      <!--
      <td><?php echo $row_rstransactions['counter']; ?></td>
      <td><?php echo $row_rstransactions['called_status']; ?></td>
      <td><?php echo $row_rstransactions['field1']; ?></td>
      <td><?php echo $row_rstransactions['field2']; ?></td>
      <td><?php echo $row_rstransactions['field3']; ?></td>
      <td><?php echo $row_rstransactions['field4']; ?></td>
      <td><?php echo $row_rstransactions['field5']; ?></td>-->
    </tr>
    <?php } while ($row_rstransactions = mysql_fetch_assoc($rstransactions)); ?>
</table>
<p><a href="javascript:window.print()"><button>PRINT</button></a></p>
</body>
</html>
<?php
mysql_free_result($rstransactions);
?>
