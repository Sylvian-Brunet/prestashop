<?php

class AdminBlogCategoryController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'blog_category';
        $this->className = 'BlogCategory';

        parent::__construct();

        $this->addRowAction('edit');
        $this->addRowAction('delete');

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

    public function renderForm()
    {
        $this->fields_form = [
            'input' => [
                [
                    'type'     => 'text',
                    'label'    => 'Titre',
                    'name'     => 'title',
                    'required' => true
                ],
                [
                    'type'  => 'textarea',
                    'label' => 'Description',
                    'name'  => 'description',
                    'required' => true
                ],
            ],
            'submit' => [
                'title' => $this->trans('Save', [],'Admin.Actions')
            ]
        ];
        return parent::renderForm();
    }
}