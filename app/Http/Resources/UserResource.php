<?php

namespace App\Http\Resources;

use App\Enums\Status;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'first_name' => $this->resource->first_name,
            'last_name' => $this->resource->last_name,
            'email' => $this->resource->email,
            'type' => $this->resource->type,
            'status' => Status::tryFrom($this->resource->status)?->object(),
            'tenant_id' => $this->resource->tenant_id,
            $this->mergeWhen($this->resource->type !== UserType::ADMIN->value, [
                'is_completed_account' => $this->resource->is_completed_account,
            ]),
            'tenant' => new TenantResource($this->whenLoaded('tenant')),
            'created_at' => $this->resource->created_at?->format('Y-m-d H:i:s'),
        ];
    }
}
