<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php yieldContent('title', 'PHP MVC'); ?></title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <header>
            <?php includeFile('partials/header.php'); ?>
        </header>

        <main>
            <?php yieldContent('content'); ?>
        </main>

        <footer>
            <?php includeFile('partials/footer.php'); ?>
        </footer>
    </body>
</html>
