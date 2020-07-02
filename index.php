<?php 
	$page_title = 'Movies';
	$additional_css = '';
	require_once('header.php');
	$nr_movies = count($movies);
	$nr_genres = count(json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres);

	usort($movies, 'sort_year');
?>
<article>
	<h1 class="title" style="text-align: center;">Hello. We present you a database containing <?php echo $nr_movies; ?> movies distributed across <?php echo $nr_genres; ?> genres.</h1>
	<div class="c-flex">
		<ul class="i-flex" class="index_pres">
		<h2 class="title" style="text-align: center;">Oldest Movies</h2>
		<?php
			for ($i = 0; $i < 10; $i++) {
				movie_pres($movies[$i], $max_runtime);
			}
		?>
		</ul>
		<ul class="i-flex">
		<h2 class="title" style="text-align: center;">Newest Movies</h2>
		<?php
			for ($i = $nr_movies - 1; $i > $nr_movies - 11; $i--) {
				movie_pres($movies[$i], $max_runtime);
			}
		?>
		</ul>
	</div>
</article>
<?php
	include('footer.php');
?>
