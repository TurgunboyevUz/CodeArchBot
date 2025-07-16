<?php
namespace Bot\Handler;

use App\Traits\Regexable;
use SergiX44\Nutgram\Nutgram;

class BusinessHandler
{
    use Regexable;

    public array $onText     = [];
    public array $onCallback = [];

    public function onCommand($pattern, $callable, $prefix = '!')
    {
        $this->onText[$prefix . $pattern] = $callable;

        return $this;
    }

    public function onText($pattern, $callable)
    {
        $this->onText[$pattern] = $callable;

        return $this;
    }

    public function onCallback($callback, $callable)
    {
        $this->onCallback[$callback] = $callable;

        return $this;
    }

    public function resolve(Nutgram $bot)
    {
        if ($bot->isCallbackQuery()) {
            return $this->resolveCallback($bot);
        }

        return $this->resolveMessage($bot);
    }

    public function resolveMessage(Nutgram $bot)
    {
        $text = $bot->message()?->text;
        if (empty($text)) {
            return;
        }

        foreach ($this->onText as $pattern => $callable) {
            $params = $this->regex($pattern, $text);

            if ($params !== null) {
                [$class, $method] = $callable;

                app($class)->$method($bot, ...array_values($params));
                return;
            }
        }
    }

    public function resolveCallback(Nutgram $bot)
    {
        $callback = $bot->callbackQuery()->data;
        if (empty($callback)) {
            return;
        }

        if (isset($this->onCallback[$callback])) {
            [$class, $method] = $this->onCallback[$callback];
            app($class)->$method($bot);
            return;
        }
    }
}
