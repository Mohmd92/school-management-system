<?php


namespace App\Repositories\TeacherRepository;


interface IRepository
{
    public function getAll();
    public function getSpecializations();
    public function getGenders();
    public function storeTeacher($request);
    public function editTeacher($id);
    public function updateTeacher($request);
    public function deleteTeacher($request);
}
