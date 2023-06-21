<?php

namespace App\Adapters;

use App\Http\Resources\DefaultResource;
use App\Repositories\PaginationInterface;

class ApiAdapters{
    public static function toJson(
        PaginationInterface $data
    ){
        return DefaultResource::collection($data->items())->additional([
            'meta' => [
                'total' => $data->total(),
                'is_first_page' => $data->isFirstPage(),
                'is_last_page' => $data->isLastPage(),
                'current_page' => $data->currentPage(),
                'number_next_page' => $data->getNumberNextPage(),
                'number_previous_page' => $data->getNumberPreviousPage(),
            ]
        ]);
    }
}