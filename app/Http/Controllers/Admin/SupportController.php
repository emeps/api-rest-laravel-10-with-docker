<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function __construct(
        private readonly Support $support,
        protected readonly SupportService $service,
        protected readonly CreateSupportDTO $dtoCreate,
        protected readonly UpdateSupportDTO $dtoUpdate
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supports = $this->service->getAll($request->filter);
        return view('admin.supports.index', compact('supports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateSupportRequest $request)
    {
        $this->service->new($this->dtoCreate->makeFromRequest($request));
        return redirect()->route('supports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string | int $id)
    {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin.supports.show', compact('support'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string | int $id)
    {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }
        return view('admin.supports.edit', compact('support'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupportRequest $request, string | int $id)
    {
        $support = $this->service->update($this->dtoUpdate->makeFromRequest($request));
        if(!$support) return back();
                
        return redirect()->route('supports.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string | int $id)
    {
        $this->service->delete($id);
        return redirect()->route('supports.index');
    }
}
