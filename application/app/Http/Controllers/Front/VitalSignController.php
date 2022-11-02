<?php

namespace App\Http\Controllers\Front;

use App\Patient;
use App\VitalSign;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\VitalSignRequest;
use Illuminate\Support\Facades\Session;

class VitalSignController extends Controller
{
    public function index(Patient $patient_id)
    {
        $vitalSigns = VitalSign::where('patient_id', $patient_id->id)->where('clinic_id', session()->get('clinic_id'))->orderBy('created_at', 'desc')->get();

    //wait for age chart
    $waightForAge = [];
    $waightForAgeMonth = [];

    foreach($vitalSigns as $vsign){
    array_push($waightForAge, $vsign->wfa);
    }

    foreach($vitalSigns as $vsign){
    array_push($waightForAgeMonth, $vsign->created_at->format('M d'));
    }

    $wfaChart =array_reverse($waightForAge);
    $waightForAgeMonthChart =array_reverse($waightForAgeMonth);

    $wfaCharttoString = implode(",", $wfaChart);
    $monthCharttoString = implode(",", $waightForAgeMonthChart);
    //wait for age chart

    //length for age chart
    $lengthForAge = [];
    foreach($vitalSigns as $vsign){
      array_push($lengthForAge, $vsign->hfa);
    }

    $lfaChart =array_reverse($lengthForAge);

    $lfaCharttoString = implode(",", $lfaChart);
    //length for age chart

    //weight for height chart
    $weightForHeight = [];
    foreach($vitalSigns as $vsign){
      array_push($weightForHeight, $vsign->wfh);
    }
    $wfhChart =array_reverse($weightForHeight);

    $wfhCharttoString = implode(",", $wfhChart);
    //weight for height chart


    $patient_age = Carbon::parse($patient_id->dob)->diffInDays(Carbon::now());
    $growth = VitalSign::where('patient_id', $patient_id->id)->where('clinic_id', session()->get('clinic_id'))->orderBy('created_at', 'desc')->first();


    return view('front/vital-sign-api', compact('patient_id', 'vitalSigns', 'patient_age', 'growth', 'wfaCharttoString', 'monthCharttoString','lfaCharttoString', 'wfhCharttoString'));
    }


    function storefromajax(Request $request){
        //return $request->all();
        VitalSign::create([
            'height' => $request->height,
            'height_unit' => 'cm',
            'weight' => $request->weight,
            'weight_unit' => 'kg',
            'head_circumference' => $request->head_circumference,
            // 'subscapular_circumference' => '',
            // 'edema' => '',
            'wfh' => $request->wfh,
            'wfa' => $request->wfa,
            'hfa' => $request->hfa,
            'cfa' => $request->cfa,
            'bfa' => $request->bfa,
            // 'sfa' => round($sfa, 2),
            // 'bmi' => $bmi,
            // 'wfhp' => round($request->wfhp, 2),
            // 'wfap' => round($request->wfap, 2),
            // 'hfap' => round($request->hfap, 2),
            // 'cfap' => round($request->cfap, 2),
            // 'bfap' => round($request->bfap, 2),
            // 'sfap' => round($sfap, 2),
            'patient_id' => $request->patient_id,
            'clinic_id' => $request->clinic_id,
            'subscapular_skinfold' => $request->subscapular_skinfold,
            // 'triceps_skinfold' => $request->triceps_skinfold,
            'arm_circumference' => $request->arm_circumference,
            'arm_circumference_for_age' => $request->arm_circumference_for_age,
            'subscapular_skinfold_for_age' => $request->subscapular_skinfold_for_age,
            // 'triceps_skinfold_for_age' => $request->triceps_skinfold_for_age,
            'chart' => $request->chart,
        ]);

        return 'stored';
    }


