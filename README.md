# imdb-getter-php
Library to crawling movie's information from IMDB

<b>USAGE</b>:

    include 'imdb_getter.php';
    $imdb = new imdb_getter('http://www.imdb.com/title/tt2179136/?ref_=hm_cht_t0');
    $imdb->exec();

Then you can extract data from $imdb by following way:

    $imdb->get_title(); // to get movie's title
    $imdb->get_year(); // to get movie's produced year (little buggy)
    $imdb->get_thumb(); // to get movie's thumbnail as url
    // etc ...
    $imdb->get_gerne();
    $imdb->get_category();
    $imdb->get_duration();
    $imdb->get_director();
    $imdb->get_actor();
    $imdb->get_rate(); // rating score
    // Saving thumbnail
    // It will save thumbnail to this path: ../img/
    // some arugements will be added later
    $imdb->save_thumbnail();
