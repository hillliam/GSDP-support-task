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
require "model/genres.php";
require "support/recently-viewed.php";
require "model/pricelist.php";

/**
 * Has a genre been selected?
 */
$books = getpricelist();
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

        <h2>price list</h2>
        <p>books you plan to buy</p>
        <p>the number of books in the array is <?php print count($books); ?></p>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <p><td>
                    <!-- We use a link for the book name which links to the book page -->
                    <a href="book?id=<?php print $book["id"]; ?>">
                        <?php print $book["name"]; ?>
                    </a>
                </td>
                <td><?php echo $book["author"]; ?></td>
                <td><?php echo sprintf("£%01.2f", $book["price"]); ?></td>
                <td><a href="removefrombuylist?buylist=<?php print $book["id"]; ?>">remove</a></td>
                </p>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php require "templates/template_footer.php"; ?>
</body>
</html>