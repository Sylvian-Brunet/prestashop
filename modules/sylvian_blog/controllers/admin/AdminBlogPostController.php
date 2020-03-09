<?php

class AdminBlogPostController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'blog_post';
        $this->className = 'BlogPost';

        parent::__construct();

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->fields_list = [
            'id_blog_post' => [
                'title' => $this->trans('ID', [], 'Admin.Global')
            ],
            'title' => [
                'title' => $this->trans('Titre', [], 'Admin.Global')
            ],
            'id_blog_category' => [
                'title' => $this->trans('Catégorie ID', [], 'Admin.Global')
            ],
            'excerpt' => [
                'title' => $this->trans('Résumé', [], 'Admin.Global')
            ],
            'content' => [
                'title' => $this->trans('Contenu', [], 'Admin.Global')
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
                    'type' => 'select',
                    'label' => 'Catégorie',
                    'name' => 'id_blog_category',
                    'options' => [
                        'query' =>
                            Db::getInstance()->executeS('SELECT id_blog_category, title FROM '. _DB_PREFIX_ . 'blog_category')
                        ,
                        'id' => 'id_blog_category',
                        'name' => 'title'
                    ],
                    'required' => true
                ],
                [
                    'type' => 'textarea',
                    'label' => 'Résumé',
                    'name' => 'excerpt',
                    'required' => true
                ],
                [
                    'type'  => 'textarea',
                    'label' => 'Contenu',
                    'name'  => 'content',
                    'autoload_rte' => true,
                    'required' => true,
                    'id' => 'content_content'
                ],
            ],
            'submit' => [
                'title' => $this->trans('Save', [],'Admin.Actions')
            ]
        ];
        return parent::renderForm();
    }
}