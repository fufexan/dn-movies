<?php
	$page_title = 'Search results';
	$additional_css = '';
	include('header.php');
	
	// get every text that has a given string inside
	function search_term ($movie) {
		return strstr($movie->title, $_GET['s']);
	}

	if (!isset($_GET)) {
		// TODO: page not found
	} else {
		$i = -1;
		foreach ($movies as $movie)
			if (array_filter($movies, 'search_term'))
				$movie_list[++$i] = $movie->id;
		$page_title = 'Search results for "' . $_GET['s'] . '"';
	}
?>

<div class="row" style="padding: 75px 0;">
    <!-- movies list -->
    <ul class="left">
     	<?php
        	if (isset($movie_list)) { ?>
          		<h1 class="title" style="padding-left: 30px;"><?php echo $page_title; ?></h1>
      	<?php    
    			foreach ($movie_list as $id) {
            		$movie = $movies[$id];
            		movie_pres($movie, true);
        		}
			}
		?>
	</ul>
</div>
<?php include('footer.php');