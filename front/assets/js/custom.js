(function ($) {
    "use strict";

    $('#vform').on('submit', function (e) {
        e.preventDefault();
    });

    let gender = '';
    let age = '';
    let height = '';
    let weight = '';
    let height_unit = '';
    let weight_unit = '';
    let head_circumference = '';
    let charttt = '';
    let patient_id = '';
    let clinic_id = '';
    let subscapular_skinfold = '';
    let triceps_skinfold = '';
    let arm_circumference = '';

    let WEIGHT_FOR_LENGTH = 0;
    let WEIGHT_FOR_HEIGHT = '';
    let WEIGHT_FOR_AGE = '';
    let LENGTH_HEIGHT_FOR_AGE = '';
    let HEAD_CIRC_FOR_AGE = '';
    let bmi = '';
    let cbmi = '';
    let arm_circumference_for_age = '';
    let subscapular_skinfold_for_age = '';
    let triceps_skinfold_for_age = '';

    $('.anthroAPIR').on('click', function () {
        gender = document.getElementById('gender').value;
        age = document.getElementById('age').value;
        height_unit = document.getElementById('height_unit').value;
        weight_unit = document.getElementById('weight_unit').value;
        if (height_unit == 'Inch') {
            height = document.getElementById('height').value * 2.54;
        }
        else {
            height = document.getElementById('height').value;
        }

        if (weight_unit == 'G') {
            weight = document.getElementById('weight').value * 0.001;
        }
        else {
            weight = document.getElementById('weight').value;
        }
        head_circumference = document.getElementById('head_circumference').value;
        patient_id = document.getElementById('patient_id').value;
        clinic_id = document.getElementById('clinic_id').value;
        subscapular_skinfold = document.getElementById('subscapular_skinfold').value;
        triceps_skinfold = document.getElementById('triceps_skinfold').value;
        arm_circumference = document.getElementById('arm_circumference').value;

        $.ajax({
            type: 'GET',
            url: 'http://67.205.140.52:8000',
            data: {
                sex: gender,
                age: age,
                is_age_in_month: false,
                weight: weight,
                lenhei: height,
                headc: head_circumference,
                armc: arm_circumference,
                subskin: subscapular_skinfold,
                measure: 'H',
                oedema: 'n'
            },
            success: function (data) {
                console.log(data);
                if(age > 1826) {
                    alert("No data available in API");
                }
                else {
                    $.each(data, function (k, v) {
                        $("#weight_for_age").html(v.zwei);
                        $("#bmi_for_age").html(v.zbmi);
                        $("#length_for_age").html(v.zlen);
                        $("#hc_for_age").html(v.zhc);
                        $("#subscapular_skinfold_for_age").html(v.zss);
                        $("#arm_circumference_for_age").html(v.zac);
    
                        WEIGHT_FOR_AGE = v.zwei;
                        bmi = v.zbmi;
                        LENGTH_HEIGHT_FOR_AGE = v.zlen;
                        HEAD_CIRC_FOR_AGE = v.zhc;
                        subscapular_skinfold_for_age = v.zss;
                        arm_circumference_for_age = v.zac;
                    });

                    store();
                }


            }
        });
    });

    function store() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST", /* or type:"GET" or type:"PUT" */
            data: {
                height: height,
                weight: weight,
                head_circumference: head_circumference,
                wfh: WEIGHT_FOR_LENGTH,
                wfa: WEIGHT_FOR_AGE,
                hfa: LENGTH_HEIGHT_FOR_AGE,
                cfa: HEAD_CIRC_FOR_AGE,
                bfa: bmi,
                patient_id: patient_id,
                clinic_id: clinic_id,
                subscapular_skinfold: subscapular_skinfold,
                // triceps_skinfold: triceps_skinfold,
                arm_circumference: arm_circumference,
                arm_circumference_for_age: arm_circumference_for_age,
                subscapular_skinfold_for_age: subscapular_skinfold_for_age,
                // triceps_skinfold_for_age: triceps_skinfold_for_age,
                // bfap: bfap,
                // cfap: cfap,
                // hfap: hfap,
                // wfap: wfap,
                // wfhp: wfhp,
                // chart: charttt,

            },
            url: '/patient/vital-sign/storeajax'
        }).done(function (data) {
            //console.log(data);
            window.location.reload();
        });
    }
})(jQuery)
