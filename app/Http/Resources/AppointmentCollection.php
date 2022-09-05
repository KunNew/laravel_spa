<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AppointmentCollection extends ResourceCollection
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
                [ 'text' => 'No.', 'sortable' => false, 'value' => 'no'],
                [ 'text' => 'Patient', 'sortable' => false, 'value' => 'patient'],
                [ 'text' => 'Appoint date', 'sortable' => false, 'value' => 'appoint_date'],
                [ 'text' => 'Primary Phone number', 'sortable' => false, 'value' => 'patient.phone'],
                [ 'text' => 'Secodary Phone number', 'sortable' => false, 'value' => 'patient.sec_phone'],
                [ 'text' => 'Status', 'sortable' => false, 'value' => 'status'],
                [ 'text' => 'Actions', 'sortable' => false, 'value' => 'actions'],
            ],
            'config' => config('dental.appointment')
        ];
    }
}