    public function store(VitalSignRequest $request)
    {
        $height = $request->height_unit == 'M' ? mTocmConverter($request->height) : $request->height;

        $weight = $request->weight_unit == 'G' ? gTokgConverter($request->weight) : $request->weight;

        $age = Carbon::parse($request->dob)->diffInMonths(Carbon::now());

        $gender = $request->gender;

        $cicumference = $request->head_circumference;

        $subscapular = $request->subscapular_circumference;

        $wfh = $this->weight_for_height($height, $weight, $age, $gender, 'z_score');
        $wfhp = $this->weight_for_height($height, $weight, $age, $gender, 'p_score');
        $wfa = $this->weight_for_age($weight, $age, $gender, 'z_score');
        $wfap = $this->weight_for_age($weight, $age, $gender, 'p_score');
        $hfa = $this->height_for_age($height, $age, $gender, 'z_score');
        $hfap = $this->height_for_age($height, $age, $gender, 'p_score');
        $cfa = $this->circumference_for_age($cicumference, $age, $gender, 'z_score');
        $cfap = $this->circumference_for_age($cicumference, $age, $gender, 'p_score');
        $bmi = round($this->bmi($weight, $height), 1);
        $bfa = $this->bmi_for_age($bmi, $age, $gender, 'z_score');
        $bfap = $this->bmi_for_age($bmi, $age, $gender, 'p_score');
        $sfa =  $this->subscapular_for_age($subscapular, $age, $gender, 'z_score');
        $sfap =  $this->subscapular_for_age($subscapular, $age, $gender, 'p_score');

        // return array($wfh, $wfhp, $wfa, $wfap, $hfa, $hfap, $cfa, $cfap, $bmi, $bfa, $bfap, $sfa, $sfap);

        VitalSign::create([
            'height' => $request->height,
            'height_unit' => $request->height_unit,
            'weight' => $request->weight,
            'weight_unit' => $request->weight_unit,
            'head_circumference' => $request->head_circumference,
            'subscapular_circumference' => $request->subscapular_circumference,
            'edema' => $request->edema,
            'wfh' => round($wfh, 2),
            'wfa' => round($wfa, 2),
            'hfa' => round($hfa, 2),
            'cfa' => round($cfa, 2),
            'bfa' => round($bfa, 2),
            'sfa' => round($sfa, 2),
            'bmi' => $bmi,
            'wfhp' => round($wfhp, 2),
            'wfap' => round($wfap, 2),
            'hfap' => round($hfap, 2),
            'cfap' => round($cfap, 2),
            'bfap' => round($bfap, 2),
            'sfap' => round($sfap, 2),
            'patient_id' => $request->patient_id,
            'clinic_id' => $request->clinic_id,
        ]);

        Session::flash('message', 'Birth information successfully created.');

        Toastr::success('', 'Birth information successfully created.');

        return redirect()->back()->with('success', 'Birth information successfully created.');
    }

    public function weight_for_height($height, $weight, $age, $gender, $scoreType)
    {
        if($age <= 24 && $gender == 'male') {
            $table = DB::table('weight_for_height_u_2yrs_boys')->where('height', $height)->first();
        }
        elseif($age <= 24 && $gender == 'female') {
            $table = DB::table('weight_for_height_u_2yrs_girls')->where('height', $height)->first();
        }
        elseif($age > 24 && $gender == 'male') {
            $table = DB::table('weight_for_height_u_2_5yrs_boys')->where('height', $height)->first();
        }
        elseif($age > 24 && $gender == 'female') {
            $table = DB::table('weight_for_height_u_2_to_5yrs_girls')->where('height', $height)->first();
        }
        else {
            return 0;
        }

        if($table) {
            $median = $table->median;
            $sd = $table->sd;
            if($scoreType == 'z_score') {
                $score = zScore($weight, $median, $sd);
                return $score;
            }
            else {
                $score = percentScore($weight, $median);
                return $score;
            }
        }
        else {
            return 0;
        }
    }

