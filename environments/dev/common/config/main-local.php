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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            'messageConfig' => [
                'from' => ['support@example.com' => 'ER-Telecom']
            ],
        ],
    ],
];
