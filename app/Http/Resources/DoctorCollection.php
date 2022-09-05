<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DoctorCollection extends ResourceCollection
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
                [ 'text' => 'Avatar', 'sortable' => false, 'value' => 'avatar', 'align' => 'center'],
                [ 'text' => 'First Name', 'sortable' => false, 'value' => 'first_name'],
                [ 'text' => 'Last Name', 'sortable' => false, 'value' => 'last_name'],
                [ 'text' => 'Phone', 'sortable' => false, 'value' => 'email'],
                [ 'text' => 'Email', 'sortable' => false, 'value' => 'email'],
                [ 'text' => 'Actions', 'sortable' => false, 'value' => 'actions'],
            ]
        ];
    }
}
