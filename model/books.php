<?php
/**
 * This is our Books repository - it's pretending to be a database by providing
 * some friendly functions that we can use anywhere we include the books.php
 * file.
 * 
 * Normally, this would be where you write SQL to talk to a database, but the
 * way the functions are written is a good pratice.
 */

/**
 * Look at where this "global variable" is used, it allows us to automatically
 * generate IDs for our books!
 */
$GLOBALS['database_books_id_seed'] = 10000;

/**
 * This is pretending to be a database, you wouldn't normally have this.
 */
$GLOBALS['database_books'] = array(
    _aBook(11001, "Lord of the Rings", "J.R.R. Tolkien", "A book about a "
            . "Hobbit in Middle Earth, he finds himself in possession of a "
            . "powerful magical ring that must be destroyed. But, the question "
            . "on everyone's mind is how will he do it?", 643, 56, 8.99),
    
    _aBook(11001, "Harry Potter and the Philosopher's Stone", "J.K. Rowling", 
            "It's a book about a wizard, Harry.", 250, 94, 9.5),
    
    _aBook(11002, "Nineteen Eighty-Four", "George Orwell", "This is the most "
            . "dystipian, dystopian novel ever. Keep an eye on the "
            . "government...", 140, 154, 9.49),
    
    _aBook(11003, "The World's Shortest Book", "A. Example", "A book so short "
            . "yet so gripping, you'll find yourself stuck in a recursive "
            . "loop reading it again, and again.", 15, 3, 8.49),
    
    _aBook(11002, "Animal Farm", "George Orwell", null, 97, 150, 4.59),
    
    _aBook(11002, "Idiot's Guide to Politics", "A.N. Idiot", "Well, it's just "
            . "like normal then...", 1023, 5, 9.99),
    
    _aBook(11001, "Harry Potter Again", "J.K. Rowling", "The books just won't "
            . "stop publishing.", 2454, 76, 8.59),
    
    _aBook(11003, "A Very Short Story", "N.V. Tall", "This is a very short "
            . "story by a not very tall writer.", 34, 15, 8.99),
    
    _aBook(11003, "If I Stay", "Gayle Forman", "Choices. Seventeen-year-old Mia"
            . " is faced with some tough ones: Stay true to her first "
            . "love—music—even if it means losing her boyfriend and leaving "
            . "her family and friends behind? ", 201, 324, 6.49),
    
    _aBook(11003, "Something Blue", "Emily Giffin", "Darcy Rhone has always "
            . "been able to rely on a few things: Her beauty and charm.  "
            . "Her fiance, Dex. Her lifelong best friend, Rachel.  She never "
            . "needed anything else. ", 338, 93, 7.99),
);

/**
 * Support function to make it simpler to create books.
 * 
 * The underscore is just a standard way of saying please don't use this 
 * anywhere else.
 */
function _aBook($genre_id, $name, $author, $description, $pages, $sold, $price) {
    return array(
        "id" => $GLOBALS['database_books_id_seed']++, 
        "genre_id" => $genre_id, 
        "name" => $name, 
        "author" => $author,
        "description" => $description,
        "pages" => $pages,
        "sold" => $sold,
        "price" => $price);
}

function helper($text)
{
    $text = str_replace("'", "\'", $text);
    return $text;
}

function insettodb()
{
    $books = $GLOBALS['database_books'];
    $clean = "delete from books;";
    $connection = connet();
    print $clean;
    query($clean);
    foreach ($books as $book) {
        $start = "INSERT INTO books(id, genre_id, name, author, description, pages, sold, price) VALUES (";
        $statment = $book["id"] . "," . $book["genre_id"] . ",'" . $book["name"] . "','" . $book["author"] . "','" . helper($book["description"]) . "'," . $book["pages"] . "," . $book["sold"] . "," . $book["price"] . ");";
        print $start;
        print $statment . "<br/>";
        query($start  + $statment);
    }
}

/**
 * This just returns all of the books, but sorts them alphabetically, this would
 * normally happen in the database.
 */
function findAllBooks() {
    $statment = "select * from books";
    $connection = connet();
    $books = query($statment);
    $book = array();
    while ($row = getrows($books)) {
        array_push($book, $row);
    }
    return $book;
}

function findLightBooks($maxPages) {
    $statment = "select * from books where pages =" . $maxPages;
    $books = findAllBooks();
    
    $foundBooks = array();
    foreach ($books as $book) {
        if ($book["pages"] < 100) {
            array_push($foundBooks, $book);
        }
    }
    return $foundBooks;
}

/**
 * This searches the array for an individual book by the given ID.
 */
function findBookById($id) {
    $statment = "select * from books where id =" . $id;
    $books = findAllBooks();
    
    // Go through each book in the array of books.
    foreach ($books as $book) {
        
        // Check the ID of the current book against, the given ID, if it
        // matches they we have found it and can return it!
        if ($book["id"] == $id) {
            return $book;
        }
    }
    
    // If we didn't find the book then we'll just return null, we
    // need to check for this outside though to avoid errors.
    return null;
}

/**
 * This will find all books with the given genre, but remember that the genre
 * should be one of our genre associative arrays.
 */
function findBooksByGenre($genre) {
    $books = findAllBooks();
    
    $foundBooks = array();
    foreach ($books as $book) {
        if ($book["genre_id"] == $genre["id"]) {
            array_push($foundBooks, $book);
        }
    }
    return $foundBooks;
}

/**
 * Gets the top 5 books based on their number of sold copies. This requires
 * sorting the array of books!
 */
function findTopSellingBooks() {
    $books = findAllBooks();
    
    /**
     * Now sort the books using our own sort function (above).
     */
    usort($books, "_byCopiesSold");
    
    /**
     * Use "slice" to only return up to so many items.
     */
    return array_slice($books, 0, 5);
}

/**
 * This finds the 3 top selling books within the given genre.
 * 
 * It is a hybrid of the findTopSellingBooks and findBooksByGenre methods.
 */
function findTopSellingBooksByGenere($genre) {
    /**
     * We can reuse the findBooksByGenre method as it just gives us all books
     * for any given genre.
     */
    $books = findBooksByGenre($genre);
    
    /*
     * But we cannot easily reuse the findTopSellingBooks method so we just 
     * copy the sort and slice functionality.
     */
    usort($books, "_byCopiesSold");
    return array_slice($books, 0, 3);
    
}

/**
 * Compares the two items based on their number of copies sold.
 * 
 * @param type $a The first item to compare
 * @param type $b The second item to compare
 * @return int Returns 1, 0 or -1 to say greater than, equal to or less than.
 */
function _byCopiesSold($a, $b) {
    if ($a["sold"] == $b["sold"]) {
        return 0;
    }
    return $a["sold"] < $b["sold"] ? 1 : -1;
}

?>