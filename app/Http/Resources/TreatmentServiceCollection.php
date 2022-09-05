<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TreatmentServiceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'headers' => [
                [ 'text' => 'No', 'sortable' => false, 'value' => 'no', 'width' => '50'],
                [ 'text' => 'Code', 'sortable' => false, 'value' => 'code', 'align' => 'center'],
                [ 'text' => 'Name', 'sortable' => false, 'value' => 'name'],
                [ 'text' => 'Description', 'sortable' => false, 'value' => 'description'],
                [ 'text' => 'Actions', 'sortable' => false, 'value' => 'actions'],
            ]
        ];
    }
}
