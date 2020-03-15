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

// get a movie's actors as array
function get_actors ($movie) {
	return explode(', ' , $movie->actors);
}

// append a movie's actors to all actors list
function append_actors ($actors_list, $all_actors) {
	foreach ($actors_list as $current_actor)
		$all_actors[sizeof($all_actors)] = $current_actor;
	return $all_actors;
}

// gets the runtime of the longest film
function longest_movie ($movies) {
	if (isset($_COOKIE['longest-movie-length'])) {
		$max_runtime = $_COOKIE['longest-movie-length'];
	} else {
		$max_runtime = max(array_column($movies, 'runtime'));
		setcookie('longest-movie-length', $max_runtime);
	}
	return $max_runtime;
}

function year_sort ($a, $b) {
	if ($a->year == $b->year)
		return 0;
	else if ($a->year > $b->year)
		return 1;
	else
		return -1;
}

?>
