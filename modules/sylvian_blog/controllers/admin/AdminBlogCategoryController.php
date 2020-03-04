<?php

class AdminBlogCategoryController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'blog_category';
        $this->className = 'BlogCategory';

        parent::__construct();

        $this->fields_list = [
            'id_blog_category' => [
                'title' => $this->trans('ID', [], 'Admin.Global')
            ],
            'title' => [
                'title' => $this->trans('Titre', [], 'Admin.Global')
            ],
            'description' => [
                'title' => $this->trans('Description', [], 'Admin.Global')
            ]
        ];
    }
}