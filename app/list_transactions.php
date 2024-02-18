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
$query_rstransactions = "SELECT * FROM trasaction_tb WHERE called_status ='" . $_GET['called_status'] . "' ORDER BY transaction_id ASC";
$rstransactions = mysql_query($query_rstransactions, $connection) or die(mysql_error());
$row_rstransactions = mysql_fetch_assoc($rstransactions);
$totalRows_rstransactions = mysql_num_rows($rstransactions);
?>
<?php require_once('head.php'); ?>

<?php if ($totalRows_rstransactions == 0) { // Show if recordset empty ?>
  <h1>NO TRANSACTION ON THIS CATEGORY YET</h1>
<?php } // Show if recordset empty ?>

<?php if ($totalRows_rstransactions > 0) { // Show if recordset not empty ?>
  <h1>DENR</h1>
<table id="example" class="display" cellspacing="0">
<thead>
  <tr>
    <td></td>
    <td>ID</td>
    <td>Client Number</td>
    <td>Name</td>
    <td>Trasaction Type</td>
    <td>Counter</td>
    <td>Called Status</td>
    <td>Issued Time</td>
    <td>Called Time</td>
    <!--<td>field1</td>
    <td>field2</td>
    <td>field3</td>
    <td>field4</td>
    <td>field5</td>-->
  </tr>
  </thead>
  <tbody>
  <?php do { ?>
    <tr>
      <td><a href="edit_transaction.php?transaction_id=<?php echo $row_rstransactions['transaction_id']; ?>&transaction=<?php echo $row_rstransactions['trasaction_type']; ?>">VIEW</a></td>
      <td><?php echo $row_rstransactions['transaction_id']; ?></td>
      <td><?php echo $row_rstransactions['Client number']; ?></td>
      <td><?php echo $row_rstransactions['name']; ?></td>
      <td><?php echo $row_rstransactions['trasaction_type']; ?></td>
      <td><?php echo $row_rstransactions['counter']; ?></td>
      <td><?php echo $row_rstransactions['called_status']; ?></td>
      <td><?php echo $row_rstransactions['issued_time']; ?></td>
      <td><?php echo $row_rstransactions['called_time']; ?></td>
      <!--<td><?php echo $row_rstransactions['field1']; ?></td>
      <td><?php echo $row_rstransactions['field2']; ?></td>
      <td><?php echo $row_rstransactions['field3']; ?></td>
      <td><?php echo $row_rstransactions['field4']; ?></td>
      <td><?php echo $row_rstransactions['field5']; ?></td>-->
    </tr>
    <?php } while ($row_rstransactions = mysql_fetch_assoc($rstransactions)); ?>
    </tbody>
</table>
<?php } // Show if recordset not empty ?>
<?php require_once('footer.php'); ?>
<?php
mysql_free_result($rstransactions);
?>
