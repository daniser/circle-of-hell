<?php

declare(strict_types=1);

if (! function_exists('__recurring')) {
    function __recurring(int $limit = 1): int
    {
        $times = 0;

        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        array_shift($trace);
        $invokerFrame = array_shift($trace);

        foreach ($trace as $currentFrame) {
            $sameScope = ($currentFrame['class'] ?? '') === ($invokerFrame['class'] ?? '');
            $sameFunc = $currentFrame['function'] === $invokerFrame['function'];
            if ($sameScope && $sameFunc) {
                $times++;
                if ($times >= $limit) {
                    break;
                }
            }
        }

        return $times;
    }
}
