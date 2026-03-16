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

        $this->render('archivio-post', [
            'fields' => (object) [
                'title_blog' => get_bloginfo('name'),
                'subtitle_blog' => get_bloginfo('description'),
            ],
            'posts' => $query->get_posts()
        ]);
    }

    public function single()
    {
        global $post;

        $this->render('singolo-post', [
            'post'    => $post,
            'title'   => get_the_title(),
            'content' => apply_filters('the_content', get_the_content()),
            'author'  => get_the_author(),
            'date'    => get_the_date(),
        ]);
    }

}
