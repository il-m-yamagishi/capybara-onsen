<?php

declare(strict_types=1);

/**
 * Class Uri
 * @package CapybaraOnsen\HttpMessage
 * @author Masaru Yamagishi <akai_inu@live.jp>
 * @license Apache-2.0
 */

namespace CapybaraOnsen\HttpMessage;

use InvalidArgumentException;

/**
 * Seriously malformed URI has provided
 * @package CapybaraOnsen\HttpMessage
 */
class MalformedUriException extends InvalidArgumentException
{
}
