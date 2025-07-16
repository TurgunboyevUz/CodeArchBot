<?php
namespace Bot\Handler;

use App\Traits\Regexable;
use Bot\Key\Keyboard;
use SergiX44\Nutgram\Nutgram;

class MainHandler
{
    public $message = [];

    use Keyboard, Regexable;

    public function onMessage(Nutgram $bot)
    {
        $business = new BusinessHandler;
        $business->onCommand('humo', [CommandHandler::class, 'humo']);
        $business->onCommand('uzcard', [CommandHandler::class, 'uzcard']);
        $business->onCommand('calc {expression}', [CommandHandler::class, 'calc']);

        $business->resolve($bot);
    }

    public function onEdit(Nutgram $bot)
    {
        //
    }
}
