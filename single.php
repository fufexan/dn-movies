<?php
	
	// movie title
	$page_title = reset($_GET);

	require_once('header.php');
	require_once('archive-movie.php');

	// search movies for matching title
	foreach ($movies as $current_movie) {
		if ($current_movie->title == $page_title)
			$movie = $current_movie; 
	}

	// if no movie is found, make the page a 404
	if (!isset($movie)) {
		$movie_title = "Page Not Found";
	}
	
?>
<div style="padding-top: 70px;">
	<!-- not found page -->
	<?php if (!isset($movie)) { ?>
		<div style="text-align: center; margin: 0 auto;">
			<h1>Sorry, this page doesn't exist.<h1>
			<a href="archive.php">Return to archive</a>
		<div>


	<?php } else { ?>
	
	<!-- normal page -->

	<div class="flex-container">
		<!-- display the poster or a placeholder if the poster is unavailable -->
		<img src="<?php echo $movie->posterUrl; ?>" onerror="this.src='https:\/\/upload.wikimedia.org/wikipedia/commons/c/c2/No_image_poster.png'" alt="" class="flex-item poster">

		<!-- info about current movie -->
		<div class="flex-item">
			<h2 class="title">
				<?php echo $movie->title; ?>
			</h2>

			<!-- rating display -->
			<div class="rating-display">
				<div class="rating-display-top" style="width: <?php //echo get_rating($id) * 20; ?>65%">
					<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
				</div>
				<div class="rating-display-bottom">
					<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
				</div>
			</div>
			
			<!-- year -->
			<p>
				<?php if ($movie->year >= 2010) {
						echo "<b>$movie->year</b>";
					} else {
						echo $movie->year;
					}
				?>
			</p>
			
			<br>
			
			<!-- display a progress bar relative to the longest movie -->
			<progress value="<?php echo $movie->runtime; ?>" max="<?php echo $max_runtime; ?>"></progress>
			<br>

			<!-- movie duration in hours and minutes -->
			<p>Runtime <?php echo runtime_format($movie->runtime); ?></p>
			<br>
			
			<!-- plot -->
			<p class="plot"><?php echo $movie->plot; ?></p>
			<br>

			<!-- display the genres, comma separated -->
			<p>Genres:
				<?php
				$genres = $movie->genres[0];

				for( $i = 1; $i < sizeof( $movie->genres ); $i++ ) {
					$genres .= ', ' . $movie->genres[$i];
				}
				echo $genres;
				?>
			</p>
			<br>

			<!-- make an ordered list with the actors of the movie -->
			<p>
				Actors:
				<?php $actors = explode( ',' , $movie->actors ); ?>
				<ol>
					<?php foreach ( $actors as $actor ) { ?>
					<li>
					<?php echo $actor ?>
					</li>
					<?php } ?>
				</ol>
			</p>

			<!-- director -->
			<?php if ($movie->director != 'N/A') { ?>
				<p>Director: <?php echo $movie->director; ?></p>
			<?php } ?>

			<!-- rating system -->
			
		</div>
	</div>
	<?php } ?>
</div>
<?php include_once('footer.php');
