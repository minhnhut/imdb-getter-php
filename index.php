<?php
    include 'imdb_getter.php';
    $imdb = new imdb_getter('http://www.imdb.com/title/tt2179136/?ref_=hm_cht_t0');
    $imdb->exec();
    echo $imdb->get_title();
?>