<?php

return [
    '' => 'site/index',
    '<action:(signin|signup|logout|request-password-reset|reset-password)>' => 'user/auth/<action>',
    '<action:reset-password>/<token>' => 'user/auth/<action>',
    'document' => 'io/default/index',
    'document/<action:(index|create|update|delete)>' => 'io/default/<action>',
    'document/<action:(update|delete)>/<id>' => 'io/default/<action>',
    'stream/document/<action:(connection)>' => 'io/document/<action>',
//    'stream/document/<action:(update|delete)>/<id>' => 'io/default/<action>',
];

