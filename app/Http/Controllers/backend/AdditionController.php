<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdditionRequest;
use App\Models\RoomAdditionalPrice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of additions';
        $additions = RoomAdditionalPrice::paginate(10);

        return view('backend.pages.additions.index', compact('additions', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $page = 'Edit additions';
        return view('backend.pages.additions.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AdditionRequest $request
     * @return Response
     */
    public function store(AdditionRequest $request)
    {
        $validated = $request->validated();
        RoomAdditionalPrice::create($validated);

        return redirect()->back()->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = 'Edit addition';
        $addition = RoomAdditionalPrice::find($id);
        return view('backend.pages.additions.edit', compact('addition', 'page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AdditionRequest $request
     * @param int $id
     * @return Response
     */
    public function update(AdditionRequest $request, int $id)
    {
        $addition = RoomAdditionalPrice::find($id);
        $validated = $request->validated();
        $addition->update($validated);

        return redirect()->back()->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {

        RoomAdditionalPrice::find($id)->delete();

        return redirect()->route('addition.index')->with('success', 'Success');
    }
}
