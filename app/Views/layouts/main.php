<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= yieldContent('title', 'PHP MVC'); ?></title>
        <link href="/assets/css/style.css" rel="stylesheet">
        <script src="/assets/js/script.js"></script>
    </head>
    <body>
        <header style="border-bottom: 1px solid #000; padding-bottom: 15px;">
            <?= includeFile('partials/header.php'); ?>
        </header>

        <main style="padding: 15px 0 30px 0;">
            <?= yieldContent('content'); ?>
        </main>

        <aside style="border-top: 1px solid #000; padding: 15px 0;">
            <?php 
            yieldContentOr('sidebar', function () {
                echo '<p>Default sidebar.</p>';
            });
            ?>
        </aside>

        <footer style="border-top: 1px solid #000; padding: 15px 0;">
            <?= includeFile('partials/footer.php'); ?>
        </footer>
    </body>
</html>
