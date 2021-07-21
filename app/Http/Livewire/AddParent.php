<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;

    public $successMessage = '';

    public $catchError,
        $updateMode = false,
        $photos,
        $show_table = true,
        $parent_id;

    public $currentStep = 1;

    public // Father_INPUTS
        $email, $password,
        $father_name, $father_name_en,
        $father_id, $father_mobile,
        $father_job, $father_job_en,
        $father_nationality_id, $father_blood_type_id,
        $father_address,

        // Mother_INPUTS
        $mother_name, $mother_name_en,
        $mother_id, $mother_mobile,
        $mother_job, $mother_job_en,
        $mother_nationality_id, $mother_blood_type_id,
        $mother_address;

    public function updated($propertyName)
    {
//        try {
            $this->validateOnly($propertyName, [
                'email' => 'required|email',
                'father_id' => 'required|string|min:9|max:9|regex:/[0-9]{9}/',
                'father_mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'mother_id' => 'required|string|min:9|max:9|regex:/[0-9]{9}/',
                'mother_mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
            ]);
//        } catch (ValidationException $e) {
//            $this->catchError = $e->getMessage();
//        }
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities' => Nationality::all(),
            'blood_types' => Blood::all(),
            'parents' => MyParent::all(),
        ]);
    }

    public function showForm(){
        $this->show_table = false;
    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:parents,email,'.$this->id,
            'password' => 'required',
            'father_name' => 'required',
            'father_name_en' => 'required',
            'father_job' => 'required',
            'father_job_en' => 'required',
            'father_id' => 'required|min:9|max:9|unique:parents,father_id,' . $this->id,
            'father_mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality_id' => 'required',
            'father_blood_type_id' => 'required',
            'father_address' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validate([
            'mother_name' => 'required',
            'mother_name_en' => 'required',
            'mother_id' => 'required|unique:parents,mother_id,' . $this->id,
            'mother_mobile' => 'required',
            'mother_job' => 'required',
            'mother_job_en' => 'required',
            'mother_nationality_id' => 'required',
            'mother_blood_type_id' => 'required',
            'mother_address' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submitForm(){

        try {
            $parent = new MyParent();
            // Father_INPUTS
            $parent->email = $this->email;
            $parent->password = Hash::make($this->password);
            $parent->father_name = ['en' => $this->father_name_en, 'ar' => $this->father_name];
            $parent->father_id = $this->father_id;
            $parent->father_mobile = $this->father_mobile;
            $parent->father_job = ['en' => $this->father_job_en, 'ar' => $this->father_job];
            $parent->father_nationality_id = $this->father_nationality_id;
            $parent->father_blood_type_id = $this->father_blood_type_id;
            $parent->father_address = $this->father_address;

            // Mother_INPUTS
            $parent->mother_name = ['en' => $this->mother_name_en, 'ar' => $this->mother_name];
            $parent->mother_id = $this->mother_id;
            $parent->mother_mobile = $this->mother_mobile;
            $parent->mother_job = ['en' => $this->mother_job_en, 'ar' => $this->mother_job];
            $parent->mother_nationality_id = $this->mother_nationality_id;
            $parent->mother_blood_type_id = $this->mother_blood_type_id;
            $parent->mother_address = $this->mother_address;

            $parent->save();

            if (!empty($this->photos)){
                foreach ($this->photos as $photo) {
                    $photo->storeAs($this->father_id, $photo->getClientOriginalName(), $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => MyParent::latest()->first()->id,
                    ]);
                }
            }

            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        }

        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $parent = MyParent::where('id',$id)->first();
        $this->parent_id = $id;
        $this->email = $parent->email;
        $this->password = $parent->password;
        $this->father_name = $parent->getTranslation('father_name', 'ar');
        $this->father_name_en = $parent->getTranslation('father_name', 'en');
        $this->father_job = $parent->getTranslation('father_job', 'ar');;
        $this->father_job_en = $parent->getTranslation('father_job', 'en');
        $this->father_id =$parent->father_id;
        $this->father_mobile = $parent->father_mobile;
        $this->father_nationality_id = $parent->father_nationality_id;
        $this->father_blood_type_id = $parent->father_blood_type_id;
        $this->father_address =$parent->father_address;

        $this->mother_name = $parent->getTranslation('mother_name', 'ar');
        $this->mother_name_en = $parent->getTranslation('mother_name', 'en');
        $this->mother_job = $parent->getTranslation('mother_job', 'ar');;
        $this->mother_job_en = $parent->getTranslation('mother_job', 'en');
        $this->mother_id =$parent->mother_id;
        $this->mother_mobile = $parent->mother_mobile;
        $this->mother_nationality_id = $parent->mother_nationality_id;
        $this->mother_blood_type_id = $parent->mother_blood_type_id;
        $this->mother_address =$parent->mother_address;
    }

    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;

    }

    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function submitForm_edit(){

        if ($this->parent_id){
            $parent = MyParent::find($this->parent_id);
            $parent->update([
                'father_id' => $this->father_id,
            ]);
        }

        return redirect()->to('/add_parent');
    }

    public function delete($id){
        MyParent::findOrFail($id)->delete();
        return redirect()->to('/add_parent');
    }

    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name = '';
        $this->father_job = '';
        $this->father_job_en = '';
        $this->father_name_en = '';
        $this->father_id ='';
        $this->father_mobile = '';
        $this->father_nationality_id = '';
        $this->father_blood_type_id = '';
        $this->father_address ='';

        $this->mother_name = '';
        $this->mother_job = '';
        $this->mother_job_en = '';
        $this->mother_name_en = '';
        $this->mother_id ='';
        $this->mother_mobile = '';
        $this->mother_nationality_id = '';
        $this->mother_blood_type_id = '';
        $this->mother_address ='';
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }
}
