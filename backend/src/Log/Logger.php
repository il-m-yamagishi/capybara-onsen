<?php declare(strict_types=1);

/**
 * Class Logger
 * @package CapybaraOnsen\log
 * @author Masaru Yamagishi <akai_inu@live.jp>
 * @license Apache-2.0
 */

namespace CapybaraOnsen\Log;

use Psr\Log\AbstractLogger;
use Stringable;

/**
 * PSR-3 compatible Logger
 */
class Logger extends AbstractLogger
{
    /** singleton instance */
    protected static ?Logger $global_instance = null;

    /**
     * @param WriterInterface[] $writers
     */
    public function __construct(
        private readonly array $writers,
    ) {
    }

    /**
     * Set singleton instance
     * @param Logger $instance
     * @return void
     * @throws \RuntimeException when instance is already set
     */
    public static function setInstance(Logger $instance): void
    {
        if (static::$global_instance !== null) {
            throw new \RuntimeException("Logger instance is already set");
        }
        static::$global_instance = $instance;
    }

    /**
     * Get singleton instance
     * @return static
     * @throws \RuntimeException when instance is not set
     *
     * ```php
     * Logger::getInstance()->info("Message", compact('context'));
     * ```
     */
    public static function getInstance(): static
    {
        if (static::$global_instance === null) {
            throw new \RuntimeException("Logger instance is not set");
        }

        return static::$global_instance;
    }

    /**
     * Clear singleton instance
     * @return void
     */
    public static function clearInstance(): void
    {
        static::$global_instance = null;
    }

    /**
     * {@inheritDoc}
     */
    public function log($level, string|Stringable $message, array $context = []): void
    {
        // TODO
    }
}
