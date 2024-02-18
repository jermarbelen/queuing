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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Continue</title>
<link rel="stylesheet" href="../assets/pure/base.css" />
<link rel="stylesheet" href="../assets/pure/forms.css" />
</head>

<body>
<center>
<h2>Please fill-out this form</h2>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1"  class="pure-form pure-form-aligned">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Continue" /></td>
    </tr>
  </table>

  <input type="hidden" name="called_time" value="" size="32" />
  <input type="hidden" name="trasaction_type" value="<?php echo $_GET['transaction']; ?>" />
  <input type="hidden" name="counter" value="<?php echo $_GET['counter']; ?>" />
  <input type="hidden" name="called_status" value="N" />
  <input type="hidden" name="name" value="" size="50" placeholder="Optional"  />
  <input type="hidden" name="Client_number" value="" size="50" placeholder="Optional" />
  <input type="hidden" name="field1" value="" size="32" />
  <input type="hidden" name="field2" value="" size="32" />
  <input type="hidden" name="field3" value="" size="32" />
  <input type="hidden" name="field4" value="" size="32" />
  <input type="hidden" name="field5" value="" size="32" />
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</center>
</body>
</html>