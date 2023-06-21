<?php

namespace App\Http\Controllers\Api;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Http\Resources\SupportResource;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function __construct(
        protected SupportService $service
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            perPage: $request->get('per_page', 15),
            filter: $request->filter
        );
        return SupportResource::collection($supports->items())->additional([
            'meta' => [
                'total' => $supports->total(),
                'is_first_page' => $supports->isFirstPage(),
                'is_last_page' => $supports->isLastPage(),
                'current_page' => $supports->currentPage(),
                'number_next_page' => $supports->getNumberNextPage(),
                'number_previous_page' => $supports->getNumberPreviousPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupportRequest $request)
    {
        $support = $this->service->new(CreateSupportDTO::makeFromRequest($request));

        return new SupportResource($support);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!$support = $this->service->findOne($id)) {
            return response()->json(['message' => 'Support not found'], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupportRequest $request, string $id)
    {
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request, $id));
        if(!$support) {
            return response()->json(['message' => 'Support not found'], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }

        return new SupportResource($support);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!$this->service->findOne($id)) {
            return response()->json(['message' => 'Support not found'], \Illuminate\Http\Response::HTTP_NOT_FOUND);
        }
        $this->service->delete($id);
        return response()->json([], \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
