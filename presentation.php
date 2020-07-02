<?php

function movie_pres ($movie, $max_runtime, $is_single = false, $placeholder = 'inc/img/placeholder.png') { ?>
	<li class="c-flex">
		<?php // display the poster or a placeholder if the poster is unavailable ?>
		<img src="<?php echo $movie->posterUrl; ?>" onerror="this.src='<?php echo $placeholder; ?>'" alt="" class="i-flex poster">
		<?php // info about current movie ?>
		<div class="i-flex">
			<a class="titlelink" href="single.php?title=<?php echo $movie->title; ?>"><h2 class="title"><?php echo $movie->title; ?></h2></a>
			<p><?php
				if ($movie->year >= 2010) {
					echo "<b>$movie->year</b>";
				} else {
					echo $movie->year;
				}?>
			</p><br>

			<?php // progress bar ?>
			<div class="meter">
				<span style="width:<?php echo floor($movie->runtime * 100 / $max_runtime); ?>%"></span>
			</div>

			<?php // movie duration ?>
			<p>Runtime <?php echo format_runtime($movie->runtime); ?></p><br>
			<?php
			if (!$is_single) { ?>
				<?php // if plot is longer than 100 characters, truncate it to 100 and append "..." ?>
				<p class="plot">
				<?php
					$plot = $movie->plot;
					if (strlen($plot) > 100)
						echo cut_plot($plot);
					else
						echo $plot;?>
				</p><br>
			<?php } else {
				// idk what i was supposed to do here.
				// will come back to this
			} ?>
		</div>
	</li>
<?php } ?>
