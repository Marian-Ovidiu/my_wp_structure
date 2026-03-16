<?php

namespace Controllers;

use Core\Bases\BaseController;
use WP_Query;

class ExampleController extends BaseController
{
    public function home()
    {
        $posts = get_posts([
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => 3,
        ]);

        $this->render('pages.home-demo', [
            'siteName' => get_bloginfo('name'),
            'siteDescription' => get_bloginfo('description'),
            'posts' => $posts,
        ]);
    }

    public function page()
    {
        global $post;

        $title = $post ? get_the_title($post) : get_bloginfo('name');
        $content = $post ? apply_filters('the_content', get_the_content(null, false, $post)) : '';

        $this->render('pages.generic-page', [
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function archive()
    {
        $postType = get_query_var('post_type');
        if (is_array($postType)) {
            $postType = reset($postType);
        }
        if (!$postType) {
            $postType = 'post';
        }

        $query = new WP_Query([
            'post_type' => $postType,
            'post_status' => 'publish',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => max(1, (int) get_query_var('paged')),
        ]);

        $this->render('pages.generic-archive', [
            'title' => get_the_archive_title(),
            'posts' => $query->posts,
        ]);
    }

    public function single()
    {
        global $post;

        if (!$post) {
            global $wp_query;
            $wp_query->set_404();
            status_header(404);
            nocache_headers();
            include get_404_template();
            return;
        }

        $this->render('pages.generic-single', [
            'title' => get_the_title($post),
            'content' => apply_filters('the_content', get_the_content(null, false, $post)),
            'date' => get_the_date('', $post),
            'author' => get_the_author_meta('display_name', $post->post_author),
        ]);
    }
}
