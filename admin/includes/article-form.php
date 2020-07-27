<?php if (! empty($article->errors)) : ?>
    <ul>
        <?php foreach ($article->errors as $error) : ?>
            <li><?= $error ?></li>    
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post">

    <div class="form-group">
        <label for="title">Title</label>
        <input name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($article->title); ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" rows="4" cols="40" id="content" placeholder="Article content"  class="form-control"><?= htmlspecialchars($article->content); ?></textarea>
    </div>

    <div class="form-group">
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at"  class="form-control" value="<?= htmlspecialchars($article->published_at); ?>">
    </div>

    <button class="btnbtn-primary">Save</button>

</form>
