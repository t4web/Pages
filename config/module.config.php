<?php
return array(

    'router' => array(
        'routes' => array(
            'admin-page-new' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/pages/new',
                    'defaults' => array(
                        'controller' => 'T4webPages\Controller\Admin\PageController',
                        'action' => 'new',
                    ),
                ),
            ),
            'admin-page-create' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/pages/create',
                    'defaults' => array(
                        'controller' => 'T4webPages\Controller\Admin\PageController',
                        'action' => 'create',
                    ),
                ),
            ),
            'admin-pages' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/pages',
                    'defaults' => array(
                        'controller' => 'T4webPages\Controller\Admin\PagesController',
                        'action' => 'list',
                    ),
                ),
            ),
        ),
    ),

    'controller_action_injections' => array(
        'T4webPages\Controller\Admin\PageController' => array(
            'newAction' => array(
                'T4webPages\Controller\Admin\PageViewModel',
            ),
            'createAction' => array(
                'T4webPages\Controller\Admin\PageViewModel',
                function($serviceLocator, $targetController) {
                    return $targetController->getRequest()->getPost()->toArray();
                },
                'T4webPages\Page\Service\Create',
                function($serviceLocator, $targetController) {
                    return $targetController->redirect();
                },
            ),
        ),
        'T4webPages\Controller\Admin\PagesController' => array(
            'listAction' => array(
                'T4webPages\Controller\Admin\ListViewModel',
                function($serviceLocator, $targetController) {
                    return $serviceLocator->get('T4webPages\Page\Service\Finder');
                },
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'console' => array(
        'router' => array(
            'routes' => array(
                'pages-init' => array(
                    'options' => array(
                        'route'    => 'pages init',
                        'defaults' => array(
                            '__NAMESPACE__' => 'T4webPages\Controller\Console',
                            'controller' => 'Init',
                            'action'     => 'run'
                        )
                    )
                ),
            )
        )
    ),

    'db' => array(
        'tables' => array(
            't4webpages-page' => array(
                'name' => 'pages',
                'columnsAsAttributesMap' => array(
                    'id' => 'id',
                    'title' => 'title',
                    'body' => 'body',
                    'dt_created' => 'dtCreated',
                    'dt_updated' => 'dtUpdated',
                ),
            ),
        ),
    ),
    'criteries' => array(
        'Page' => array(
            'empty' => array('table' => 'pages'),
        ),
    ),
);
