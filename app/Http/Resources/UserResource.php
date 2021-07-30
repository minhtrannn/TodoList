<?php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            // 'id' => $this->id,
            'username' => $this->username,
            'email' => $this->email,
            'created_at'=>$this->created_at->format("d/m/Y H:i:s")
        ];
    }
}
?>