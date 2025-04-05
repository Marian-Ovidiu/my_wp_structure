<?php
    $options = \Models\Options\OpzioniGlobaliFields::get();
?>
<header x-data="{ open: false }" class="p-6 bg-white lg:pb-0">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Desktop and above -->
        <nav class="flex items-center justify-between h-16 lg:h-20">
            <a href="<?php echo e(get_home_url(null, '/', 'https')); ?>" title="<?php echo e(__('Home', 'text_domain')); ?>" class="flex">
                <div class="text-center flex flex-col items-center justify-between">
                    <img class="w-auto h-12 lg:h-12" src="<?php echo e($options->logo['url']); ?>"
                        alt="Project Africa Conservation logo" />
                    <div class="text-custom-dark-green font-bold text-lg">Project Africa Conservation</div>
                    <!-- Increased font size -->
                </div>
            </a>

            <!-- Mobile menu button -->
            <button @click="open = !open" type="button"
                class="inline-flex p-2 text-black transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100">
                <svg x-show="!open" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                </svg>
                <svg x-show="open" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Desktop menu -->
            <div class="hidden lg:flex lg:items-center lg:ml-auto lg:space-x-10 py-6">
                <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="relative group">
                        <a href="<?php echo e($item->url); ?>"
                            class="text-lg font-medium text-black transition-all duration-200 hover:text-custom-green focus:text-custom-green font-nunitoSans">
                            <!-- Increased font size -->
                            <?php echo e($item->title); ?>

                        </a>
                        <?php if(!empty($item->children)): ?>
                            <!-- Dropdown Menu -->
                            <div
                                class="absolute left-0 hidden p-2 bg-white border border-gray-200 rounded-lg shadow-md group-hover:block z-50">
                                <!-- Ho aggiunto z-index qui -->
                                <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $subitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($subitem->url); ?>"
                                        class="block px-4 py-1 text-lg font-medium text-black transition-all duration-200 hover:text-custom-green focus:text-custom-green">
                                        <!-- Increased font size -->
                                        <?php echo e($subitem->title); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </nav>

        <!-- Mobile menu -->
        <nav x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-400"
            x-transition:enter-start="opacity-0 transform scale-95"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-95"
            class="absolute inset-x-0 mt-6 pt-4 pb-6 bg-white border border-gray-200 rounded-md shadow-md lg:hidden z-50">
            <div class="flow-root pl-12">
                <div class="flex flex-col flex-start px-3 space-y-4 pt-2">
                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex flex-col flex-start justify-between w-full">

                            <a href="<?php echo e($item->url); ?>"
                                class="text-lg font-medium text-black transition-all duration-200 hover:text-custom-green focus:text-custom-green font-nunitoSans">
                                <!-- Increased font size -->
                                <?php echo e($item->title); ?>

                            </a>

                            <!-- Submenu for mobile -->
                            <?php if(!empty($item->children)): ?>
                                <!-- Dropdown Menu -->
                                <div
                                    class="absolute left-0 hidden mt-2 px-2 py-4 bg-white border border-gray-200 rounded-lg shadow-md group-hover:block z-50">
                                    <!-- Ridotto space-y a 1 e aggiunto p-2 al contenitore -->
                                    <?php $__currentLoopData = $item->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subkey => $subitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e($subitem->url); ?>"
                                            class="block px-4 py-2 text-lg font-medium text-black transition-all duration-200 hover:text-custom-green focus:text-custom-green">
                                            <?php echo e($subitem->title); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </nav>
    </div>
</header>
<?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/partials/header-menu.blade.php ENDPATH**/ ?>