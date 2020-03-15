<?php
	$page_title = 'Search results';
	$additional_css = '';
	include('header.php');
	include('archive-movie.php');
	
	// get every text that has a given string inside
	function search_term ($movie) {
		global $movie_title;
		return (strstr($movie->title, $movie_title));
	}

	if (!isset($_GET)) {
		$error = 404;
	} else if (strlen($_GET['s']) < 3) {
		$error = 'chars';
	} else {
		$error = null;
		$movie_title = ucwords($_GET['s']);
		$movie_list = array_filter($movies, 'search_term');
		if (empty($movie_list))
			$error = 'empty';
		$page_title = $_GET['s'];
	}
?>

<div class="row" style="padding: 75px 0;">
    <!-- movies list -->
    <ul class="left">
		<?php 
			switch ($error) {
			case null: ?>
				<h1 class="title" style="padding-left: 30px;">Search results for "<?php echo $page_title; ?>"</h1>
				<?php 
				foreach ($movie_list as $movie)
					movie_pres($movie, false);
				break;

			case 'empty': ?>
				<h1 style="text-align: center;">Sorry, no results found for "<?php echo $page_title; ?>"</h1>
				<?php
				break;

			case 'chars': ?>
				<h1 style="text-align: center;">Try searching for a term with at least 3 characters.</h2>
				<?php
				break;

			case 404: ?>
				<h1 style="text-align: center;">Please enter a search term.</h1>
		<?php } ?>
	</ul>
</div>
<?php include('footer.php');
