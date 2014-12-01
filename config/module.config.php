<?php
return array(
    'router' => array(
        'routes' => array(
            'page-create' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/pages/create',
                    'defaults' => array(
                        'controller' => 'Pages\Controller\CreateController',
                        'action' => 'run',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_map' => array(//   'layout/layout' => __DIR__ . '/../view/page/layout/admin-layout.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
