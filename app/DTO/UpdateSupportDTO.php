<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateSupportRequest;

class UpdateSupportDTO
{
    public function __construct(
        public string $subject,
        public string $content,
        public string $status = 'a',
        public string | int $id
    ) {
    }

    public static function makeFromRequest(StoreUpdateSupportRequest $request): self
    {
        return new self(
            $request->subject,
            'a',
            $request->status,
            $request->id
        );
    }
}