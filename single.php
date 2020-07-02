<?php
	// movie title
	$page_title = reset($_GET);

	require_once('header.php');

	// search movies for matching title
	foreach ($movies as $current_movie) {
		if ($current_movie->title == $page_title)
			$movie = $current_movie; 
	}

	// if no movie is found, make the page a 404
	if (!isset($movie)) {
		$movie_title = "Page Not Found";
		include('404.php');
	}
?>

<div class="maindiv container" style="padding-top: 70px;">
	<?php // not found page ?>
	<?php if (!isset($movie)) { ?>
		<div style="text-align: center; margin: 0 auto;">
			<h1>Sorry, this page doesn't exist.<h1>
			<a href="archive.php">Return to archive</a>
		<div>

	<?php // normal page ?>
	<?php } else { ?>
	
	<div class="c-flex">
		<?php // display the poster or a placeholder if the poster is unavailable ?>
		<img src="<?php echo $movie->posterUrl; ?>" onerror="this.src='<?php echo $alt_poster; ?>'" alt="" class="i-flex poster">

		<?php // info about current movie ?>
		<div class="i-flex">
			<h2 class="title">
				<?php echo $movie->title; ?>
			</h2>

			<?php // rating display ?>
			<div class="rating-display">
				<div class="rating-display-top" style="width: <?php //echo get_rating($id) * 20; ?>65%">
					<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
				</div>
				<div class="rating-display-bottom">
					<span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
				</div>
			</div>
			<?php // year ?>
			<p>
				<?php if ($movie->year >= 2010) {
						echo "<b>$movie->year</b>";
					} else {
						echo $movie->year;
					}
				?>
			</p><br>
			<?php // progress bar ?>
			<div class="meter">
				<span style="width:<?php echo floor($movie->runtime * 100 / $max_runtime); ?>%"></span>
			</div>

			<?php // movie duration ?>
			<p>Runtime <?php echo format_runtime($movie->runtime); ?></p>
			<br>
			
			<?php // plot ?>
			<p class="plot"><?php echo $movie->plot; ?></p>
			<br>

			<?php // display genres ?>
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

			<?php // make an ordered list with the actors of the movie ?>
			<p>
				Actors:
				<?php $actors = explode( ',' , $movie->actors ); ?>
				<ol><?php
					foreach ( $actors as $actor ) { ?>
						<li>
							<?php echo $actor ?>
						</li><?php
					} ?>
				</ol>
			</p>

			<?php // director ?>
			<?php if( $movie->director != 'N/A' ) { ?>
				<p>Director: <?php echo $movie->director; ?></p>
			<?php } ?>

			<?php // rating system ?>
			<div class="stars">
			  <form action="">
				<input class="star star-5" id="star-5" type="radio" name="star"/>
				<label class="star star-5" for="star-5"></label>
				<input class="star star-4" id="star-4" type="radio" name="star"/>
				<label class="star star-4" for="star-4"></label>
				<input class="star star-3" id="star-3" type="radio" name="star"/>
				<label class="star star-3" for="star-3"></label>
				<input class="star star-2" id="star-2" type="radio" name="star"/>
				<label class="star star-2" for="star-2"></label>
				<input class="star star-1" id="star-1" type="radio" name="star"/>
				<label class="star star-1" for="star-1"></label>
				<button class="send-rating" type="submit" formmethod="POST">Okay!</button>
			  </form>
			</div>
		</div>
	</div>
	<?php } ?>
</div>
<?php include_once('footer.php');
