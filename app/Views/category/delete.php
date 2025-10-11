<?php section('title', 'Delete page: '. $data->name); ?>

<?php section('content'); ?>
    <h2 class="flex pb-5 gap-2"><?= $data->name ?></h2>
    <p><p>Are you sure you want to delete this content?</p></p>
    <form action="/category/delete-post" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="sig" value="<?= htmlspecialchars($data->signature) ?>">
        <input type="hidden" name="id" value="<?= $data->id ?>">
        <button type="submit" class="mt-4 px-2 border border-red-600 bg-red-500 hover:bg-red-700 text-white">Delete</button>
    </form>
<?php endsection(); ?>

<?= includeFile('/category/partials/sidebar.php'); ?>
