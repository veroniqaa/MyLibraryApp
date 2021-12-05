<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta http-equiv="content-language" content="pl" />
			<title> MyLibraryApp </title>
		<meta name="description" content="Moja internetowa biblioteka." />
		<link rel="shortcut icon" href="img/book.png" />
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<link href='http://fonts.googleapis.com/css?family=Grandstander&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>

<body>
    <div id="container">
        <div id="header">
			<div id="naglowek_tekst">
				<a href="myBooks.php"><p> My Library App</p> </a>
			</div> 
        </div>
		
		<?php 
		if ((isset($_SESSION['loggedInId'])) && ($_SESSION['loggedInId']==true)) {
			include('interface/menu.php'); 
		}?>
		
		<div id="content">
	
