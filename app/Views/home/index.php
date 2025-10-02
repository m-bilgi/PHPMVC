<?php section('title'); ?>
    Home Page
<?php endsection(); ?>

<?php section('content'); ?>
    <p>Hello, <?= htmlspecialchars($user) ?>.</p>
    <p>Home page content...</p>
<?php endsection(); ?>

<?php section('sidebar'); ?>
<ul>
    <li>Nav 1</li>
    <li>Nav 2</li>
</ul>
<?php endsection(); ?>
