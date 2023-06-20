<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupportRequest;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function __construct(
        private readonly Support $support
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supports = $this->support->all();
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
        $data = $request->all();
        $data['status'] = 'a';
        $this->support->create($data);
        return redirect()->route('supports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string | int $id)
    {
        if (!$support = $this->support->find($id)) {
            return back();
        }
        $support = $this->support->find($id);
        return view('admin.supports.show', compact('support'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string | int $id)
    {
        if (!$support = $this->support->find($id)) {
            return back();
        }
        $support = $this->support->find($id);
        return view('admin.supports.edit', compact('support'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateSupportRequest $request, string | int $id)
    {
        if (!$this->support->find($id)) {
            return back();
        }
        $data = $request->all();
         $this->support->find($id)->update($data);
        return redirect()->route('supports.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string | int $id)
    {
        if (!$this->support->find($id)) {
            return back();
        }
        $this->support->find($id)->delete();
        return redirect()->route('supports.index');
    }
}
