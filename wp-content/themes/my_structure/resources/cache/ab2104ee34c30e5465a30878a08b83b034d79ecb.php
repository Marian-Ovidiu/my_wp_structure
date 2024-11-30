<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Sito ufficiale PAC - Project Africa Conservation, dedicato alla protezione della fauna e allo sviluppo sociale.'); ?>">
    <title><?php echo $__env->yieldContent('title', 'PAC - Project Africa Conservation'); ?></title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <?php echo $__env->yieldContent('head'); ?>
</head>
<body class="flex flex-col min-h-screen font-nunitoSansRegular">
   <?php wp_head(); ?>
    <?php the_widget('Widget\MenuWidget', ['menu_name' => 'LanguageMenu']); ?>
    <?php switch(pll_current_language()):
        case ('it'): ?>
            <?php the_widget('Widget\MenuWidget', ['menu_name' => 'HeaderMenu']); ?>
            <?php break; ?>
        <?php case ('en'): ?>
            <?php the_widget('Widget\MenuWidget', ['menu_name' => 'HeaderMenuEnglish']); ?>
            <?php break; ?>
        <?php case ('fr'): ?>
            <?php the_widget('Widget\MenuWidget', ['menu_name' => 'HeaderMenuFrancais']); ?>
            <?php break; ?>
        <?php case ('de'): ?>
            <?php the_widget('Widget\MenuWidget', ['menu_name' => 'HeaderMenuDeutsch']); ?>
            <?php break; ?>
        <?php default: ?>
            <?php the_widget('Widget\MenuWidget', ['menu_name' => 'HeaderMenu']); ?>
            <?php break; ?>
    <?php endswitch; ?>

    <main class="flex-grow main">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="text-white">
        <?php the_widget('Widget\MenuWidget', ['menu_name' => 'FooterMenu']); ?>
    </footer>
    <?php echo $__env->yieldContent('scripts'); ?>
   <?php wp_footer(); ?>
</body>
</html>
<?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/layouts/mainLayout.blade.php ENDPATH**/ ?>