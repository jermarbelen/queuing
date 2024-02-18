<?php require_once('../Connections/connection.php'); ?>
<?php require_once('access_global.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>COUNTER</title>
<meta name="description" content="Simple Responsive is a for responsive web design. Mobile first, responsive grid layout, toggle menu, navigation bar with unlimited drop downs, responsive slideshow">
<meta name="keywords" content="">

<!-- Mobile viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">

</head>

<body id="home">

  
<!-- header area -->
    <header class="wrapper clearfix">
		       
        <div id="banner">        
        	<div id="logo"><a href="colorblocks.html"><img src="images/colorblocks-logo.png" alt="logo"></a></div> 
        </div>
        
        <!-- main navigation -->
        <nav id="topnav" role="navigation">
        <div class="menu-toggle">Menu</div>  
        	<ul class="srt-menu" id="menu-main-navigation">
            <li class="current"><a href="home.php">HOME</a></li>
            <li><a href="list_transactions_ongoing.php?counter=<?php echo $_SESSION['MM_Username']; ?>&called_status=N">ON-GOING</a></li>
            <li><a href="list_transactions.php?counter=<?php echo $_SESSION['MM_Username']; ?>&called_status=F">FINISHED</a></li>
            <li><a href="list_transactions.php?counter=<?php echo $_SESSION['MM_Username']; ?>&called_status=H">HOLD</a></li>
            <li><a href="list_transactions.php?counter=<?php echo $_SESSION['MM_Username']; ?>&called_status=M">MISSED</a></li>
			<li>
				<a href="#">REPORT</a>
				<ul>
					<li><a href="select_report.php?called_time=<?php echo date('Y-m-d'); ?>" rel="facebox">Daily</a></li>
                    <li><a href="select_report.php?called_time=<?php echo date('Y-m'); ?>" rel="facebox">Monthly</a></li>
                    <li><a href="select_report.php?called_time=<?php echo date('Y'); ?>" rel="facebox">Annual</a></li>
				</ul>
			</li>
			<li>
				<a href="logout.php">LOGOUT</a>
			</li>
            <!--<li><a href="#">Gallery 3</a>
				<ul>
					<li>
						<a href="#">Gallery 3.1</a>
					</li>
					<li class="current">
						<a href="#">Gallery 3.2</a>
						<ul>
							<li><a href="#">Gallery 3.2.1</a></li>
							<li><a href="#">Gallery 3.2.2 with longer link name</a></li>
							<li><a href="#">Gallery 3.2.3</a></li>
							<li><a href="#">Gallery 3.2.4</a></li>
							<li><a href="#">Gallery 3.2.5</a></li>
						</ul>
					</li>
					<li><a href="#">Gallery 3.3</a></li>
					<li><a href="#">Gallery 3.4</a></li>
				</ul>
			</li>-->
				
		</ul>     
		</nav><!-- #topnav -->
  
    </header><!-- end header -->
 
<!-- main content area -->   
   
<div id="main" class="wrapper clearfix">    

<!-- content area -->    
	<section id="content">