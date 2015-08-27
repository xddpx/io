<?php

return [
    '' => 'site/index',
    '<action:(signin|logout|request-password-reset|reset-password)>' => 'user/auth/<action>',
    '<action:reset-password>/<token>' => 'user/auth/<action>',
];

