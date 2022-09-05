<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StockRequestCollection extends ResourceCollection
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
                [ 'text' => 'Request Date', 'sortable' => false, 'value' => 'request_date', 'align' => 'center'],
                [ 'text' => 'Date', 'sortable' => false, 'value' => 'created_at', 'align' => 'center'],
                [ 'text' => 'Inputter', 'sortable' => false, 'value' => 'user', 'align' => 'center'],
                [ 'text' => 'Note', 'sortable' => false, 'value' => 'note'],
                [ 'text' => 'Actions', 'sortable' => false, 'value' => 'actions'],
            ]
        ];
    }
}
