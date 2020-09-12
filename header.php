<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $page_title; ?></title>

	<link rel="stylesheet" type="text/css" href="inc/css/style.css">

	<?php if (isset($moar_css)) { ?>
		<link rel="stylesheet" type="text/css" href="inc/css/<?=$moar_css; ?>">
	<?php } ?>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<script src="inc/js/main.js"></script>

	<?php

		$genre = "";
		require 'functions.php';
		require 'presentation.php';
		
		$main_db = file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json');

		$movies = json_decode($main_db)->movies;
		$genres = json_decode($main_db)->genres;

		// placeholder if a poster can't be loaded
		$alt_poster = 'inc/img/placeholder.png';
		$max_runtime = get_longest_movie($movies);

	?>
</head>
<body>
	<header style="/**/ display: none /**/">
		<img src="inc/img/logo.svg" alt="Movies" class="logo">

		<a href="index.php">Home</a>
		<a href="archive.php">Movies</a>
		<a href="genres.php">Genres</a>
		<a href="contact.php">Contact</a>

		<form action="search-results.php">
			<input type="text" name="s" placeholder="Search movies"><input type="submit" value="&#x1F50D;">
		</form>
	</header>

