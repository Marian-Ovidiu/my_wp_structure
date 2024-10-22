<div class="container mx-auto">
    <div class="flex hidden min-h-screen items-center justify-center bg-white sm:block md:block lg:block">
        <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            <?php $__currentLoopData = $progetti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $progetto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group relative cursor-pointer items-center justify-center overflow-hidden transition-shadow hover:shadow-xl hover:shadow-black/30">
                    <div class="h-96 w-full">
                        <img class="h-full w-full object-cover transition-transform duration-500 group-hover:rotate-3 group-hover:scale-125" src="<?php echo e($progetto['immagine']['url']); ?>" alt="" />
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-black group-hover:from-black/70 group-hover:via-black/60 group-hover:to-black/70"></div>
                    <div class="absolute inset-0 flex translate-y-[75%] flex-col items-center justify-center px-9 text-center transition-all duration-500 group-hover:translate-y-0">
                        <h1 class="font-dmserif text-3xl font-bold text-white"><?php echo e($progetto['titolo']); ?></h1>
                        <button class="rounded-full bg-custom-dark-green py-2 px-3.5 font-com text-sm capitalize text-white shadow shadow-black/60">
                            <a href="<?php echo e($progetto['cta']['url']); ?>"><?php echo e($progetto['cta']['title']); ?></a>
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/components/home-cards.blade.php ENDPATH**/ ?>