<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id'=> $this->user_id,
            'user_name'=> $this->user_name,
            // 'user_in'=> (new Carbon($this->user_in))->date_format('Y-m-d'),
            // 'user_out'=> (new Carbon($this->user_out))->date_format('Y-m-d'),
            // 'jam_masuk'=> $this->user_id,
            // 'tanggal_keluar' => $this->id,
            // 'jam_keluar' => $this->name,
            // 'durasi' => $this->description,
            // 'created_at' => (new Carbon($this->created_at))->format('Y-m-d'),
            // 'due_date' => (new Carbon($this->due_date))->format('Y-m-d'),
        ];
    }
}
