<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateSupportRequest;

class UpdateSupportDTO
{
    public function __construct(
        public string $id,
        public string $subject,
        public string $status,
        public string $content,
    ) {}

    public static function makeFromRequest(StoreUpdateSupportRequest $request, string $id = null): self
    {
        return new self(
            $id ?? $request->id,
            $request->subject,
            'a',
            $request->content
        );
    }
}