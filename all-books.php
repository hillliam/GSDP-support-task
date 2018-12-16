<?php
/*
 * WARNING: Every page that uses $_SESSION MUST have this...
 */
session_start();

/**
 * This is our All Books page. This is the sort of page where we want to give
 * the user filtering options perhaps.
 */

require "support/constants.php";
require "support/recently-viewed.php";
require "model/genres.php";
require "model/books.php";

$allGenres = findAllGenres();

/**
 * Has a genre been selected?
 */
if (isset($_GET["genre"])) {
    $genreName = $_GET["genre"];
    $books = findBooksByGenre(findGenreByName($genreName));
} else {
    $books = findAllBooks();
}

/**
 * The View for this page is below...
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>All Books | <?php print STORE_TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <!-- 
            This inserts the template_header PHP page right here and 
            runs any PHP code inside it
        -->
        <?php require 'templates/template_header.php'; ?>
        
        <h2>All Books</h2>
        <p>Browse our entire collection, but be warned, it's BIG!</p>
        
        <p>
            &diams;
            <a href="all-books">all
            &diams;
            <?php foreach ($allGenres as $genre): ?>
                <a class="red-title" href="all-books?genre=<?php print $genre["name"]; ?>">
                    <?php print $genre["name"]; ?>
                </a>
                &diams;
            <?php endforeach; ?>
        </p>
        
        <!-- A table layout, because we are showing tabular content! -->
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td>
                        <!-- We use a link for the book name which links to the book page -->
                        <a href="book.php?id=<?php print $book["id"]; ?>">
                            <?php print $book["name"]; ?>
                        </a>
                    </td>
                    <td><?php echo $book["author"]; ?></td>
                    <td><?php echo $book["price"]; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <hr/>
        
        <?php require "templates/template_footer.php"; ?>
    </body>
</html>
