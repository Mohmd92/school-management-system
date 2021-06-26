<?php 

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradesController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      $grades = Grade::all();
      return view('pages.grades.grades', compact('grades'));
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
  public function store(StoreGrades $request)
  {
      try {
          $validated = $request->validated();
          $grade = new Grade();
          $grade->name = ['en' => $request->name_en, 'ar' => $request->name];
          $grade->notes = $request->notes;
          $grade->save();

          toastr()->success(trans('messages.success'));
          return redirect()->route('grades.index');
      }
      catch (\Exception $e) {
          return redirect()->back()->withErrors(['error', $e->getMessage()]);
      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGrades $request)
  {
      try {

          $validated = $request->validated();
          $grade = Grade::findOrFail($request->id);
          $grade->update([
              $grade->name = ['ar' => $request->name, 'en' => $request->name_en],
              $grade->notes = $request->notes,
          ]);
          toastr()->success(trans('messages.update'));
          return redirect()->route('grades.index');
      }
      catch
      (\Exception $e) {
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request)
  {
      $grade = Grade::findOrFail($request->id);
      $grade->delete();
      toastr()->error(trans('messages.delete'));
      return redirect()->route('grades.index');
  }
}