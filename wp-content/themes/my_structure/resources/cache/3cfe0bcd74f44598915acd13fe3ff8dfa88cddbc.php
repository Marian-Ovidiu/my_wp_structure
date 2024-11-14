<?php $__env->startSection('content'); ?>
<div class="bg-white py-6 sm:py-8 lg:py-12">
    <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
        <div class="header flex-col items-center justify-center">
            <?php echo $__env->make('components.testo-sottotesto',[
                'titolo' => 'Il Nostro Viaggio in Qualche Scatto',
                'sottotitolo' => '',
                'highlight' => true,
                'text_base_highlight' => 'Ogni foto, una storia di '
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->make('components.testo-sottotesto',[
                'titolo' => null,
                'sottotitolo' => 'Desideriamo condividere con te alcuni momenti significativi del nostro lavoro sul campo. Ogni scatto cattura un aspetto unico delle sfide che affrontiamo e delle vittorie che celebriamo, insieme a coloro che ci supportano. Queste foto raccontano storie di impegno, coraggio e passione che guidano la nostra missione di proteggere la fauna selvatica e sostenere le comunità locali.',
                'highlight' => false,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:gap-6 xl:gap-8 py-8">
            <?php $__currentLoopData = $galleria->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key_group => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $gr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $classes = ($key % 4 === 0 || $key % 4 === 3) ? '' : 'md:col-span-2';
                    ?>
                    <a href="#"
                       class="group relative flex h-48 items-end overflow-hidden rounded-lg bg-gray-100 shadow-lg md:h-80 <?php echo e($classes && !$group['descrizione'] ? $classes : ''); ?>">
                        <img src="<?php echo e($gr['immagine']['url']); ?>" loading="lazy" alt="Photo by Minh Pham" class="absolute inset-0 h-full w-full object-cover object-center transition duration-200 group-hover:scale-110" />

                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-gray-800 via-transparent to-transparent opacity-50"></div>

                        <?php if($gr['testo']): ?>
                            <span class="relative ml-4 mb-3 inline-block text-sm text-white md:ml-5 md:text-lg"><?php echo e($gr['testo']); ?></span>
                        <?php endif; ?>
                    </a>

                    <?php if($gr['descrizione']): ?>
                        <?php echo $__env->make('components.testo-sottotesto',[
                            'titolo' => null,
                            'sottotitolo' => $gr['descrizione'],
                            'highlight' => false,
                            'class' => 'col-span-2 md:col-span-3 flex items-center justify-center'
                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/galleria.blade.php ENDPATH**/ ?>