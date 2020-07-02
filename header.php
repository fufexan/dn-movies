<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="inc/css/style.css">
	<?php if( isset($moar_css) ) { ?>
    	<link rel="stylesheet" type="text/css" href="inc/css/<?php echo $moar_css; ?>">
	<?php } ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	<?php
	$genre = "";
	require('functions.php');
	require('presentation.php');
	
	$movies = json_decode( file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json') )->movies;
	$genres = json_decode( file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json') )->genres;

	// placeholder if a poster can't be loaded
    $alt_poster = 'inc/img/placeholder.png';
	$max_runtime = get_longest_movie($movies);

	?>
</head>
<body>
    <header>
      <img src="inc/img/logo.svg" alt="" class="logo">
        <a href="index.php">Home</a>
        <a href="archive.php">Movies</a>
        <a href="genres.php">Genres</a>
        <form action="search-results.php">
		<input type="text" name="s" placeholder="Search movies"><input type="submit" value="&#x1F50D;">
        </form>
	</header>

