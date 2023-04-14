<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialStoreRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use App\Models\Testimonial;
use App\Models\TestimonialTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of testimonial';
        $testimonials = TestimonialTranslation::with('parentTestimonial')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.testimonial.index', compact('testimonials', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create testimonial';
        $languages = config('translatable.locales');
        return view('backend.pages.testimonial.create', compact('page','languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TestimonialStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TestimonialStoreRequest $request)
    {
        $lang = config('translatable.locales');

        $validated = $request->validated();
        $data = [];
        $translate_data = [];
        $data['star'] = $validated['star'];
        $data['status'] = $validated['status'];


        try {
            DB::beginTransaction();

            $validated['testimonial_id'] = Testimonial::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'full_name' => $validated['full_name'][$i],
                    'comment' => $validated["comment"][$i],
                    'testimonial_id' => $validated['testimonial_id']
                ];
                array_push($translate_data, $datas);
            }

            TestimonialTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Failed operation");
        }
        return redirect()->back()->with('success', 'Created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id)
    {
        $page = 'Edit testimonial';
        $languages = config('translatable.locales');
        $testimonials = TestimonialTranslation::with('parentTestimonial')->where(['testimonial_id' => $id])->get();

        return view('backend.pages.testimonial.edit', compact('testimonials', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TestimonialUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TestimonialUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = TestimonialTranslation::find($id);
        $testimonial_id = $translation->testimonial_id;
        $testimonial = Testimonial::find($testimonial_id);
        $validated = $request->validated();
        $data = [];
        $data['star'] = $validated['star'];
        $data['status'] = $validated['status'];

        try {
            DB::beginTransaction();
            $testimonial->update($data);
            $translation->update($validated);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', "Failed operation");
        }

        return redirect()->back()->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Testimonial $testimonial
     * @return RedirectResponse
     */
    public function destroy(Testimonial $testimonial)
    {
        $delete = $testimonial->delete();
        if ($delete) {
            return redirect()->route('testimonial.index')->with('success', 'Success');
        }
        return redirect()->route('testimonial.index')->with('error', 'Failed operation');
    }
}
