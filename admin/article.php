<?php

require '../classes/Database.php';
require '../classes/Article.php';
require '../includes/auth.php';

session_start();
$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>
<?php require '../includes/header.php'; ?>

<?php if ($article) : ?>

    <article>
    <h2><?= htmlspecialchars($article[0]['title']); ?></h2>
    
    <?php if ($article[0]['category_name']) : ?>
    <p>Categories:
        <?php foreach ($article as $a) : ?>
            <?= htmlspecialchars($a['category_name']); ?>
        <?php endforeach; ?>
    </p>
<?php endif; ?>

<p><?= htmlspecialchars($article[0]['content']); ?></p>
    </article>

    <a href="../admin/edit-article.php?id=<?= $article[0]['id']; ?>">Edit</a>
    
    <a href="../admin/delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a>

<?php else : ?>
    <p>Article not found.</p>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>
