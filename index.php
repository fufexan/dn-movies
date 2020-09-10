<?php

	$page_title = 'Movies';
	require_once 'header.php';
	$nr_movies  = get_nr_items('movies');
	$nr_genres  = get_nr_items('genres');

	usort($movies, 'sort_years');

?>

<article>
	<h1 class="title" style="text-align: center; padding-top: 2em;">
		Hello. We offer you a database containing <?= $nr_movies; ?> movies
		distributed across <?= $nr_genres; ?> genres.
	</h1>

	<div class="c-flex">
		<ul class="i-flex" class="index_pres">
		<h2 class="title" style="text-align: center;
			text-decoration: underline;">Oldest Movies
		</h2>
		<?php

			for ($i = 0; $i < 10; $i++) {
				movie_pres($movies[$i], $max_runtime);
			}

		?>
		</ul>

		<ul class="i-flex">
		<h2 class="title" style="text-align: center;
			text-decoration: underline">Newest Movies
		</h2>
		<?php
	
			for ($i = $nr_movies - 1; $i > $nr_movies - 11; $i--) {
				movie_pres($movies[$i], $max_runtime);
			}

		?>
		</ul>
	</div>
</article>

<?php include 'footer.php';
