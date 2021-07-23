<?php


namespace App\Repositories\TeacherRepository;


use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Hash;

class Repository implements IRepository
{

    public function getAll()
    {
        // TODO: Implement getAll() method.
        return Teacher::all();
    }

    public function getSpecializations()
    {
        // TODO: Implement getSpecializations() method.
        return Specialization::all();
    }

    public function getGenders()
    {
        // TODO: Implement getGenders() method.
        return Gender::all();
    }

    public function storeTeacher($request)
    {
        // TODO: Implement storeTeacher() method.
        try {
            $teacher = new Teacher();
            $teacher->email = $request->email;
            $teacher->password =  Hash::make($request->password);
            $teacher->name = ['en' => $request->name_en, 'ar' => $request->name];
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->joining_date = $request->joining_date;
            $teacher->address = $request->address;
            $teacher->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('teachers.create');
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function editTeacher($id)
    {
        // TODO: Implement editTeacher() method.
        return Teacher::findOrFail($id);
    }

    public function updateTeacher($request)
    {
        // TODO: Implement updateTeacher() method.
        try {
            $teacher = Teacher::findOrFail($request->id);
            $teacher->email = $request->email;
            $teacher->password =  Hash::make($request->password);
            $teacher->name = ['en' => $request->name_en, 'ar' => $request->name];
            $teacher->specialization_id = $request->specialization_id;
            $teacher->gender_id = $request->gender_id;
            $teacher->joining_date = $request->joining_date;
            $teacher->address = $request->address;
            $teacher->save();

            toastr()->success(trans('messages.update'));
            return redirect()->route('teachers.index');

        } catch (Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function deleteTeacher($request)
    {
        // TODO: Implement deleteTeacher() method.
        Teacher::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return redirect()->route('teachers.index');
    }
}
