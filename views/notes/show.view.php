<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-3">
            <a href="/notes" class="text-blue-800 hover:underline">Back to all notes</a>
        </p>
        <p>
            <?= htmlspecialchars($note['body']) ?>
        </p>
        <form action="" class="mt-3" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button class="text-sm text-red-500">Delete</button>
        </form>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>