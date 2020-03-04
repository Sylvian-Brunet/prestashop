<?php

class BlogCategory extends ObjectModel
{
    public $id;

    /** @var int */
    public $id_blog_category;

    /** @var string */
    public $title;

    /** @var string */
    public $description;

    public static $definition = array(
        'table' => 'blog_category',
        'primary' => 'id_blog_category',
        'fields' => [
            'title' => [
                'type' => self::TYPE_STRING,
                'validate' => 'isString',
                'size' => 255,
                'required' => true
            ],
            'description' => [
                'type' => self::TYPE_STRING
            ],
        ],
    );
}