<?php

declare(strict_types=1);

namespace gluemstr1010;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;

class DT extends DateTimeImmutable
{
	public const TIMESTAMP_MILLIS = 'Y-m-d H:i:s.u';

	public $timezone;
	public $time;

	public static function create($time)
	{
		$obj = new self();
		$obj->time = $time;
		return $obj;
	}

	public function setTimezone(DateTimeZone|string|null $timezone = null): self
	{
		$tz = $timezone;

		if( is_string($timezone) ) {
			$tz = new DateTimeZone($timezone);
		}

		if($timezone === null) {
			$tz = date_default_timezone_get();
		}

		$k = parent::setTimezone($tz);

		return $k;
	}

	public function assignTimezone(DateTimeZone|string $timezone): self
	{
		$tz = $timezone;

		if( is_string($timezone) )
		{
			$tz = new DateTimeZone($timezone);
		}

		$k = $this->timezone = parent::setTimezone($tz);
		return $k;
	}

	public function areEquals($tz): bool
	{
		date_default_timezone_set($this->getTimezone()->getName());
		$d1date = strtotime($this->time);
		date_default_timezone_set("UTC");
		$d1UTC = date("Y-m-d H:i:s",$d1date);


		date_default_timezone_set($tz->getTimezone()->getName());
		$d2date = strtotime($tz->time);
		date_default_timezone_set("UTC");
		$d2UTC = date("Y-m-d H:i:s",$d2date);

		if ($d1UTC == $d2UTC) {
			return true;
		}
		return false;
	}
}
