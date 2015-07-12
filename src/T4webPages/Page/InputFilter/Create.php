<?php

namespace T4webPages\Page\InputFilter;

use T4webBase\InputFilter\InputFilter;
use T4webBase\InputFilter\Element\Id;
use T4webBase\InputFilter\Element\Int;
use T4webBase\InputFilter\Element\Text;

class Create extends InputFilter
{
    public function __construct()
    {
        // title
        $title = new Text('title', 0, 255);
        $title->setRequired(true);
        $this->add($title);

        // body
        $body = new Text('body', 0, null);
        $body->setRequired(true);
        $this->add($body);
    }
}
