<?php 
	$page_title = 'Genres';
	$moar_css = 'genres.css';
	require_once('header.php');
	$genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;

	sort($genres);
?>
<div class="c-flex" style="padding-top: 70px;">
	<?php foreach ($genres as $genre) { ?>
		<a href="archive.php?genre=<?= $genre; ?>" class="genres" style="background-color: <?php //echo $rand_color('c1ba'); ?>#eea9<?= rand(10, 99); ?>" ><?= $genre; ?></a>
	<?php } ?>
</div>

<?php include_once('footer.php');
