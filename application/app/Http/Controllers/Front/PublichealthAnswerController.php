<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\PublicHealthAnswer;
use Illuminate\Http\Request;

class PublichealthAnswerController extends Controller
{

    public function store(Request $request){

        if($request->checkbox){
            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = new PublicHealthAnswer();
                    $publicHealthAnswer->question_id = $key;
                    $publicHealthAnswer->answer = $answer;
                    $publicHealthAnswer->patient_id = $patientId;
                    $publicHealthAnswer->clinic_id = $clinicId;
                    $publicHealthAnswer->form_id = 1;

                    $publicHealthAnswer->save();

                }
        }

        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');
        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = new PublicHealthAnswer();
            $publicHealthAnswer->question_id = $key;
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id =1;

            $publicHealthAnswer->save();
        }

    return back();
    }
    public function maternalstore(Request $request){

        if($request->checkbox){
            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = new PublicHealthAnswer();
                    $publicHealthAnswer->question_id = $key;
                    $publicHealthAnswer->answer = $answer;
                    $publicHealthAnswer->patient_id = $patientId;
                    $publicHealthAnswer->clinic_id = $clinicId;
                    $publicHealthAnswer->form_id = 2;

                    $publicHealthAnswer->save();

                }
        }

        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');
        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = new PublicHealthAnswer();
            $publicHealthAnswer->question_id = $key;
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id =2;

            $publicHealthAnswer->save();
        }

    return back();
    }
    public function parentalstore(Request $request){

        if($request->checkbox){
            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = new PublicHealthAnswer();
                    $publicHealthAnswer->question_id = $key;
                    $publicHealthAnswer->answer = $answer;
                    $publicHealthAnswer->patient_id = $patientId;
                    $publicHealthAnswer->clinic_id = $clinicId;
                    $publicHealthAnswer->form_id = 3;

                    $publicHealthAnswer->save();

                }
        }

        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');
        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = new PublicHealthAnswer();
            $publicHealthAnswer->question_id = $key;
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id =3;

            $publicHealthAnswer->save();
        }

    return back();
    }
    public function agriculturalstore(Request $request){

        if($request->checkbox){
            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = new PublicHealthAnswer();
                    $publicHealthAnswer->question_id = $key;
                    $publicHealthAnswer->answer = $answer;
                    $publicHealthAnswer->patient_id = $patientId;
                    $publicHealthAnswer->clinic_id = $clinicId;
                    $publicHealthAnswer->form_id = 4;

                    $publicHealthAnswer->save();

                }
        }

        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');
        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = new PublicHealthAnswer();
            $publicHealthAnswer->question_id = $key;
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id =4;

            $publicHealthAnswer->save();
        }

    return back();
    }
    public function update($id,Request $request){

        if($request->checkbox){

            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
                    $publicHealthAnswer->answer = $answer;

                    $publicHealthAnswer->save();

                }

        }


        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');

        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id = 1;

            $publicHealthAnswer->save();
        }
        return back();
    }
    public function maternalupdate($id,Request $request){

        if($request->checkbox){

            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
                    $publicHealthAnswer->answer = $answer;

                    $publicHealthAnswer->save();

                }

        }


        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');

        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id = 2;

            $publicHealthAnswer->save();
        }
        return back();
    }
    public function parentalupdate($id,Request $request){

        if($request->checkbox){

            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
                    $publicHealthAnswer->answer = $answer;

                    $publicHealthAnswer->save();

                }

        }


        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');

        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id = 3;

            $publicHealthAnswer->save();
        }
        return back();
    }
    public function agriculturalupdate($id,Request $request){

        if($request->checkbox){

            foreach($request->checkbox as $key=>$box){

                $answer = implode(',',$box);
                $input = $request->except('clinic_id', 'patient_id', 'question_id','_token');
                $patientId=$request->patient_id;
                $clinicId=$request->clinic_id;

                    $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
                    $publicHealthAnswer->answer = $answer;

                    $publicHealthAnswer->save();

                }

        }


        $input = $request->except('clinic_id', 'patient_id', 'question_id','_token','checkbox');

        $patientId=$request->patient_id;
        $clinicId=$request->clinic_id;
        foreach($input as $key=>$input){
            $publicHealthAnswer = PublicHealthAnswer::findOrFail($key);
            $publicHealthAnswer->answer = $input;
            $publicHealthAnswer->patient_id = $patientId;
            $publicHealthAnswer->clinic_id = $clinicId;
            $publicHealthAnswer->form_id = 4;

            $publicHealthAnswer->save();
        }
        return back();
    }
}
