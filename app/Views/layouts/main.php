<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= yieldContent('title', 'PHP MVC'); ?></title>
        <link href="/assets/css/style.css" rel="stylesheet">
        <script src="/assets/js/script.js"></script>
    </head>
    <body>
        <header class="p-5 border-b border-gray-400 bg-gray-400">
            <?= includeFile('partials/header.php'); ?>
        </header>

        <main class="p-5 pb-8">
            <?= yieldContent('content'); ?>
        </main>

        <aside class="p-5 border-t border-gray-400">
            <?php 
            yieldContentOr('sidebar', function () {
                echo '<p>Default sidebar.</p>';
            });
            ?>
        </aside>

        <footer class="p-5 border-t border-gray-400">
            <?= includeFile('partials/footer.php'); ?>
        </footer>
    </body>
</html>
