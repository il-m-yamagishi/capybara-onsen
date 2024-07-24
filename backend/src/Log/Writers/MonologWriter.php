<?php declare(strict_types=1);

/**
 * Class Logger
 * @package CapybaraOnsen\log
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
        return match ($logLevel) => {
            self::EMERGENCY => Level::Emergency,
            self::ALERT => Level::Alert,
            self::CRITICAL => Level::Critical,
            self::ERROR => Level::Error,
            self::WARNING => Level::Warning,
            self::NOTICE => Level::Notice,
            self::INFO => Level::Info,
            self::DEBUG => Level::Debug,
        }
    }
}
