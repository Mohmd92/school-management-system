<?php

namespace App\Http\Controllers\Sections;

use App\Http\Requests\StoreSectionsRequest;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $grades = Grade::with('sections')->get();
        $grades_list = Grade::all();
        $teachers = Teacher::all();
//        $db = DB::table('teachers_sections')->where('section_id', '=', '5')->get();
        return view('pages.sections.sections', compact('grades', 'grades_list', 'teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionsRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSectionsRequest $request)
    {
        try {
            $validated = $request->validated();
            $section = new Section();
            $section->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $section->grade_id = $request->grade_id;
            $section->classroom_id = $request->classroom_id;
            $section->status = 1;
            $section->save();
            $section->teachers()->attach($request->teacher_ids);
            toastr()->success(trans('messages.success'));

            return redirect()->route('sections.index');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreSectionsRequest $request
     * @return RedirectResponse
     */
    public function update(StoreSectionsRequest $request)
    {
        try {
            $validated = $request->validated();
            $sections = Section::findOrFail($request->id);

            $sections->name = ['ar' => $request->name_ar, 'en' => $request->name_en];
            $sections->grade_id = $request->grade_id;
            $sections->classroom_id = $request->classroom_id;

            if (isset($request->status)) {
                $sections->status = 1;
            } else {
                $sections->status = 2;
            }

            //Update pivot table
            if (isset($request->teacher_ids)) {
                $sections->teachers()->sync($request->teacher_ids);
            } else {
                $sections->teachers()->sync(array());
            }

            $sections->save();
            toastr()->success(trans('messages.update'));

            return redirect()->route('sections.index');

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        Section::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('sections.index');
    }

    public function getGradeClasses($id)
    {
        $classes_list = Classroom::where("grade_id", $id)->pluck("name", "id");
        return $classes_list;
    }
}

?>
