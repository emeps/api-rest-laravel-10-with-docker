<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateSupportRequest;

class CreateSupportDTO
{
    public function __construct(
        public string $subject,
        public string $content,
        public string $status = 'a'
    ) {
    }

    public static function makeFromRequest(StoreUpdateSupportRequest $request): self
    {
        return new self(
            $request->subject,
            'a',
            $request->status
        );
    }
}