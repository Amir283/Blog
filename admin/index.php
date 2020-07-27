<?php

require '../classes/Database.php';
require '../classes/Article.php';
require '../includes/auth.php';

session_start();

$db = new Database();
$conn = $db->getConn();

$articles = Article::getAll($conn);

?>

<?php require '../includes/header.php'; ?>
<h3> Administration area </h4>
<?php if (empty($articles)) : ?>
        <p>No articles found.</p>
        <?php endif; ?>

<?php if (isLoggedIn()) : ?>

    <p><a href="../admin/new-article.php">New article</a></p>

    <ul class="index">
        <?php foreach ($articles as $article) : ?>
            <li>
                <article>
                    <h4><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h4>
                    <p><?= htmlspecialchars($article['published_at']); ?></p>
                    <p><?= htmlspecialchars($article['content']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>

<?php else : ?>
    
   <p> not logged in </p>

<?php endif; ?>


<?php require '../includes/footer.php'; ?>
