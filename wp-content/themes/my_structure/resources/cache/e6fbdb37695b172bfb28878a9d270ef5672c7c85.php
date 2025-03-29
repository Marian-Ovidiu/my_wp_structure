<?php
    $thankYouUrl = get_permalink(pll_get_post(412, pll_current_language()));
?>
<section class="relative py-10 overflow-hidden bg-black sm:py-16 lg:py-24 xl:py-32">
    <div class="absolute inset-0">
        <img class="object-cover w-full h-full md:object-left md:scale-150 md:origin-top-left"
            src="<?php echo e($progetto->immagine_hero['url']); ?>" alt="" />
    </div>
    <div class="absolute inset-0 hidden bg-gradient-to-r md:block from-black to-transparent"></div>
    <div class="absolute inset-0 block bg-black/60 md:hidden"></div>
    <div class="relative px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl" x-data="typingEffect()">
        <div class="text-center md:w-2/3 lg:w-1/2 xl:w-1/2 md:text-left">
            <h1 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl"><?php echo e($progetto->titolo_hero); ?></h1>
            <div class="min-h-[1.5rem] mt-4 text-base text-gray-200">
                <?php echo $progetto->testo_hero; ?>

            </div>
        </div>
    </div>
</section>

<section class="container bg-white flex-column lg:flex lg:flex-row mx-auto">
    <div class="container px-6 mx-auto">
        <?php $__env->startComponent('components.section', ['titolo' => $progetto->problemi_titolo_1, 'items' => $progetto->getProblemi()]); ?>
        <?php echo $__env->renderComponent(); ?>
    </div>
    <div class="container px-6 mx-auto">
        <?php $__env->startComponent('components.section', ['titolo' => $progetto->soluzioni_titolo_1, 'items' => $progetto->getSoluzioni()]); ?>
        <?php echo $__env->renderComponent(); ?>
    </div>
</section>
<?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/partials/donation-section.blade.php ENDPATH**/ ?>