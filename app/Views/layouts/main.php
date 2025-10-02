<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php yield_content('title', 'PHP MVC'); ?></title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <header>
            <?php include_view('partials/header.php'); ?>
        </header>

        <main>
            <?php yield_content('content'); ?>
        </main>

        <footer>
            <?php include_view('partials/footer.php'); ?>
        </footer>
    </body>
</html>
