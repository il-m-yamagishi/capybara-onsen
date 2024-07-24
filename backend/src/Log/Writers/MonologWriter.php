<?php

declare(strict_types=1);

/**
 * Class Logger
 * @package CapybaraOnsen\Log\Writers
 * @author Masaru Yamagishi <akai_inu@live.jp>
 * @license Apache-2.0
 */

namespace CapybaraOnsen\Log\Writers;

use CapybaraOnsen\Log\RFC5424LogLevel;
use CapybaraOnsen\Log\WriterInterface;
use Monolog\Level;
use Monolog\Logger;

/**
 * Use monolog/monolog as writer
 * @see https://github.com/Seldaek/monolog/
 *
 * ```php
 * $logger = new \Monolog\Logger('appname');
 * $logger->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout'));
 * $writer = new \CapybaraOnsen\Log\Writers\MonologWriter($logger);
 * $logger = new \CapybaraOnsen\Log\Logger([$writer]);
 * $logger->info('Hello');
 * ```
 */
class MonologWriter implements WriterInterface
{
    public function __construct(private readonly Logger $logger)
    {
    }

    /**
     * Get Monolog instance
     * @return Logger
     */
    public function getMonologLogger(): Logger
    {
        return $this->logger;
    }

    /**
     * {@inheritDoc}
     */
    public function write(RFC5424LogLevel $logLevel, string $message, array $context): void
    {
        $this->logger->log($this->convertLogLevel($logLevel), $message, $context);
    }

    private function convertLogLevel(RFC5424LogLevel $logLevel): Level
    {
        return match ($logLevel) {
            RFC5424LogLevel::EMERGENCY => Level::Emergency,
            RFC5424LogLevel::ALERT => Level::Alert,
            RFC5424LogLevel::CRITICAL => Level::Critical,
            RFC5424LogLevel::ERROR => Level::Error,
            RFC5424LogLevel::WARNING => Level::Warning,
            RFC5424LogLevel::NOTICE => Level::Notice,
            RFC5424LogLevel::INFO => Level::Info,
            RFC5424LogLevel::DEBUG => Level::Debug,
        };
    }
}
