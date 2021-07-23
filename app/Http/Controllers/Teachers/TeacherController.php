<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeachersRequest;
use App\Repositories\TeacherRepository\IRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TeacherController extends Controller
{
    protected $iRepository;

    public function __construct(IRepository $iRepository)
    {
        $this->iRepository = $iRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        //
        $teachers = $this->iRepository->getAll();
        return view('pages.teachers.teachers', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        //
        $specializations = $this->iRepository->getSpecializations();
        $genders = $this->iRepository->getGenders();
        return view('pages.teachers.create', compact('specializations', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTeachersRequest $request
     * @return Response
     */
    public function store(StoreTeachersRequest $request)
    {
        //
        return $this->iRepository->storeTeacher($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        //
        $teacher = $this->iRepository->editTeacher($id);
        $genders = $this->iRepository->getGenders();
        $specializations = $this->iRepository->getSpecializations();
        return view('pages.teachers.edit',compact('teacher','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        return $this->iRepository->updateTeacher($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        //
        return $this->iRepository->deleteTeacher($request);
    }
}
