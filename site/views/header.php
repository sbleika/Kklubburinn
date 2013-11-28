<!doctype html>
<html lang="is">
	<head>
		<meta charset="utf-8">
		<title>Skráning</title>
		<link rel="stylesheet" href="undirsidur.css">
	</head>
	<body>
		<div id="under_wrapper">

			<div id="picture">
			</div>

			
			<nav id="menu">
				<ul>
					<li><a href="index.html">Heim</a><li>
					<li><a href="undir_uppskriftir.php">Uppskriftir</a></li>
					<li><a href="skraning.php">Skráning</a></li>
				</ul>
			</nav>

			<div id="hgroup">
			<h1>Leggðu inn þína uppáhalds uppskrift</h1>
			<h2>og njóttu þess að taka út margfalt tilbaka!</h2>
			</div>

			<?php
			// þessi breyta er sett ef við bættum við nýjum viðburð
			if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
				<p class="success">Yes það tókst. Þú hefur lagt inn í Kökubankann!</p>
			<?php endif; ?>



