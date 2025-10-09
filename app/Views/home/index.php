<?php section('title'); ?>
    Home Page
<?php endsection(); ?>

<?php section('content'); ?>
    <p>Hello, <?= htmlspecialchars($user) ?>.</p>
    <p>Home page content was rendered with layout..</p>
<?php endsection(); ?>

    <p>Hello, <?= htmlspecialchars($user) ?>.</p>
    <p>This page content was rendered Without layout..</p>

<?php section('sidebar'); ?>
<ul>
    <li><a href="/category">Category</a></li>
    <li>Nav 2</li>
</ul>
<?php endsection(); ?>
