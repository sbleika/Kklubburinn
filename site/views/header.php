<!doctype html>
<html lang="is">
	<head>
		<meta charset="utf-8">
		<title>Skráning</title>
		<link rel="stylesheet" href="uppskriftin.css">
	</head>
	<body>
		<div id="big_wrapper">

			<div id="picture">
			</div>

			
			<nav id="menu">
				<ul>
					<li><a href="Kokubankinn.html">Heim</a><li>
					<li><a href="undir_uppskriftir.php">Uppskriftir</a></li>
					<li><a href="index.php">Skráning</a></li>
				</ul>
			</nav>

			<h1>Leggðu inn þína uppáhalds uppskrift</h1>
			<h2>og njóttu þess að taka út margfalt tilbaka!</h2>

			<?php
			// þessi breyta er sett ef við bættum við nýjum viðburð
			if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
				<p class="success">Viðburði bætt við!</p>
			<?php endif; ?>



