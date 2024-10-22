<div class="flex justify-center mx-auto max-w-lg overflow-y-hidden sm:hidden">
    <div class="flex flex-col gap-2">
        <?php $__currentLoopData = $progetti; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $progetto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($key === 0): ?>
                <div class="out-group h-96 mb-4" style="z-index: <?php echo e($key+10); ?>">
                    <div class="group relative cursor-pointer items-center justify-center overflow-hidden transition-shadow hover:shadow-xl hover:shadow-black/30">
                        <div class="h-96 w-72 relative group">
                            <img class="h-full w-full object-cover transition-transform duration-500 group-hover:rotate-3 group-hover:scale-125" src="<?php echo e($progetto['immagine']['url']); ?>" alt="" />
                            <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-full text-center z-10">
                                <p class="mb-1 text-lg text-white opacity-100">
                                    <?php echo e($progetto['titolo']); ?>

                                </p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-black/40 to-black/90 group-hover:from-black/90 group-hover:via-black/80 group-hover:to-black/40"></div>
                        <div class="absolute inset-0 z-20 flex translate-y-[60%] flex-col items-center justify-center px-9 text-center transition-all duration-500 group-hover:translate-y-0">
                            <button class="rounded-full bg-custom-dark-green py-2 px-3.5 font-com text-sm capitalize text-white shadow shadow-black/60">
                                <a href="<?php echo e($progetto['cta']['url']); ?>"><?php echo e($progetto['cta']['title']); ?></a>
                            </button>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div x-data="{
                            isAtOrAboveCenter: false,
                            checkIfAtOrAboveCenter(el) {
                                const rect = el.getBoundingClientRect();
                                const elementCenter = rect.top;
                                const viewportCenter = window.innerHeight / 2;
                                this.isAtOrAboveCenter = elementCenter <= viewportCenter;
                            }
                         }"
                     x-intersect="checkIfAtOrAboveCenter($el)"
                     @scroll.window="checkIfAtOrAboveCenter($el)"
                     :class="{ 'overlap': isAtOrAboveCenter }"
                     class="out-group h-96 mb-4" style="z-index: <?php echo e($key+10); ?>">
                    <div class="group relative cursor-pointer items-center justify-center overflow-hidden transition-shadow hover:shadow-xl hover:shadow-black/30">
                        <div class="h-96 w-72 relative group">
                            <img class="h-full w-full object-cover transition-transform duration-500 group-hover:rotate-3 group-hover:scale-125" src="<?php echo e($progetto['immagine']['url']); ?>" alt="" />
                            <div class="absolute top-10 left-1/2 transform -translate-x-1/2 w-full text-center z-10">
                                <p class="mb-1 text-lg text-white opacity-100">
                                    <?php echo e($progetto['titolo']); ?>

                                </p>
                            </div>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-black/40 to-black/90 group-hover:from-black/90 group-hover:via-black/80 group-hover:to-black/40"></div>
                        <div class="absolute inset-0 z-20 flex translate-y-[60%] flex-col items-center justify-center px-9 text-center transition-all duration-500 group-hover:translate-y-0">
                            <button class="rounded-full bg-custom-dark-green py-2 px-3.5 font-com text-sm capitalize text-white shadow shadow-black/60">
                                <a href="<?php echo e($progetto['cta']['url']); ?>"><?php echo e($progetto['cta']['title']); ?></a>
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div><?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/components/home-mobile-cards.blade.php ENDPATH**/ ?>