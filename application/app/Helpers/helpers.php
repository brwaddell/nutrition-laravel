<?php

use App\Agricultural;
use App\BirthInformation;
use App\CheckIn;
use App\ClinicalEncounter;
use App\IntermittentHealth;
use App\MaternalHealth;
use App\Models\BasicSetting;
use App\ParentalInformation;
use App\PaternalHistory;
use App\Patient;
use App\PrenatalHistory;
use App\PublicHealthAnswer;
use App\PublicHealthForm;
use App\VitalSign;
use Intervention\Image\Facades\Image;

function fileUpload($new_file, $path, $old_file_name = null, $imgheight=null, $imgwidth=null)
{

    if (!file_exists(public_path($path))) {
        mkdir(public_path($path), 0777, true);
    }


    $file_name = time() . $new_file->getClientOriginalName();
    $destinationPath = $path;

    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {
        unlink($path . $old_file_name);
    }

    # resize image

        # resize image and upload
        if ($imgheight || $imgwidth) {

            $imageResize = Image::make($new_file)
                ->resize($imgwidth, $imgheight)
                ->save($destinationPath . $file_name);

                // $imageResize = Image::make($new_file)
                // ->orientate()
                // ->fit($width, $height, function ($constraint) {
                //     $constraint->upsize();
                // })->save($destinationPath . $file_name);

        } else {

            #original image upload
            $new_file->move($destinationPath, $file_name);

        }

    return $file_name;
}


function removeImage($path, $old_file_name)
{
    if (isset($old_file_name) && $old_file_name != "" && file_exists($path . $old_file_name)) {

        unlink($path . $old_file_name);
    }

    return true;
}

//*************************************Image Path**************************

function path_user_image()
{
    return 'uploaded_file/files/img/user/';
}

function path_message_attachment()
{
    return 'uploaded_file/files/attachments/';
}

function path_patient_image()
{
    return 'uploaded_file/files/img/patient/';
}

function path_site_logo_image()
{
    return 'uploaded_file/files/img/site/';
}

function path_site_favicon_image()
{
    return 'uploaded_file/files/img/favicon/';
}

function path_site_white_image()
{
    return 'uploaded_file/files/img/favicon/';
}

function isCheckedIn($checkin_id)
{
    $checked_in = CheckIn::where('id', $checkin_id)->where(function($query) {
        $query->where('status', 0)->orWhere('status', 3);
    })->exists();
    if($checked_in)
    {
        return 0;
    }
    else{
        return 1;
    }

}

function goToProcessed($patient_id)
{
    $clinic_id = session()->get('clinic_id');
    $intermittent_count = IntermittentHealth::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();
    $maternal_count = MaternalHealth::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();
    $paternal_count = PaternalHistory::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();
    $agricultural_count = Agricultural::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();

    if($intermittent_count || $maternal_count || $paternal_count || $agricultural_count) {
        CheckIn::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)
                ->update([
                    'status' => 2
                ]);
    }
}

function isPHComplete($patient_id)
{
    $clinic_id = session()->get('clinic_id');

    // $intermittent_count = IntermittentHealth::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();
    // $maternal_count = MaternalHealth::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();
    // $paternal_count = PaternalHistory::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();
    // $agricultural_count = Agricultural::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();

    $ph_count = PublicHealthAnswer::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();

    if($ph_count) {
        return 1;
    }

    // return 0;
    return 1;
}

function isVSComplete($patient_id)
{
    $clinic_id = session()->get('clinic_id');

    $vital_count = VitalSign::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();

    if($vital_count) {
        return 1;
    }

    return 0;
}

function isCEComplete($patient_id)
{
    $clinic_id = session()->get('clinic_id');

    $ce_count = ClinicalEncounter::where('clinic_id', $clinic_id)->where('patient_id', $patient_id)->exists();

    if($ce_count) {
        return 1;
    }

    return 0;
}

function mTocmConverter($value)
{
    $convertedValue = $value * 100;
    return $convertedValue;
}

function gTokgConverter($value)
{
    $convertedValue = $value * 0.001;
    return $convertedValue;
}

function zScore($measured_value, $median, $sd)
{
    $avg = $measured_value - $median;
    $z_score = $avg / $sd;
    return $z_score;
}

function percentScore($measured_value, $median)
{
    $percent_score = ($measured_value / $median) * 100;

    return $percent_score;
}

function checkInStatus($patient_id)
{

    $checkin_count = CheckIn::where('patient_id', $patient_id)->where('status', 3)->exists();

    if($checkin_count) {
        return 1;
    }

    return 0;
}

function form_list() {
    return PublicHealthForm::orderBy('name', 'asc')->get();
}

function breadcumb($patient_id)
{
    $patient = Patient::where('id', $patient_id)->with('checked_in')->first();
    return view('front.include.media-header', compact('patient'));
}
