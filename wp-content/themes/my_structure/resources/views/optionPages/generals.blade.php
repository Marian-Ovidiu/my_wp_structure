<?php do_action('acf/input/admin_head');?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <form method="post">
        <?php
        if (class_exists(\Models\Options\OpzioniGlobaliFields::class)) {
            $options = \Models\Options\OpzioniGlobaliFields::get();
            acf_form([
                'post_id' => 'options',
                'field_groups' => [$options->getGroupKey()],
                'submit_value' => __('Save settings', 'my_structure'),
                'return' => false,
            ]);
        } else {
            echo '<p>' . esc_html__('No options group is currently configured.', 'my_structure') . '</p>';
        }
        ?>
    </form>
</div>
<?php do_action('acf/input/admin_footer');?>
