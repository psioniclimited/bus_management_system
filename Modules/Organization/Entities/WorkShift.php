<?php

namespace Modules\Organization\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkShift extends Model
{
	use SoftDeletes;

	protected $table = 'work_shift';
	
	public $timestamps = false;
	
	protected $dates = ['deleted_at'];

	protected $fillable = ['shift_name','start_from','end_to', 'time_duration'];


	public function getStartFromAttribute($value)
	{ 
		return \Carbon\Carbon::createFromFormat('H:m:s', $value)->format('h:i A');
	}

	public function setStartFromAttribute($value)
	{
		$this->attributes['start_from'] = \Carbon\Carbon::createFromFormat('h:i A',$value)->toTimeString();
	}

	public function getEndToAttribute($value)
	{ 
		return \Carbon\Carbon::createFromFormat('H:m:s', $value)->format('h:i A');
	}	

	public function setEndToAttribute($value)
	{
		$this->attributes['end_to'] = \Carbon\Carbon::createFromFormat('h:i A', $value)->toTimeString();
	}

 
	public function setTimeDurationAttribute($value){
		// var_dump($this->attributes['start_from']);
		// dd($this->attributes['end_to']);
		$start_from = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', '2000-01-01' . $this->attributes['start_from']);
		$end_to = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', '2000-01-01' . $this->attributes['end_to']);
		// $end_to = \Carbon\Carbon::createFromFormat('Y-m-d H:m:s', '2000-01-01' . $this->attributes['end_to']);

		var_dump($start_from);
		dd($end_to);

		$time_diff = $start_from->diffInMinutes($end_to);
		

		$difference=strtotime($this->attributes['end_to'])-strtotime($this->attributes['start_from']);
		$time_duration=date('H:i:s',$difference); 
		$this->attributes['time_duration'] = $time_duration;
	}
}