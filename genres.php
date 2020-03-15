<?php 
	$page_title = 'Genres';
	$additional_css = 'genres.css';
	require_once('header.php');
	$genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;

	sort($genres);
?>
<div class="flex-container" style="padding-top: 75px;">
	<?php 
		foreach ($genres as $genre) {
	?>
			<a href="archive.php?genre=<?php echo $genre; ?>" class="genres" style="background-color: #c0da<?php echo rand(10, 99); ?>" ><?php echo $genre; ?></a>
	<?php
		}
	?>
</div>
<?php include_once('footer.php'); ?>
