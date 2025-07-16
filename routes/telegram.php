<?php
/** @var SergiX44\Nutgram\Nutgram $bot */

use Bot\Handler\MainHandler;
use SergiX44\Nutgram\Nutgram;

$bot->onBusinessMessage([MainHandler::class, 'onMessage']);
$bot->onEditedBusinessMessage([MainHandler::class, 'onEdit']);
