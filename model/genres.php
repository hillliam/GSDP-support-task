<?php
/**
 * This is our Genres repository - it's pretending to be a database by providing
 * some friendly functions that we can use anywhere we include the genres.php
 * file.
 * 
 * Normally, this would be where you write SQL to talk to a database, but the
 * way the functions are written is a good pratice.
 */

/**
 * This is pretending to be a database, you wouldn't normally have this.
 */
$GLOBALS['database_genres'] = array(
    _aGenre(11001, "Fantasy"),
    _aGenre(11002, "Political"),
    _aGenre(11003, "Other")
);

/**
 * Support function to make it simpler to create genres.
 * 
 * The underscore is just a standard way of saying please don't use this 
 * anywhere else.
 */
function _aGenre($id, $name) {
    return array("id" => $id, "name" => $name);
}

/**
 * This just returns all of the books, but sorts them alphabetically, this would
 * normally happen in the database.
 */
function findAllGenres() {    
    return _queryArray("select * from gernres;");
}

function findGenreByName($name) {
    return _queryOne("select * from gernres where name='$name';");
}


function _queryArray($query) {
    $res = getallgenres();
    
    // Copy the genres over to the array.
    $genres = array();
    while ($row = getrows($res)) {
        array_push($genres, $row);
    }
    return $genres;
}

function _queryOne($query) {
    $connection = connet();
    $res = query($query);
    return getrows($res);
}

function getallgenres()
{
	$sql = "SELECT * FROM gernres";
        $connection = connet();
	$result = query($sql);
	return $result;
}

?>