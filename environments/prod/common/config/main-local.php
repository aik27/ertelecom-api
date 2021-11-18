<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=ertelecom_api',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8mb4',
            'on afterOpen' => function ($event) {
                $event->sender->createCommand("SET time_zone='Europe/Moscow';")->execute();
            },
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'messageConfig' => [
                'from' => ['support@example.com' => 'ER-Telecom']
            ],
        ],
    ],
];
