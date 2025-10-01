<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($title) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($title) ?></h1>
    <p>Hello, <?= htmlspecialchars($user) ?> — PHP MVC starter example.</p>
    <p><a href="/hello">/hello route</a> (closure example.)</p>
</body>
</html>
