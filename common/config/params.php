<?php
return [
    'adminEmail' => 'admin@'.getenv('MAILGUN_DOMAIN'),
    'supportEmail' => 'support@'.getenv('MAILGUN_DOMAIN'),
    'senderEmail' => 'noreply@'.getenv('MAILGUN_DOMAIN'),
    'senderName' => 'mailer',
    'user.passwordResetTokenExpire' => 3600,
    'GoogleJsAPI' => getenv('GOOGLE_JS_API'),
    'GoogleServerAPI' => getenv('GOOGLE_SERVER_API'),
    'GoogleAnalytics' => getenv('GOOGLE_ANALYTICS'),
];
