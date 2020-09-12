<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param \Illuminate\Http\Request $request
	 *
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'is_mine'          => auth()->check() ? auth()->id() === $this->user_id : false,
			'id'               => $this->id,
			'name'             => $this->name,
			'description'      => $this->description,
			'type'             => $this->type,
			'private'          => $this->private,
			'extension'        => $this->extension,
			'thumb'            => $this->file('thumb'),
			'size'             => $this->formatSizeUnits(),
			'status'           => $this->status,
			'meta'             => $this->meta,
			'created_at'       => $this->created_at,
			'views'            => $this->when(isset($this->views_count), $this->views_count),
			'favourited'       => $this->when(isset($this->favourited), $this->favourited),
			'total_favourites' => $this->when(isset($this->total_favourites), $this->total_favourites),
		];
	}
}
