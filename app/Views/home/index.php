<?php section('title'); ?>
    Home Page
<?php endsection(); ?>

<?php section('content'); ?>
    <p>Hello, <?= htmlspecialchars($user) ?>.</p>
    <p>Home page content was rendered with layout...</p>
<?php endsection(); ?>

    <p>Hello, <?= htmlspecialchars($user) ?>.</p>
    <p>This page content was rendered without layout..</p>

<?php section('sidebar'); ?>
    <ul>
        <li><a href="/render">Render view (without layout)</a></li>
        <li><a href="/hello">Hello (Callback)</a></li>
        <li><a href="/user/1">Url Parameter</a></li>
    </ul>
<?php endsection(); ?>
