<?php

namespace App\Http\Controllers\Classrooms;

use App\Http\Requests\StoreClassroomsRequest;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $rooms = Classroom::all();
        $grades = Grade::all();
        return view('pages.classrooms.classrooms', compact('rooms', 'grades'));
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
     * @return Response
     */
    public function store(StoreClassroomsRequest $request)
    {
        $classes_list = $request->classes_list;

        try {
            $validated = $request->validated();
            foreach ($classes_list as $class_list) {

                $my_room = new Classroom();

                $my_room->name = ['en' => $class_list['name_en'], 'ar' => $class_list['name']];

                $my_room->grade_id = $class_list['grade_id'];

                $my_room->save();
            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
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
     * @param int $id
     * @return Response
     */
    public function update(StoreClassroomsRequest $request)
    {
        try {
            $validated = $request->validated();
            $my_room = Classroom::findOrFail($request->id);

            $my_room->update([
                $my_room->name = ['ar' => $request->name, 'en' => $request->name_en],
                $my_room->grade_id = $request->grade_id,
            ]);

            toastr()->success(trans('messages.update'));
            return redirect()->route('classrooms.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $room = Classroom::findOrFail($request->id);
        $room->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('classrooms.index');
    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }

    public function filter_classes(Request $request)
    {
        $grades = Grade::all();
        $search = Classroom::select('*')->where('grade_id','=', $request->grade_id)->get();
        $selected_grade_id = $request->grade_id;
        return view('pages.classrooms.classrooms',compact('grades', 'selected_grade_id'))->withDetails($search);
    }
}

?>
