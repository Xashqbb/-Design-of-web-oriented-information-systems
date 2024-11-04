<html>
<head><title>Books</title></head>
<body>
<form method="get" action="index.php">
    <input type="text" name="search" placeholder="Search by title or author" />
    <input type="submit" value="Search" />
</form>

<table border="1">
    <tr><th>Title</th><th>Author</th><th>Description</th></tr>
    <?php foreach ($books as $book): ?>
        <tr>
            <td><a href="index.php?book=<?php echo $book->id; ?>"><?php echo $book->title; ?></a></td>
            <td><?php echo $book->author; ?></td>
            <td><?php echo $book->description; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
