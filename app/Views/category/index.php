<?php section('title', htmlspecialchars($title)); ?>

<?php
section('content');
    echo '<ul>';
        foreach ($dataList as $c) {
            echo '<li class="flex space-y-1">';
            if ($c->status === 1) {
                echo '<a href="/category/show/'. $c->url .'" class="hover:underline font-bold">'. $c->name .'</a>';
            } else {
                echo '<a href="/category/show/'. $c->url .'" class="hover:underline text-gray-400 line-through font-bold">'. $c->name .'</a>';
            }
            echo '</li>';
        }
    echo '</ul>';
endsection();
?>

<?= includeFile('/category/partials/sidebar.php'); ?>
