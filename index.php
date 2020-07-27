<?php

require 'classes/Database.php';
require 'classes/Article.php';

session_start();

$db = new Database();
$conn = $db->getConn();

$articles = Article::getAll($conn);

?>

<?php require 'includes/header.php'; ?>

<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>

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

<?php endif; ?>

<?php require 'includes/footer.php'; ?>
