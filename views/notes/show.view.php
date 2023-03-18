<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mb-4">
            <a href="/notes" class="text-blue-800 hover:underline">Back to all notes</a>
        </p>
        <p>
            <?= htmlspecialchars($note['body']) ?>
        </p>
        <div class="mt-6 flex gap-2">
            <a href="/note/edit?id=<?= $note['id'] ?>" class="inline-flex justify-center rounded-md bg-gray-500 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-400">Edit</a>
            <form action="" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <button class="inline-flex justify-center rounded-md bg-red-500 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-400">Delete</button>
            </form>
        </div>
    </div>
</main>

<?php require base_path('views/partials/footer.php') ?>