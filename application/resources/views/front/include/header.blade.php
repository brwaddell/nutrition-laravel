<!-- header area start here  -->
<header class="header-area sticky-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-8 col-sm-8">
                <div class="header-left d-flex align-items-center">
                    <span class="menu-bar d-block d-xl-none"><i class="fas fa-bars"></i></span>
                    <span class="mobile-search-icon d-block d-md-none"><i class="fas fa-search"></i></span>

                    <select class="select" id="clinicId" onchange="changeClinic(this.value)">
                        <option data-display="Select Clinic Site">Select Clinic Site</option>
                        @foreach ($clinics as $clinic)
                            <option value="{{ $clinic->id }}" {{ $clinic->id == session()->get('clinic_id') ? 'selected' : '' }}>{{ $clinic->name }}</option>
                        @endforeach
                    </select>

                    <select class="select ml-4" id="clinicId" onchange="changelang(this.value)">
                            <option value="en" {{ session()->get('selected_language') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="es" {{ session()->get('selected_language') == 'es' ? 'selected' : '' }}>Spanish</option>
                    </select>
                    <div class="header-search">
                        <input class="search_input" type="text" name="" id="searchPatient" placeholder="Search a patient">
                        <div class="text-danger code-error"></div>
                        <div class="text-danger code-delerror"></div>
                        <ul id="patient_list" class="search-patient-list">

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-4 col-sm-4">
                <div class="header-rihgt">
                    <ul class="d-flex justify-content-end align-items-center">
                        {{-- <li>
                            <a class="notification" href="#"><i class="flaticon-ring"></i></a>
                        </li> --}}
                        <li>
                            <div class="dropdown user-dropdown">
                                <a class="dropdoen-btn" href="#" data-toggle="dropdown">
                                 <span>{{ auth()->user()->name }}</span> <img src="{{
                                    isset(auth()->user()->image) ? asset(path_user_image().auth()->user()->image) : Avatar::create(auth()->user()->name)->toBase64()
                                }}" alt="user" />
                                </a>
                                <div class="dropdown-menu">
                                  {{-- <a class="dropdown-item" href="sign-in.html">Sign in</a>
                                  <a class="dropdown-item" href="#">Sing Up</a> --}}
                                  <a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a>
                                  <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('#patient_list').hide();
            });

            function changelang(lang){

                window.location.href = "/language/"+ lang;

            }

            function changeClinic($clinicId) {
                $.ajax({
                    url: "/session/clinic/"+ $clinicId,
                    type: "POST",
                    data:{
                        _token:'{{ csrf_token() }}',


                    },
                    cache: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.user.role == 'medical assistant') {
                            window.location.href="{{route('main.dashboard')}}";
                        }
                        else if(response.user.role == 'doctor') {
                            window.location.href="{{route('main.dashboard')}}";
                        }
                        else if(response.user.role == 'pharmasist') {
                            window.location.href="{{route('main.dashboard')}}";
                        }
                        else{
                            window.location.href="{{route('main.dashboard')}}";
                        }

                    }
                });
            }

            let apId = document.querySelector('#patient_list');

            $('#searchPatient').keyup(function(e){
                fetctPatientCode(e.target.value)
            })

            function fetctPatientCode(search_data)
            {
                $('#patient_list').show();
                    // document.getElementsByName("profile_id").readOnly = true;
                    html = '';
                if(search_data.length >= 3){
                    searchP(search_data)
                }
                else if(search_data.length == 0) {
                    $('#patient_list').hide();
                }
                else{
                    html += `
                            <li>Write three letters</li>
                        `
                };
                apId.innerHTML = html
            };

            function searchP(search_data)
            {
                $.ajax({
                    url: "/search/patient/?name="+ search_data,
                    type: "GET",
                    data:{
                        _token:'{{ csrf_token() }}',


                    },
                    success:function(response) {
                        // console.log(response);
                        // let code =  response.filter(function(data){
                        //     return data.name.toLowerCase().includes(search_data)
                        // })
                        //    console.log(code==[]);
                        html = '';
                        if(response != []){
                            response.forEach(data => {
                                html += `
                                <li><a href="javascript:void(0)" onclick="gotopchart(${data.id})">${data.name}</a></li>
                            `
                            });
                        }else{
                            console.log('no');
                            html += `
                                <li> No Data Found </li>
                            `
                        }


                    apId.innerHTML = html
                    }
                });
            }

            function gotopchart(pid)
            {
                window.location.replace("{{ url('edit/patient-chart') }}/"+ pid);
            }
        </script>
    @endpush
</header>
