<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'access_token' => $this->resource->plainTextToken,
            'expires_in' => config('sanctum.expiration'),
            'expires_in_unit' => 'minute',
            'expires_at' => $this->resource->accessToken->expires_at?->timestamp ?: Carbon::now()->addMinutes((int)config('sanctum.expiration'))->timestamp
        ];
    }
}
