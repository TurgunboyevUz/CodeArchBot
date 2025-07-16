<?php

namespace Bot\Handler;

use SergiX44\Nutgram\Nutgram;

class CommandHandler
{
    public function humo(Nutgram $bot)
    {
        sendMessage($bot, 'Humo: <code>9860 3401 0117 1437</code>');
    }

    public function uzcard(Nutgram $bot)
    {
        sendMessage($bot, 'UzCard: <code>8600 6127 3276 0045</code>');
    }

    public function calc(Nutgram $bot, $expression)
    {
        $expression = preg_replace('/[^0-9\+\-\*\/\(\)\.\s]/', '', $expression);

        $result = eval('return ' . $expression . ';');

        sendMessage($bot, $result);
    }
}