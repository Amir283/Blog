<?php

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/auth.php';

session_start();
$db = new Database();
$conn = $db->getConn();

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>
<?php require 'includes/header.php'; ?>

<?php if ($article) : ?>

    <article> <!--i get the same article several times, each time with different category but all the rest (title etc) is the same . this is why i need the title etc only of $article[0]. and i need the category of article[0,1,2..]-->
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

<?php else : ?>
    <p>Article not found.</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>

