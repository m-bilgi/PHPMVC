<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= htmlspecialchars($title ?? 'PHP MVC') ?></title>
        <link rel="stylesheet" href="/css/style.css">
    </head>
    <body>
        <header>
            <h1>PHP MVC Framework</h1>
            <nav>
                <a href="/">Home Page</a>
                <a href="/hello">Hello</a> (closure example)
            </nav>
        </header>

        <main>
            <?= $content ?>
        </main>

        <footer>
            <p>&copy; <?= date('Y') ?> All rights reserved.</p>
        </footer>
    </body>
</html>
