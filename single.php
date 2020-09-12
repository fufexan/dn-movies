<?php

	// movie title
	$page_title = reset($_GET);

	require_once 'header.php';

	// search movies for matching title
	foreach ($movies as $current_movie) {
		if ($current_movie->title == $page_title)
			$movie = $current_movie; 
	}

	// if no movie is found, make the page a 404
	if (!isset($movie)) {
		$movie_title = "Page Not Found";
		include '404.php';
	}
	
	// update rating if user has submitted a rating
	if (isset($_POST['star'])) {
		set_rating($movie->id, $_POST['star']);
		reset($_POST);
	}

	$rating = get_rating($movie->id);

?>

<article>
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
		<img src="<?= $movie->posterUrl; ?>" onerror="img_err(this)" alt=""
			class="i-flex poster">

		<?php // info about current movie ?>
		<div class="i-flex">
			<h2 class="title">
				<?= $movie->title; ?>
			</h2>

			<?php // rating display ?>
			<div class="rating-display">
				<div class="rating-display-top"
					style="width: <?= $rating * 20; ?>%;">
				<?php
					for($i = 0; $i < 5; $i++)
						echo '<span>★</span>';
				?>
				</div>

				<div class="rating-display-bottom">
				<?php
					for($i = 0; $i < 5; $i++)
						echo '<span>★</span>';
				?>
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
				<span style="width:<?= floor($movie->runtime * 100 / $max_runtime); ?>%"></span>
			</div>

			<?php // movie duration ?>
			<p>Runtime <?= format_runtime($movie->runtime); ?></p>
			<br>
			
			<?php // plot ?>
			<p class="plot"><?= $movie->plot; ?></p>
			<br>

			<?php // display genres ?>
			<p>Genres:
				<?php
				$genres = $movie->genres[0];

				for ($i = 1; $i < sizeof($movie->genres); $i++) {
					$genres .= ', ' . $movie->genres[$i];
				}
				echo $genres;
				?>
			</p>
			<br>

			<?php // make an ordered list with the actors of the movie ?>
			<p>
				Actors:
				<?php $actors = explode(',' , $movie->actors); ?>

				<ol>
					<?php foreach ($actors as $actor) { ?>
						<li><?= $actor ?></li>
					<?php } ?>
				</ol>
			</p>

			<?php // director ?>
			<?php if ($movie->director != 'N/A') { ?>
				<p>Director: <?= $movie->director; ?></p>
			<?php } ?>

			<?php // rating system ?>
			<div id="rating-system" class="stars">
				<form action="">
					<input class="star star-5" id="s5" type="radio" name="star" value="5"/>
					<label class="star star-5" for="s5"></label>
					<input class="star star-4" id="s4" type="radio" name="star" value="4"/>
					<label class="star star-4" for="s4"></label>
					<input class="star star-3" id="s3" type="radio" name="star" value="3"/>
					<label class="star star-3" for="s3"></label>
					<input class="star star-2" id="s2" type="radio" name="star" value="2"/>
					<label class="star star-2" for="s2"></label>
					<input class="star star-1" id="s1" type="radio" name="star" value="1"/>
					<label class="star star-1" for="s1"></label>
					<button class="send-rating" type="submit" formmethod="POST">Okay!</button>
				</form>
			</div>
		</div>
	</div>
	<?php } ?>
</article>

<?php include_once('footer.php');
