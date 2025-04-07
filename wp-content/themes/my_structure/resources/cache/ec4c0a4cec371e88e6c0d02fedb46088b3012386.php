<div class="swiper-container logo-marquee w-full my-4">
    <div class="swiper-wrapper sw-wrapper-linear">
        <?php if(isset($linearSlider) && !empty($linearSlider)): ?>
            <?php
                $logos = [
                    [
                        'logo' => $linearSlider->logo_1,
                        'title' => $linearSlider->titolo_logo_1 ?? null,
                    ],
                    [
                        'logo' => $linearSlider->logo_2,
                        'title' => $linearSlider->titolo_logo_2 ?? null,
                    ],
                    [
                        'logo' => $linearSlider->logo_3,
                        'title' => $linearSlider->titolo_logo_3 ?? null,
                    ],
                ];
            ?>

            <?php $__currentLoopData = $logos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(isset($item['logo']['url']) && isset($item['logo']['title'])): ?>
                    <div class="swiper-slide flex flex-col items-center justify-center p-4">
                        <div class="text-center mb-2 custom-dark-green">
                            <p class="font-bold text-lg custom-dark-green"><?php echo e($item['title']); ?></p>
                        </div>
                        <img src="<?php echo e($item['logo']['url']); ?>" alt="<?php echo e($item['logo']['title']); ?>" style="max-height: 80px;">
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p>No logos available</p>
        <?php endif; ?>
    </div>
</div>

<div class="text-gray-600 text-xs text-center mt-2 mx-4">
    * La nostra presenza su questo sito non implica sponsorizzazione o contributi economici
</div>
<?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/components/linear-slider.blade.php ENDPATH**/ ?>