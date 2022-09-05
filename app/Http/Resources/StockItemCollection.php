<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StockItemCollection extends ResourceCollection
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
                [ 'text' => 'avatar', 'sortable' => false, 'value' => 'avatar', 'align' => 'center'],
                [ 'text' => 'Code', 'sortable' => false, 'value' => 'code'],
                [ 'text' => 'stock', 'sortable' => false, 'value' => 'stock'],
                [ 'text' => 'description', 'sortable' => false, 'value' => 'description'],
                [ 'text' => 'Actions', 'sortable' => false, 'value' => 'actions'],
            ]
        ];
    }
}
