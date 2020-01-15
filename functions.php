<?php

$poster_placeholder = "https://upload.wikimedia.org/wikipedia/commons/c/c2/No_image_poster.png";

// sorts the actors vector and removes duplicates
function sort_actors ($actors) {
	sort($actors);
	$all_actors = array_unique($actors);
	sort($all_actors);
	return $all_actors;
}

// cuts the plot to 100 characters
function plot_cut ($plot) {
	$plot = substr($plot, 0, 100) . "...";

	// in some cases the last character of the truncated text is a space. looks bad so we cut it
	if ($plot[99] == ' ') {
		$plot = str_replace( " ...", "...", $plot );
	}
	return $plot;
}

// formats the runtime from minutes to hours and minutes
function runtime_format ($runtime) {
	$hours = floor($runtime / 60);
	$minutes = $runtime % 60;

	if ($minutes < 10)
		$minutes = 0 . $minutes;

	return $hours . ':' . $minutes . ' h';
}

// returns true if the provided variable is the genre supplied (by _GET)
//function is_in_genre ($var) {
//	return ($var == $_COOKIE['genre']);
//}

// function to get a movie's actors as array
function get_actors ($movie) {
	return explode(', ' , $movie->actors);
}

// function to append a movie's actors to all actors list
function append_actors ($actors_list, $all_actors) {
	foreach ($actors_list as $current_actor)
		$all_actors[sizeof($all_actors)] = $current_actor;
	return $all_actors;
}

function movie_pres ($movie, $is_archive = false) { ?>
	<li class="flex-container">
		<!-- display the poster or a placeholder if the poster is unavailable -->
		<img src="<?php echo $movie->posterUrl; ?>" onerror="this.src='https:\/\/upload.wikimedia.org/wikipedia/commons/c/c2/No_image_poster.png'" alt="" class="flex-item poster">

		<!-- info about current movie -->
		<div class="flex-item">
			<h2 class="title">
				<?php echo $movie->title; ?>
			</h2>
			
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
			<progress value="<?php echo $movie->runtime; ?>" max="<?php echo $_COOKIE['longest-movie-length']; ?>"></progress>
			<br>

			<!-- movie duration in hours and minutes -->
			<p>Runtime <?php echo runtime_format($movie->runtime); ?></p>
			<br>

			<?php
				if ($is_archive) { ?>
					<!-- if plot is longer than 100 characters, truncate it to 100 and append "..." -->
					<p class="plot">
					<?php
						$plot = $movie->plot;
						if (strlen($plot) > 100)
						echo plot_cut($plot);
						else
						echo $plot;
					?>
					</p>
					<br>

					<!-- 'More details' button -->
					<form action="single.php" method="get">
						<button type="submit" name="title" value="<?php echo $movie->title ?>">More Details</button>
					</form>
					<br><br>
			<?php	} ?>
		</div>
	</li>


<?php } ?>