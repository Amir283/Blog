<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Fondamento&family=Yellowtail&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/css/styles.css">
   

</head>
<body>
    <div class="container">
    <header>
        <h1>My  Blog</h1>
    </header>
    <nav>
        <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                
                <?php if ((isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'])) : ?>
 
                <li class="nav"> <a class="nav-link" href="/admin/index.php">Admin</a></li>
                <li class="nav"> <a class="nav-link" href="/admin/logout.php">Log out</a></li>

                <?php else : ?> 
                <li class="nav"> <a class="nav-link" href="/admin/login.php">Log in</a></li>
                <?php endif; ?>

                <li class="nav-item"><a class="nav-link" href="/contact.php">Contact</a></li>

        </ul>
    </nav>
    <main>