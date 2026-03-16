<?php
namespace Controllers;

use Core\Bases\BaseController;
use WP_Query;

class PostController extends BaseController
{
    public function archive()
    {
        $query = new WP_Query([
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => get_option('posts_per_page'),
            'paged' => max(1, (int) get_query_var('paged')),
        ]);

        $this->render('pages.generic-archive', [
            'title' => get_the_archive_title(),
            'posts' => $query->get_posts(),
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
            'author' => get_the_author_meta('display_name', $post->post_author),
            'date' => get_the_date('', $post),
        ]);
    }

}
