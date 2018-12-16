<!-- 
This is our header template, it is reusable by using the "require" command
in PHP and means we don't have to change every page in order to update the
navigation
-->
<header>
    <h1><a href="index.php"><?php print STORE_TITLE; ?></a></h1>
    <p>The best place to buy books online, it's so good it's not even real!</p>
</header>
<div class="navigation">
    <a href="all-books.php" onclick="">All Books</a>
    <a href="light-reads.php">Light Reads</a>
    <a href="top-sellers.php">Top Sellers</a>
    <a href="top-fantasy.php">Top Fantasy</a>
    <a href="top-political.php">Top Political</a>
    <a href="pricelist.php" class="right">price list <span style="color: yellow;">(0)</span></a>
</div>

<!-- A separator line (or Horizontal Rule, hr) -->
<hr/>