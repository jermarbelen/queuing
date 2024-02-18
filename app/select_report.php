<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SELECT REPORT</title>
</head>

<body>
<h2>Select Report</h2>
<form action="print_report.php">
	Form: <select name="trasaction_type">
    	<option value="APPROVAL">APPROVAL</option>
        <option value="LAND-REQUIREMENTS">LAND-REQUIREMENTS</option>
        <option value="OTHER-TRANSACTION">OTHER-TRANSACTION</option>

    </select><br />
    Date: <input type="text" name="called_time" value="<?php echo $_GET['called_time']; ?>"  /><br />
    <input type="submit" value="Continue" />
</form>
</body>
</html>