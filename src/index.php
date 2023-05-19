<?php 

class DT
{

   public $time;
   public $timezone;

   public static function create($time)
   {
	$obj = new self();
	$obj->time = $time;
	return $obj;
   }

   public function assignTimezone($tz)
   {
	$this->timezone = $tz;
   }

   public function areEquals($tz)
   {
	if( $this->timezone == $tz )
	{
	   return true;
	}else{
	   return false;
	}
   }

}

$jp = DT::create("2020-09-17 07:00:00");
$jp->assignTimezone("Japan/Tokio");
$ny = DT::create("2020-09-17 20:00:00");
$ny->assignTimezone("America/New York");

echo var_dump($jp->areEquals($ny->timezone));
echo var_dump($jp->areEquals($jp->timezone));


?>
