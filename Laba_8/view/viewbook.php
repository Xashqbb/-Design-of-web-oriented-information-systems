<html>
<head><title><?php echo $book->title; ?></title></head>
<body>
<h2><?php echo $book->title; ?></h2>
<p><strong>Author:</strong> <?php echo $book->author; ?></p>
<p><strong>Description:</strong> <?php echo $book->description; ?></p>
<p><strong>Year:</strong> <?php echo $book->publish_year; ?></p>
<p><strong>Pages:</strong> <?php echo $book->pages; ?></p>
<?php if ($book->cover_image): ?>
    <img src="<?php echo $book->cover_image; ?>" alt="Cover Image">
<?php endif; ?>
</body>
</html>
