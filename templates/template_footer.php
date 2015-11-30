
<?php if (hasRecentlyViewed()): ?>

    <h3>Recently Viewed</h3>
    
    <?php $items = getRecentlyViewed(); 
    foreach (getRecentlyViewed() as $item): ?>
    
        <!-- This will show a link to the given recently viewed book -->
        <a href="book.php?id=<?php print $item["id"]; ?>"><?php print $item["title"]; ?></a>
    
    <?php endforeach; ?>
    
    <hr/>

<?php endif; ?>

<footer>
    Copyright © ACME Bookstores Ltd.
</footer>