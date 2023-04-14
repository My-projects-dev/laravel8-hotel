<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;
use App\Models\Team;
use App\Models\TeamTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = 'List of team';
        $teams = TeamTranslation::with('parentTeam')->where('language', 'az')->orderBy('id', 'DESC')->paginate(10);
        return view('backend.pages.team.index', compact('teams', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $page = 'Create team info';
        $languages = config('translatable.locales');
        return view('backend.pages.team.create', compact('page', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TeamStoreRequest $request
     * @return RedirectResponse
     */
    public function store(TeamStoreRequest $request)
    {
        $lang = config('translatable.locales');

        $validated = $request->validated();
        $data = [];
        $translate_data = [];
        $data['status'] = $validated['status'];
        $data['email'] = $validated['email'];
        $data['facebook'] = $validated['facebook'];
        $data['twitter'] = $validated['twitter'];
        $data['linkedin'] = $validated['linkedin'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/teams'), $imageName);
                $data['image'] = $imageName;
            }
            $validated['team_id'] = Team::create($data)->id;

            for ($i = 0; $i < count($lang); $i++) {
                $datas = [
                    'language' => $lang[$i],
                    'position' => $validated['position'][$i],
                    'full_name' => $validated["full_name"][$i],
                    'team_id' => $validated['team_id']
                ];
                array_push($translate_data, $datas);
            }

            TeamTranslation::insert($translate_data);
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            if (File::exists(public_path('uploads/teams/' . $data['image']))) {
                File::delete(public_path('uploads/teams/' . $data['image']));
            }

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
        $page = 'Edit team';
        $languages = config('translatable.locales');
        $teams = TeamTranslation::with('parentTeam')->where(['team_id' => $id])->get();

        return view('backend.pages.team.edit', compact('teams', 'page', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeamUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TeamUpdateRequest $request, int $id): RedirectResponse
    {
        $translation = TeamTranslation::find($id);
        $team_id = $translation->team_id;
        $team = Team::find($team_id);
        $validated = $request->validated();
        $data = [];
        $data['status'] = $validated['status'];
        $data['email'] = $validated['email'];
        $data['facebook'] = $validated['facebook'];
        $data['twitter'] = $validated['twitter'];
        $data['linkedin'] = $validated['linkedin'];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imageName = rand(1, 10000) . time() .'.'. $request->image->getClientOriginalExtension();
                $request->image->move(public_path('uploads/teams'), $imageName);
                $data['image'] = $imageName;

                $old_img = $team->image;
            }

            $team->update($data);
            $translation->update($validated);

            if ($team->wasChanged('image')) {
                if (File::exists(public_path('uploads/teams/' . $old_img))) {
                    File::delete(public_path('uploads/teams/' . $old_img));
                }
            }
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
     * @param Team $team
     * @return Response
     */
    public function destroy(Team $team)
    {
        $old_img = $team->image;
        $team->delete();
        if (File::exists(public_path('uploads/teams/' . $old_img))) {
            File::delete(public_path('uploads/teams/' . $old_img));
        }

        return redirect()->route('team.index')->with('success', 'Success');
    }
}
