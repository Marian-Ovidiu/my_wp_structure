<?php do_action('acf/input/admin_head'); ?>
<div class="wrap">
    <h1><?php echo esc_html($optionPage['page_title'] ?? get_admin_page_title()); ?></h1>
    <form method="post">
        <?php if (!empty($fieldGroups)): ?>
            <?php
            acf_form([
                'post_id' => $postId ?? 'option',
                'field_groups' => $fieldGroups,
                'submit_value' => $submitLabel ?? __('Save settings', 'my_structure'),
                'return' => false,
            ]);
            ?>
        <?php else: ?>
            <p><?php echo esc_html__('No ACF field groups configured for this options page.', 'my_structure'); ?></p>
        <?php endif; ?>
    </form>
</div>
<?php do_action('acf/input/admin_footer'); ?>
