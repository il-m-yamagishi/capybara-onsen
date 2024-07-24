<?php declare(strict_types=1);

/**
 * Class Logger
 * @package CapybaraOnsen\log
 * @author Masaru Yamagishi <akai_inu@live.jp>
 * @license Apache-2.0
 */

namespace CapybaraOnsen\Log;

/**
 * Write log message to anywhere
 */
interface WriterInterface
{
    /**
     * Write log message
     * @param RFC5424LogLevel $logLevel log level
     * @param string $message Message line
     * @param array $context Message context
     * @return void
     */
    function write(RFC5424LogLevel $logLevel, string $message, array $context): void;
}
