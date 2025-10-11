<?php section('title', htmlspecialchars($title)); ?>

<?php section('content'); ?>
    <h2 class="flex pb-5 gap-2">Add new category</h2>
    <form action="/category/insert-post" method="POST">
        <?= csrf_field() ?>

        <label for="name">Name (*):</label><br>
        <input type="text" name="name" id="name" autocomplete="off" class="w-[250px] mb-4 px-2 border border-gray-400" required><br>

        <label for="url">Url (*):</label><br>
        <input type="text" name="url" id="url" autocomplete="off" class="w-[250px] mb-4 px-2 border border-gray-400" required><br>

        <label for="image">image url:</label><br>
        <input type="text" name="image" id="image" autocomplete="off" class="w-[250px] mb-4 px-2 border border-gray-400"><br>

        <label for="sort_order">Short order:</label><br>
        <select name="sort_order" id="sort_order" class="w-[250px] mb-4 px-2 border border-gray-400">
            <?php 
                for ($i=0; $i <= 10; $i++) {
                    echo '<option value="'. $i .'">'. $i .'</option>';
                } 
            ?>
        </select><br>

        <span for="status">Status:</span><br>
        <input type="radio" name="status" value="1" checked> Aktif<br>
        <input type="radio" name="status" value="0"> Pasif<br>

        <button type="submit" class="mt-4 px-2 border border-blue-600 bg-blue-500 hover:bg-blue-700 text-white">Submit</button>
    </form>
    <p class="pt-5">(*) Required fields.</p>
<?php endsection(); ?>

<?= includeFile('/category/partials/sidebar.php'); ?>