    public function weight_for_age($weight, $age, $gender, $scoreType)
    {
        if($gender == 'male') {
            $table = DB::table('weight_for_age_u_5yrs_boys')->where('months', $age)->first();
        }
        else {
            $table = DB::table('weight_for_age_u_5yrs_girls')->where('months', $age)->first();
        }

        if($table) {
            $median = $table->median;
            $sd = $table->sd;
            if($scoreType == 'z_score') {
                $score = zScore($weight, $median, $sd);
                return $score;
            }
            else {
                $score = percentScore($weight, $median);
                return $score;
            }
        }
        else {
            return 0;
        }
    }

    public function height_for_age($height, $age, $gender, $scoreType)
    {
        if($age <= 24 && $gender == 'male') {
            $table = DB::table('length_for_age_u_24m_boys')->where('months', $age)->first();
        }
        elseif($age <= 24 && $gender == 'female') {
            $table = DB::table('length_for_age_u_24m_girls')->where('months', $age)->first();
        }
        elseif($age > 24 && $gender == 'male') {
            $table = DB::table('length_for_age_u_60m_boys')->where('months', $age)->first();
        }
        elseif($age > 24 && $gender == 'female') {
            $table = DB::table('length_for_age_u_60m_girls')->where('months', $age)->first();
        }
        else {
            return 0;
        }

        if($table) {
            $median = $table->median;
            $sd = $table->sd;
            if($scoreType == 'z_score') {
                $score = zScore($height, $median, $sd);
                return $score;
            }
            else {
                $score = percentScore($height, $median);
                return $score;
            }
        }
        else {
            return 0;
        }
    }

    public function circumference_for_age($cicumference, $age, $gender, $scoreType)
    {
        if($gender == 'male') {
            $table = DB::table('circumference_for_age_u_60m_boys')->where('months', $age)->first();
        }
        else {
            $table = DB::table('circumference_for_age_u_60m_girls')->where('months', $age)->first();
        }

        if($table) {
            $median = $table->median;
            $sd = $table->sd;
            if($scoreType == 'z_score') {
                $score = zScore($cicumference, $median, $sd);
                return $score;
            }
            else {
                $score = percentScore($cicumference, $median);
                return $score;
            }
        }
        else {
            return 0;
        }
    }

    public function bmi($weight, $height)
    {
        $m_height = $height / 100;
        $pow_height = pow($m_height, 2);
        $bmi = $weight / $pow_height;
        return $bmi;
    }

    public function bmi_for_age($bmi, $age, $gender, $scoreType)
    {
        if($age <= 24 && $gender == 'male') {
            $table = DB::table('bmi_for_age_u_24m_boys')->where('months', $age)->first();

        }
        elseif($age <= 24 && $gender == 'female') {
            $table = DB::table('bmi_for_age_u_24m_girls')->where('months', $age)->first();
        }
        elseif($age > 24 && $gender == 'male') {
            $table = DB::table('bmi_for_age_u_60m_boys')->where('months', $age)->first();
        }
        elseif($age > 24 && $gender == 'female') {
            $table = DB::table('bmi_for_age_u_60m_girls')->where('months', $age)->first();
        }
        else {
            return 0;
        }

        if($table) {
            $median = $table->median;
            $sd = $table->sd;
            if($scoreType == 'z_score') {
                $score = zScore($bmi, $median, $sd);
                return $score;
            }
            else {
                $score = percentScore($bmi, $median);
                return $score;
            }
        }
        else {
            return 0;
        }
    }

    public function subscapular_for_age($subscapular, $age, $gender, $scoreType)
    {
        if($gender == 'male') {
            $table = DB::table('subscapular_for_age_u_3m_to_5yrs_boys')->where('months', $age)->first();
        }
        else {
            $table = DB::table('subscapular_for_age_u_3m_to_5yrs_girls')->where('months', $age)->first();
        }

        if($table) {
            $median = $table->median;
            $sd = $table->sd;
            if($scoreType == 'z_score') {
                $score = zScore($subscapular, $median, $sd);
                return $score;
            }
            else {
                $score = percentScore($subscapular, $median);
                return $score;
            }
        }
        else {
            return 0;
        }
    }
}
