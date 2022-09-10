<?php

namespace App\Http\Resources;

use App\Http\Controllers\Api\V1\LoginController;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;

class LoginResource extends JsonResource
{
    private string $token;

//    public function __construct($resource, string $token)
//    {
//        parent::__construct($resource);
//        $this->token = $token;
//    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ID' => $this->id,
            'First Name' => $this->first_name,
            'Last Name' => $this->last_name,
            'Email' =>$this->email,
//            'token' => $this->token,
        ];
    }
}
