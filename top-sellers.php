<?php
/**
 * This is our homepage!
 */
session_start();
require "support/constants.php";
require "model/books.php";
require "support/recently-viewed.php";
$books = findTopSellingBooks();

$number = 1;

/**
 * The View for this page is below...
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Top Sellers | <?php print STORE_TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <!-- 
            This inserts the template_header PHP page right here and 
            runs any PHP code inside it
        -->
        <?php require 'templates/template_header.php'; ?>
        
        <h2>Top Sellers</h2>
        <p>These ones are shifting like wildfire!</p>
        
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Author</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php print $number++; ?></td>
                    <td>
                        <!-- We use a link for the book name which links to the book page -->
                        <a href="book?id=<?php print $book["id"]; ?>">
                            <?php print $book["name"]; ?>
                        </a>
                    </td>
                    <td><?php echo $book["author"]; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        
        <hr/>
        
        <?php require 'templates/template_footer.php'; ?>
    </body>
</html>
