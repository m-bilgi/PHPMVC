<?php section('title'); ?>
    Home Page
<?php endsection(); ?>

<?php section('content'); ?>
    <p>Hello, <?= htmlspecialchars($user) ?>.</p>
    <p>Home page content...</p>
<?php endsection(); ?>
