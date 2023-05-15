<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VersionResource extends JsonResource
{
	public static $wrap = 'Resource';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
      //  return parent::toArray($request);
		return [
			'title' => $this->title,
			'release_data' => $this->release_data->format('d.m.Y'),
			'meta' => $this->when($this->title == '8.61', function(){
				return 'Версия 8.61'; 
			}, function(){
				return 'Версия 8.61 не найдена';
			}),
		];
    }
}
