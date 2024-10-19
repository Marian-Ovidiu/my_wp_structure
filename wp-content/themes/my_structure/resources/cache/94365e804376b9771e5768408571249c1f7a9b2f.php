<?php
/**
 * @var \Models\HomeFields $data
 */
?>

<?php $__env->startSection('content'); ?>
    <div class="w-full relative">
        <div class="swiper vertical-slide-carousel swiper-container relative h-dvh">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="swiper-slide">
                        <div class="bg-indigo-50 rounded-2xl h-dvh flex justify-center items-center">
                            <span class="text-3xl font-semibold text-indigo-600"><?php echo e($data->titolo_1); ?></span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <div class="swiper-pagination !right-10 !left-full !top-1/3 !translate-y-8"></div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/home.blade.php ENDPATH**/ ?>