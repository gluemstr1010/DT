<?php

declare(strict_types=1);

namespace gluemstr1010;

use DateTimeZone;

class DT
{
	public const TIMESTAMP_MILLIS = 'Y-m-d H:i:s.u';

	public $time;

	public $timezone;

	public static function create($time)
	{
		$obj = new self();
		$obj->time = $time;
		return $obj;
	}

	public function setTimezone(DateTimeZone|string|null $timezone = null): self
	{
		return parent::setTimezone($tz);
	}

	public function assignTimezone(DateTimeZone|string $timezone): self
	{
		return new self($capture, $tz);
	}

	public function areEquals($tz)
	{
		if ($this->timezone == $tz) {
			return true;
		}
		return false;
	}
}
