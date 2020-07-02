<?php
  $page_title = 'Archive';
  $all_actors = array();
  require_once('header.php');
  require('archive-movie.php');

/*
37. În fișierul genres.php, la click pe fiecare gen de film, link-ul ar trebui să ducă spre fișierul archive.php (același unde listăm TOATE filmele) care să aibă parametrul $_GET cu numele genului de film. Iar pe pagina de arhivă să se afișeze doar filmele din acest gen. Pentru asta folosiți funcția array_filter() (citiți ce face aceasta și încercați să o folosiți corect).

38. La început de fișier archive.php, dacă este filtrat vreun gen de film, afișați un titlu mare H1 în care să fie scris: Filme din genul: *denumire gen film*
*/

function is_in_genre ($var) {
	return ($var == $_GET['genre']);
}

if( isset( $_GET[ 'genre' ] ) ) {
  $i = -1;
  $movie_list = [];
  foreach( $movies as $movie ) {
    if( array_filter( $movie->genres, 'is_in_genre' ) )
      $movie_list[ ++$i ] = $movie->id;
  }
  $page_title = $_GET['genre'] . ' Movies';
  ?>
  
<?php } ?>


  <div class="row" style="padding: 75px 0;">
    <!-- movies list -->
    <ul class="left">
      <?php
        if( isset( $movie_list ) ) { ?>
          <h1 class="title" style="padding-left: 30px;"><?php echo $page_title; ?></h1>
      <?php    
          foreach( $movie_list as $id ) {
            $movie = $movies[ $id ];
            movie_pres( $movie, true );
            $all_actors = append_actors( get_actors($movie), $all_actors );
          }
        } else {
        foreach( $movies as $movie ) {
          movie_pres( $movie );
          $all_actors = append_actors( get_actors($movie), $all_actors );
        }} ?>
    </ul>
    
    <!-- actors column -->
    <div class="right">
      <ul>
      <?php
        $all_actors = sort_actors($all_actors);
        //echo '<pre>' . print_r($all_actors) . '</pre>';
        foreach( $all_actors as $current_actor )
          echo "<li>$current_actor</li>";
      ?>
      </ul>
    </div>
  </div>
<?php include('footer.php'); ?>
