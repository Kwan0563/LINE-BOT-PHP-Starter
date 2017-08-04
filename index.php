<?php

$accessToken = '7c+ImaVslAA9wD7zMWNjhOp8ytN2aQSGObYR0bdPF8h+rquZbaj2lwbN1Wu5gvv6GgOJCdshGRc1BL7Ugd0EfPncKufz0/gq0/1nqIn7t8quV5fIau1JTwmOckAOYVVpNdLtUFY7Tj7eWyr9imyXjgdB04t89/1O/w1cDnyilFU=';
$jsonString = file_get_contents('php://input');
error_log($jsonString);
$jsonObj = json_decode($jsonString);

$message = $jsonObj->{"events"}[0]->{"message"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};


if ($message->{"text"} == 'a') {    
    $messageData = [
        'type' => 'template',
        'altText' => 'testtt',
        'template' => [
            'type' => 'confirm',
            'text' => 'ttttttt',
            'actions' => [
                [
                    'type' => 'message',
                    'label' => 'tttt',
                    'text' => 'tttt'
                ],
                [
                    'type' => 'message',
                    'label' => 'tttt',
                    'text' => 'tttt'
                ],
            ]
        ]
    ];
} elseif ($message->{"text"} == '1') {
    
    $messageData = [
        'type' => 'text',
        'text' => 'Hello',
    ];
}elseif ($message->{"text"} == 'b') {
    
    $messageData = [
        'type' => 'template',
        'altText' => 'tttt',
        'template' => [
            'type' => 'buttons',
            'title' => 'ttt',
            'text' => 'ttttt',
            'actions' => [
                [
                    'type' => 'postback',
                    'label' => 'ttttt',
                    'data' => 'value'
                ],
                [
                    'type' => 'uri',
                    'label' => 'ttttt',
                    'uri' => 'https://google.com'
                ]
            ]
        ]
    ];
} elseif ($message->{"text"} == 'c') {
    $messageData = [
        'type' => 'template',
        'altText' => 'ttt',
        'template' => [
            'type' => 'carousel',
            'columns' => [
                [
                    'title' => 'ttt',
                    'text' => 'ttt',
                    'actions' => [
                        [
                            'type' => 'postback',
                            'label' => 'ttt',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'uri',
                            'label' => 'tttt',
                            'uri' => 'http://clinic.e-kuchikomi.info/'
                        ]
                    ]
                ],
                [
                    'title' => 'ttt',
                    'text' => 'ttt',
                    'actions' => [
                        [
                            'type' => 'postback',
                            'label' => 'webhookにpost送信',
                            'data' => 'value'
                        ],
                        [
                            'type' => 'uri',
                            'label' => '女美会を見る',
                            'uri' => 'https://jobikai.com/'
                        ]
                    ]
                ],
            ]
        ]
    ];
} else {
    $messageData = [
        'type' => 'text',
        'text' => $message->{"text"}
    ];
}

$response = [
    'replyToken' => $replyToken,
    'messages' => [$messageData]
];
error_log(json_encode($response));

$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
));
$result = curl_exec($ch);
error_log($result);
curl_close($ch);
