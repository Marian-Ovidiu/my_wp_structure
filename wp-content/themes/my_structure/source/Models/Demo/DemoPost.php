<?php

namespace Models\Demo;

use Core\Bases\BasePostType;

class DemoPost extends BasePostType
{
    public static $postType = 'post';

    public $summary;

    public function defineOtherAttributes($post)
    {
        $this->summary = wp_trim_words(strip_tags((string) ($post->post_content ?? '')), 30);
    }
}
