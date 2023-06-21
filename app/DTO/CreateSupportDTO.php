<?php

namespace App\DTO;
use App\Http\Requests\StoreUpdateSupportRequest;

class CreateSupportDTO
{
    public function __construct(
        public string $subject,
        public string $status,
        public string $content,
    ) {}

    public static function makeFromRequest(StoreUpdateSupportRequest $request): self
    {
        return new self(
            $request->subject,
            'Open',
            $request->content
        );
    }
}