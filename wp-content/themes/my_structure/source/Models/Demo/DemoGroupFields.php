<?php

namespace Models\Demo;

use Core\Bases\BaseGroupAcf;

class DemoGroupFields extends BaseGroupAcf
{
    protected $groupKey = 'group_demo_theme_options';

    public $headline;
    public $subheadline;

    public function __construct($postId = null)
    {
        parent::__construct($this->groupKey, $postId ?? 'option');
        $this->defineAttributes();
    }

    public function defineAttributes()
    {
        $this->addField('headline');
        $this->addField('subheadline');
    }
}
