<?php require_once('../Connections/connection.php'); ?>
<?php require_once('access_global.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE trasaction_tb SET `Client number`=%s, name=%s, trasaction_type=%s, `counter`=%s, called_status=%s, issued_time=%s, called_time=%s, field1=%s, field2=%s, field3=%s, field4=%s, field5=%s WHERE transaction_id=%s",
                       GetSQLValueString($_POST['Client_number'], "text"),
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['trasaction_type'], "text"),
                       GetSQLValueString($_POST['counter'], "text"),
                       GetSQLValueString($_POST['called_status'], "text"),
                       GetSQLValueString($_POST['issued_time'], "date"),
                       GetSQLValueString($_POST['called_time'], "text"),
                       GetSQLValueString($_POST['field1'], "text"),
                       GetSQLValueString($_POST['field2'], "text"),
                       GetSQLValueString($_POST['field3'], "text"),
                       GetSQLValueString($_POST['field4'], "text"),
                       GetSQLValueString($_POST['field5'], "text"),
                       GetSQLValueString($_POST['transaction_id'], "int"));

  mysql_select_db($database_connection, $connection);
  $Result1 = mysql_query($updateSQL, $connection) or die(mysql_error());

  $updateGoTo = "list_transactions.php?called_status=N";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_connection, $connection);
$query_rstransaction = "SELECT * FROM trasaction_tb WHERE transaction_id ='" . $_GET['transaction_id'] . "'";
$rstransaction = mysql_query($query_rstransaction, $connection) or die(mysql_error());
$row_rstransaction = mysql_fetch_assoc($rstransaction);
$totalRows_rstransaction = mysql_num_rows($rstransaction);
?>
<?php require_once('head.php'); ?>
   
<h1>Transaction No.<?php echo $row_rstransaction['transaction_id']; ?></h1>
<p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Go"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Client number:</td>
      <td><input type="text" name="Client_number" value="<?php echo htmlentities($row_rstransaction['transaction_id'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Name:</td>
      <td><input type="text" name="name" value="<?php echo htmlentities($row_rstransaction['name'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Trasaction Type:</td>
      <td><input type="text" name="trasaction_type" value="<?php echo htmlentities($row_rstransaction['trasaction_type'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Status:</td>
      <td><select name="called_status" required>
      	<option value="">Select Status</option>
        <option value=""></option>
        <option value="F">Call</option>
        <option value="H">Hold</option>
        <option value="T">Transffered to other counter</option>
        <option value="M">Missed</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Counter:</td>
      <td><select name="counter" required>
      	<option value="">Select Counter</option>
        <option value=""></option>
        <option value="COUNTER-1">COUNTER-1</option>
        <option value="COUNTER-2">COUNTER-2</option>
        <option value="COUNTER-3">COUNTER-3</option>
      </select></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap align="right">Issued Time:</td>
      <td><input type="text" name="issued_time" value="<?php echo htmlentities($row_rstransaction['issued_time'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Called Time:</td>
      <td><input type="text" name="called_time" value="<?php echo date('Y-m-d H:m:s'); ?>" size="32"></td>
    </tr>
   <tr valign="baseline">
      <td nowrap align="right"><?php
if ($_GET['transaction'] == "APPROVAL") {
    echo "APPROVAL DETAILS";
} elseif ($_GET['transaction'] == "LAND-REQUIREMENTS") {
    echo "LAND-REQUIREMENTS DETAILS";	
} else {
    echo "Describe what transaction";
}
?>:</td>
      <td><input type="text" name="field1" value="<?php echo htmlentities($row_rstransaction['field1'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <!--
    <tr valign="baseline">
      <td nowrap align="right"><?php
if ($_GET['transaction'] == "APPROVAL") {
    echo "APPROVAL Description";
} elseif ($_GET['transaction'] == "LAND-REQUIREMENTS") {
    echo "LAND-REQUIREMENTS Description";	
} else {
    echo "Description";
}
?>:</td>
      <td><input type="text" name="field2" value="<?php echo htmlentities($row_rstransaction['field2'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right"><?php
if ($_GET['transaction'] == "APPROVAL") {
    echo "APPROVAL Others";
} elseif ($_GET['transaction'] == "LAND-REQUIREMENTS") {
    echo "LAND-REQUIREMENTS Others";	
} else {
    echo "Others";
}
?>:</td>
      <td><input type="text" name="field3" value="<?php echo htmlentities($row_rstransaction['field3'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Field4:</td>
      <td><input type="text" name="field4" value="<?php echo htmlentities($row_rstransaction['field4'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Field5:</td>
      <td><input type="text" name="field5" value="<?php echo htmlentities($row_rstransaction['field5'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
    </tr>-->
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Go"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="transaction_id" value="<?php echo $row_rstransaction['transaction_id']; ?>">
</form>
</p>


<?php require_once('footer.php'); ?>
<?php
mysql_free_result($rstransaction);
?>
