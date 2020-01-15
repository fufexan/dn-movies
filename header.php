<!DOCTYPE html>
<html lang="en">
	<head>
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $additional_css; ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <?php  
    $genre = "";
    include_once('functions.php');
	  $movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;

	  // placeholder if a poster can't be loaded
    $poster_placeholder = "https://upload.wikimedia.org/wikipedia/commons/c/c2/No_image_poster.png";
    
    // verify if cookie is set, else create one
    if (isset($_COOKIE['longest-movie-length'])) {
      $max_runtime = $_COOKIE['longest-movie-length'];
    } else {
      require_once('longest-movie.php');
      $max_runtime = longestMovie($movies);
      setcookie('longest-movie-length', $max_runtime);
    }

	?>
	</head>
	<body>
    <header>
      <img src="images/logo.png" alt="" class="logo">
        <a href="index.php">Home</a>
        <a href="archive.php">Movies</a>
        <a href="genres.php">Genres</a>
        <form action="search-results.php">
			<input type="text" name="q" placeholder="Search movies"><input type="submit" value="&#x1F50D;">
        </form>
    </header>

