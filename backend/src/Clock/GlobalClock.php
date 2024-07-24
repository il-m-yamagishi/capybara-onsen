<?php declare(strict_types=1);

/**
 * Class ClockTest
 * @package CapybaraOnsen\Clock
 * @author Masaru Yamagishi <akai_inu@live.jp>
 * @license Apache-2.0
 */

namespace CapybaraOnsen\Clock;

use DateTimeImmutable;
use DateTimeZone;
use Psr\Clock\ClockInterface;
use RuntimeException;

/**
 * Represents customized global time
 */
class GlobalClock implements ClockInterface
{
    use AsCarbonImmutableTrait;
    use AsChronosTrait;

    protected static ?GlobalClock $global_instance = null;

    private function __construct(
        private readonly ClockInterface $instance,
        private readonly ?DateTimeZone $timezone,
    ) {
        static::$global_instance = $this;
    }

    public static function setGlobalClock(ClockInterface $instance, ?DateTimeZone $timezone = null, ?bool $force = false): void
    {
        if ($force === false && static::$global_instance !== null) {
            throw new RuntimeException("Global clock is already set");
        }

        static::$global_instance = new GlobalClock($instance, $timezone);
    }

    public static function getGlobalClock(): ClockInterface
    {
        if (static::$global_instance === null) {
            throw new RuntimeException("Global clock is not set");
        }

        return static::$global_instance;
    }

    public static function clearGlobalClock(): void
    {
        static::$global_instance = null;
    }

    /**
     * {@inheritDoc}
     */
    public function now(): DateTimeImmutable
    {
        $now = $this->instance->now();

        if ($this->timezone !== null) {
            return $now->setTimezone($this->timezone);
        }

        return $now;
    }
}
