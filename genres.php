<?php 
	$page_title = 'Genres';
	$additional_css = 'genres.css';
	require_once('header.php');
	$genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;

	sort($genres);
?>
<div class="genres" style="padding-top: 75px;">
	<ul>
		<?php 
			foreach ($genres as $genre) {
		?>
		<li style="background-color: #c0da<?php echo rand(10, 99); ?>">
			<a href="archive.php?genre=<?php echo $genre; ?>"><?php echo $genre; ?></a>
		</li>
		<?php
			}
		?>
	</ul>
</div>
<?php include_once('footer.php'); ?>