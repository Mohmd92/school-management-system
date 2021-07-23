<?php

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(['prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () { //...
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    //============================== Grades ==============================
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('grades', 'GradesController');
    });

    //============================== Classrooms ==============================
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('classrooms', 'ClassroomController');

        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::post('filter_classes', 'ClassroomController@filter_classes')->name('filter_classes');
    });

    //============================== Sections ==============================
    Route::group(['namespace' => 'Sections'], function () {
        Route::resource('sections', 'SectionController');

        Route::get('getGradeClasses/{grade_id}', 'SectionController@getGradeClasses')->name('getGradeClasses');
    });

    //==============================Parents============================
    Route::view('add_parent', 'livewire.show_form');

    //==============================Teachers============================
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('teachers', 'TeacherController');
    });
});

/*
 Route::prefix('api')->group(function () {

    Route::get('grades', function () {
        return Grade::all();
    });

    Route::get('classrooms', function () {
        return Classroom::all();
    });

    Route::get('sections', function () {
        return Section::with('grade')->get();
    });
});
*/
