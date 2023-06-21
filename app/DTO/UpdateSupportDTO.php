<?php

namespace App\DTO;

use App\Enums\SupportStatus;
use App\Http\Requests\StoreUpdateSupportRequest;

class UpdateSupportDTO
{
    public function __construct(
        public string $id,
        public string $subject,
        public SupportStatus $status,
        public string $content,
    ) {}

    public static function makeFromRequest(StoreUpdateSupportRequest $request, string $id = null): self
    {
        return new self(
            $id ?? $request->id,
            $request->subject,
            SupportStatus::OPEN,
            $request->content
        );
    }
}