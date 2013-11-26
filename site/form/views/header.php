<!doctype html>
<html lang="is">
	<head>
		<meta charset="utf-8">
		<title>Viðburðir</title>
		<link rel="stylesheet" href="uppskriftin.css">
	</head>
	<body>
		<div id="big_wrapper">
			<img id="cImg"src="myndir/cover.jpg" alt="Kökuklúbburinn covermynd" ></img>
			
			<h1>Leggðu inn þína uppáhalds uppskrift</h1>
			<h2>og njóttu þess að taka út margfalt tilbaka!</h2>

			<?php
			// þessi breyta er sett ef við bættum við nýjum viðburð
			if (isset($_GET['success']) && $_GET['success'] === 'true'): ?>
				<p class="success">Viðburði bætt við!</p>
			<?php endif; ?>



