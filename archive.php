<?php

	$page_title = 'Archive';
	$all_actors = array();
	require_once 'header.php';

	function is_in_genre ($var) {
		return ($var == $_GET['genre']);
	}

	if (isset($_GET['genre'])) {
		$i = -1;
		$movie_list = [];

		foreach($movies as $movie) {
			if(array_filter($movie->genres, 'is_in_genre'))
				$movie_list[++$i] = $movie->id;
		}

		$page_title = $_GET['genre'] . ' Movies';
	}

?>

<?php } ?>


<div class="row" style="padding: 75px 0;">
	<?php // movies list ?>
	<ul class="left">
		<?php
			if (isset($movie_list)) { ?>
				<h1 class="title" style="padding-left: 30px;"><?= $page_title; ?></h1>
		<?php
				foreach ($movie_list as $id) {
					$movie = $movies[$id];
					movie_pres($movie, $max_runtime, true);
					$all_actors = append_actors(get_actors($movie), $all_actors);
				}
			} else {
			foreach ($movies as $movie) {
				movie_pres ($movie, $max_runtime);
				$all_actors = append_actors (get_actors($movie), $all_actors);
			}} ?>
	</ul>
	<!-- actors column -->
	<div class="right">
		<ul>
		<?php
			$all_actors = sort_actors($all_actors);
			foreach ($all_actors as $current_actor)
				echo "<li>$current_actor</li>";
		?>
		</ul>
	</div>
</div>

<?php include 'footer.php'; ?>
