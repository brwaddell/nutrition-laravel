<?php

namespace App\Http\Controllers\Admin;

use App\PublicHealthForm;
use App\PublicHealthAnswer;
use Illuminate\Http\Request;
use App\PublicHealthQuestion;
use App\Http\Controllers\Controller;
use App\DataTables\IntermittentHealthFormDatatable;

class PublicHealthQuestionController extends Controller
{
    public function index(IntermittentHealthFormDatatable $dataTable)
    {

        return $dataTable->render('admin.publichealthquestion.index');
    }

    public function create()
    {
        return view('admin.publichealthquestion.create');
    }

    public function store(Request $request)
    {

        $input = $request->except('attrname');
        if($request->pattern != 'inputbox'){
            if($request->attributes != null){
                $input['attributes'] = implode(',',$request->attrname);
            }
        }

        $question = PublicHealthQuestion::create($input);

        $answer_p_id = PublicHealthAnswer::select('patient_id')->where('form_id',3)->distinct()->get();

        foreach($answer_p_id as $answer){
            PublicHealthAnswer::create([
                'answer'=>null,
                'question_id'=>$question->id,
                'form_id'=>$question->form_id,
                'patient_id'=>$answer->patient_id,
                'clinic_id'=>1,
            ]);

        }


        return redirect()->back();
    }

    public function edit($id)
    {
        $publicHealthQuestion = PublicHealthQuestion::findOrFail($id);

        return view('admin.publichealthquestion.create', compact('publicHealthQuestion'));

    }

    public function update($id, Request $request)
    {
        $input = $request->except('attrname');

        if($request->attributes != null){
            $input['attributes'] = implode(',',$request->attrname);
        }

        $publicHealthQuestion = PublicHealthQuestion::findOrFail($id);

        $publicHealthQuestion->update($input);

        return back();
    }

    public function delete($id){

        $phq = PublicHealthQuestion::findOrFail($id);

        $phq->delete();

        return back();

    }

    public function formIndex(IntermittentHealthFormDatatable $dataTable, $id)
    {
        $form = PublicHealthForm::where('id', $id)->first();
        return $dataTable->with('id', $id)->render('admin.publichealthquestion.index', compact('form'));
    }

    public function formCreate($id)
    {
        $form = PublicHealthForm::where('id', $id)->first();
        return view('admin.publichealthquestion.create', compact('form'));
    }
}
