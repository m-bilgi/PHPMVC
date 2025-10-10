<?php section('title'); ?>
    <?= $data->name ?>
<?php endsection(); ?>

<?php section('content'); ?>
    <h2 class="flex pb-5 gap-2"><?= $data->name ?></h2>
    <form action="/category/edit-post" method="POST">
        <?= csrf_field() ?>
        <input type="hidden" name="sig" value="<?= htmlspecialchars($data->signature) ?>">
        <input type="hidden" name="id" value="<?= $data->id ?>">

        <label for="name">Name (*):</label><br>
        <input type="text" name="name" id="name" value="<?= $data->name ?>" autocomplete="off" class="w-[250px] mb-4 px-2 border border-gray-400" required><br>

        <label for="url">Url (*):</label><br>
        <input type="text" name="url" id="url" value="<?= $data->url ?>" autocomplete="off" class="w-[250px] mb-4 px-2 border border-gray-400" required><br>

        <label for="image">image url:</label><br>
        <input type="text" name="image" id="image" value="<?= $data->image ?>" autocomplete="off" class="w-[250px] mb-4 px-2 border border-gray-400"><br>

        <label for="sort_order">Short order:</label><br>
        <select name="sort_order" id="sort_order" class="w-[250px] mb-4 px-2 border border-gray-400">
            <?php for ($i=0; $i <= 10; $i++) { ?>
                <option value="<?= $i ?>"<?= $data->sort_order === $i ? ' selected' : '' ?>><?= $i ?></option>
            <?php } ?>
        </select><br>

        <span for="status">Status:</span><br>
        <input type="radio" name="status" value="1"<?= $data->status === 1 ? ' checked' : ''; ?>> Aktif<br>
        <input type="radio" name="status" value="0"<?= $data->status === 0 ? ' checked' : ''; ?>> Pasif<br>

        <button type="submit" class="mt-4 px-2 border border-blue-600 bg-blue-500 hover:bg-blue-700 text-white">Submit</button>
    </form>
    <p class="pt-5">(*) Required fields.</p>
<?php endsection(); ?>

<?= includeFile('/category/partials/sidebar.php'); ?>
