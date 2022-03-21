<?php

return [
    'enable' => env('TG_INFO_BUGS_ENABLE', false),
    'api_token' => env('TG_INFO_BUGS_TOKEN'),
    'api_url' => env('TG_INFO_BUGS_URL', 'https://tg-info.forumbase.net/api/'),
    'channels' => env('TG_INFO_BUGS_CHANNELS')
];
