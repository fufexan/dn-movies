<?php
function longestMovie ($movies) {
	$movies_runtime = array_column($movies, 'runtime');
	$max_runtime = max($movies_runtime);
	return $max_runtime;
}
?>