<?php

// sorts the actors vector and removes duplicates
function sort_actors($actors) {
	sort($actors);
	$all_actors = array_unique($actors);
	sort($all_actors);
	return $all_actors;
}

// cuts the plot to 100 characters
function cut_plot($plot) {
	$plot = substr($plot, 0, 100) . "...";

	// in some cases the last character of the truncated text is a space
	// looks bad so we cut it
	$plot = str_replace (" ...", "...", $plot);

	return $plot;
}

// formats the runtime from minutes to hours and minutes
function format_runtime($runtime) {
	$hours = floor($runtime / 60);
	$minutes = $runtime % 60;

	if ($minutes < 10)
		$minutes = 0 . $minutes;

	return $hours . ':' . $minutes . ' h';
}

// get a movie's actors as array
function get_actors($movie) {
	return explode (', ' , $movie->actors);
}

// append a movie's actors to all actors list
function append_actors($actors_list, $all_actors) {
	foreach ($actors_list as $current_actor)
		$all_actors[sizeof($all_actors)] = $current_actor;
	return $all_actors;
}

// gets the runtime of the longest film
function get_longest_movie($movies) {
	if (isset($_COOKIE['longest-movie-length'])) {
		$max_runtime = $_COOKIE['longest-movie-length'];
	} else {
		$max_runtime = max(array_column($movies, 'runtime'));
		setcookie('longest-movie-length', $max_runtime);
	}
	return $max_runtime;
}

// compares two years
function sort_years($a, $b) {
	if ($a->year == $b->year)
		return 0;
	elseif ($a->year > $b->year)
		return 1;
	else
		return -1;
}

// counts the number of items of a specific type
function get_nr_items($type) {
	$base_db = 'https://raw.githubusercontent.com/yegor-sytnyk/movies-list'
		. '/master/db.json';
	return count(json_decode(file_get_contents($base_db))->$type);
}

//
// MySQL functions
//

// returns a mysqli connection with defaults
function db_connect(
	$host = 'localhost',
	$user = 'php_user',
	$pass = '',
	$database = 'movies_ratings') {

	return mysqli_connect($host, $user, $pass, $database);
}

// check if a table is present and create it if nonexistent
function check_table($id) {
	$db = db_connect();
	$query = "
			SELECT * 
			FROM information_schema.tables
			WHERE table_schema = 'movies_ratings'
			    AND table_name = '$id'
			LIMIT 1;
	";

	if (mysqli_query($db, $query)->num_rows == 0) {
		$query = "CREATE TABLE `movies_ratings`.`$id`
				(`#`     INT  NOT NULL AUTO_INCREMENT,
				`rating` INT  NOT NULL,
				`date`   DATE NOT NULL,
				PRIMARY KEY (`#`));
		";

		mysqli_query($db, $query);
	}

	mysqli_close($db);
}

// set new rating for a movie
function set_rating($id, $rating) {
	$db = db_connect();
	$date = date('Y-m-d');
	$query = "INSERT INTO `movies_ratings`.`$id` (`rating`, `date`)
			VALUES ($rating, DATE '$date');
	";

	check_table($id);
	mysqli_query($db, $query);

	mysqli_close($db);
}

// return the average rating of a movie
function get_rating($id) {
	$db = db_connect();
	$query = "SELECT AVG(`rating`) AS `average` from `movies_ratings`.`$id`;";

	// get result and close db
	$result = mysqli_query($db, $query);
	mysqli_close($db);

	// refine result
	if ($result) {
		$result = mysqli_fetch_assoc($result);
		$result = intval($result['average']);
	}

	return $result;
}
