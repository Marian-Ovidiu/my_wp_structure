<section class="bg-white">
    <div class="container flex flex-col items-center px-4 py-8 mx-auto text-center">
        <?php if($titolo): ?>
            <h2 class="text-2xl font-bold tracking-tight text-custom-dark-green xl:text-3xl">
                <?php echo e($titolo); ?>

            </h2>
        <?php endif; ?>
        <?php if($sottotitolo): ?>
            <p class="block max-w-4xl mt-4 text-gray-500">
                <?php echo e($sottotitolo); ?>

            </p>
        <?php endif; ?>
    </div>
</section><?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/components/testo-sottotesto.blade.php ENDPATH**/ ?>