<?php

namespace Models;

use Core\Bases\BasePostType;

class Progetto extends BasePostType
{
    public static $postType = 'progetto';
    public $name;
    public $titoloProgetto;
    public function __construct($post = null)
    {
        parent::__construct($post);
    }
    function defineOtherAttributes($post)
    {
        $this->name = get_field('name', $this->id);
        $this->titoloProgetto = get_field('titolo_card', $this->id);
    }
}