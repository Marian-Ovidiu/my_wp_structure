<section class="py-12 md:py-20 bg-white">
    <div class="container mx-auto px-4 sm:px-6">
        <?php if($titolo): ?>
            <h2 class="text-3xl font-nunitoBold text-custom-dark-green text-center mb-12 md:mb-20 lg:text-4xl">
                <?php echo e($titolo); ?>

            </h2>
        <?php endif; ?>

        <div class="space-y-12 md:space-y-16 max-w-7xl mx-auto">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $hasImage = isset($item['immagini']) && count($item['immagini']) > 0;
                ?>
        
                <article class="bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100">
                    <div class="flex flex-col <?php echo e($hasImage ? 'md:flex-row' : 'items-center text-center'); ?> <?php echo e($hasImage && $index % 2 === 1 ? 'md:flex-row-reverse' : ''); ?>">
                        
                        
                        <?php if($hasImage): ?>
                            <div class="md:w-1/2 p-6 md:p-8">
                                <div class="overflow-hidden rounded-xl">
                                    <div class="h-[150px] sm:h-[250px] lg:h-[300px] xl:h-[300px] 2xl:h-[300px] swiper swiper-progetto w-full" role="group" aria-label="Image slider">
                                        <div class="swiper-wrapper">
                                            <?php $__currentLoopData = $item['immagini']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <figure class="swiper-slide h-[150px] sm:h-[250px] lg:h-[300px] xl:h-[300px] 2xl:h-[300px]">
                                                    <img 
                                                        src="<?php echo e($img['url']); ?>" 
                                                        alt="<?php echo e($img['alt'] ?? ($item['sottoTitolo'] ?? 'Project image')); ?>" 
                                                        title="<?php echo e($img['title'] ?? ($item['sottoTitolo'] ?? '')); ?>"
                                                        class="w-full object-cover"
                                                        loading="lazy"
                                                    >
                                                    <?php if(isset($img['caption']) && $img['caption']): ?>
                                                        <figcaption class="sr-only"><?php echo e($img['caption']); ?></figcaption>
                                                    <?php endif; ?>
                                                </figure>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="swiper-pagination mt-4" aria-hidden="true"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
        
                        
                        <div class="<?php echo e($hasImage ? 'md:w-1/2 p-6 md:p-8 flex flex-col justify-center border-t md:border-t-0 md:border-l border-gray-100' : 'p-6 sm:p-10'); ?>">
                            <div class="<?php echo e($hasImage ? '' : 'max-w-xl mx-auto'); ?>">
                                <?php if(!empty($item['sottoTitolo'])): ?>
                                    <h3 class="text-xl md:text-2xl font-nunitoSansRegular text-custom-dark-green mb-3 md:mb-4">
                                        <?php echo e($item['sottoTitolo']); ?>

                                    </h3>
                                <?php endif; ?>
        
                                <?php if(!empty($item['testo'])): ?>
                                    <div class="prose text-gray-600 font-nunitoSansLight">
                                        <?php echo $item['testo']; ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
        
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
    </div>
</section><?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/components/section.blade.php ENDPATH**/ ?>