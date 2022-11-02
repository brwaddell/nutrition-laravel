<div class="row align-items-center">
    <div class="col-md-6">
        <div class="media align-items-center">
            <a href="{{ route('edit.patient-chart', $patient->id) }}">
                <img  src="{{
                    isset($patient->image) ? asset(path_patient_image().$patient->image) : Avatar::create($patient->first_name . ' ' . $patient->last_name)->toBase64()
                }}" class="profile-image mr-5" alt="profile image" />
            </a>
            
            <div class="media-body">
              <h3 class="profile-name mt-0">{{ $patient->last_name }}, {{ $patient->first_name }} </h3>
              <ul class="profile-info">
                  <li><span>Patient ID</span> <b>#WP-{{ $patient->id }}</b></li>
                  <li><span>DOB</span> <b>{{ \Carbon\Carbon::parse($patient->dob)->format('m/d/Y') }}</b></li>
              </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="progress-tabs">
            <ul class="progress-list">
                <li class="single-progress checked">
                    <span class="check-box"></span>
                    <span class="progress-text">Checkin</span>
                </li>
                <li class="single-progress {{ Route::is('patient.vital-sign') || Route::is('patient.clinical-encounter') || Route::is('patient.order.index') || Route::is('patient.suppliment.order.index') ? 'checked' : '' }} {{ Route::is('patient.public-health') ? 'current-tab' : '' }}">
                    <span class="check-box"></span>
                    <a href="{{ route('patient.public-health', ['patient_id' =>$patient->id, 'checkin_id' => $patient->checked_in->id]) }}">
                        <span class="progress-text">Public Health</span>
                    </a>
                </li>
                <li class="single-progress {{ Route::is('patient.clinical-encounter') || Route::is('patient.order.index') || Route::is('patient.suppliment.order.index') ? 'checked' : '' }} {{ Route::is('patient.vital-sign') ? 'current-tab' : '' }}">
                    <span class="check-box"></span>
                    <a href="{{ route('patient.vital-sign', $patient->id) }}">
                        <span class="progress-text">Vitals</span>
                    </a>
                </li>
                <li class="single-progress {{ Route::is('patient.order.index') || Route::is('patient.suppliment.order.index') ? 'checked' : '' }} {{ Route::is('patient.clinical-encounter') ? 'current-tab' : '' }}">
                    <span class="check-box"></span>
                    <a href="{{ route('patient.clinical-encounter', $patient->id) }}">
                        <span class="progress-text">Encounter</span>
                    </a>
                </li>
                <li class="single-progress {{ Route::is('patient.order.index') || Route::is('patient.suppliment.order.index') ? 'current-tab' : '' }}">
                    <span class="check-box"></span>
                    <a href="{{ route('patient.order.index', $patient->id) }}">
                        <span class="progress-text">Orders</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>







