<?php do_action('acf/input/admin_head');?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post">
        <?php
        $options = \Models\Options\OpzioniGlobaliFields::get();
        acf_form([
            'post_id'    => 'options',
            'field_groups' => [$options->getGroupKey()],
            'submit_value' => __('Salva le impostazioni', 'acf'),
            'return' => false,
        ]);
        ?>
    </form>
</div>
<?php do_action('acf/input/admin_footer');?>
<?php /**PATH /Users/editweb2/Sites/01progetti-test/pac/wp-content/themes/my_structure/resources/views/optionPages/generals.blade.php ENDPATH**/ ?>