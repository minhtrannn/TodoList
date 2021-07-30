<?php 
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'due_date' => $this->due_date,
            'status' => $this->status,
            'created_at' => $this->created_at->format("d/m/Y H:i:s"), 
        ];        
    }
}

?>