<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Applicant Registration') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center my-5">

        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('client.applications.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cnic">CNIC/CRC</label>
                                <input class="form-control" id="cnic" name="cnic" type="text" data-inputmask="'mask': '99999-9999999-9'" value="{{ old('cnic') }}" placeholder="XXXXX-XXXXXXX-X" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dob">Date of birth</label>
                                <input class="form-control" id="dob" name="dob" type="date" value="{{ old('dob') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Applicant name</label>
                                <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter applicant name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="father_name">Father name</label>
                                <input class="form-control" id="father_name" name="father_name" type="text" value="{{ old('father_name') }}"placeholder="Enter father name" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="Male" {{ (old("gender") == 'Male' ? "selected" : "") }}>Male</option>
                                    <option value="Female" {{ (old("gender") == 'Female' ? "selected" : "") }}>Female</option>
                                    <option value="Other" {{ (old("gender") == 'Other' ? "selected" : "") }}>Other</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone_no">Mobile Number</label>
                                <input class="form-control" id="phone_no" name="phone_no" type="text" data-inputmask="'mask': '0399-9999999'" value="{{ old('phone_no') }}" placeholder="03XX-XXXXXXX" maxlength="12" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="address">Address</label>
                                <input class="form-control" id="address" name="address" type="text" value="{{ old('address') }}" placeholder="Enter address" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="marital_status">Marital Status</label>
                                <select class="form-control" id="marital_status" name="marital_status" required>
                                    <option value="">Select marital status</option>
                                    <option value="Single" {{ (old("marital_status") == 'Single' ? "selected" : "") }}>Single</option>
                                    <option value="Married" {{ (old("marital_status") == 'Married' ? "selected" : "") }}>Married</option>
                                    <option value="Divorced" {{ (old("marital_status") == 'Divorced' ? "selected" : "") }}>Divorced</option>
                                    <option value="Widowed" {{ (old("marital_status") == 'Widowed' ? "selected" : "") }}>Widowed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row" id="spouse-details">
                            <div class="form-group col-md-12">
                                <label for="spouse_name">Spouse Name</label>
                                <input class="form-control" id="spouse_name" name="spouse_name" type="text" value="{{ old('spouse_name') }}" placeholder="Enter spouse name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="qualification">Qualification</label>
                                <input class="form-control" id="qualification" name="qualification" type="text" value="{{ old('qualification') }}" placeholder="Enter qualification" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type_of_disability">Type of disability</label>
                                <select class="form-control" id="type_of_disability" name="type_of_disability" required>
                                    <option value="">Select type of disability</option>
                                    @foreach($disabilityTypes as $id => $type)
                                        <option {{ (old("type_of_disability") == $id ? "selected" : "") }} value="{{ $id }}">{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nature_of_disability">Nature of disability</label>
                                <input class="form-control" id="nature_of_disability" name="nature_of_disability" type="text" value="{{ old('nature_of_disability') }}"  placeholder="Enter nature of disability" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cause_of_disability">Cause of disability</label>
                                <input class="form-control" id="cause_of_disability" name="cause_of_disability" type="text" value="{{ old('cause_of_disability') }}" placeholder="Enter cause of disability" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="source_of_income">Source of income</label>
                                <input class="form-control" id="source_of_income" name="source_of_income" type="text" value="{{ old('source_of_income') }}" placeholder="Enter source of income" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type_of_job">Type of job (that applicant can do)</label>
                                <input class="form-control" id="type_of_job" name="type_of_job" type="text" value="{{ old('type_of_job') }} "placeholder="Enter type of job" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end align-items-baseline">
                            <x-jet-button>
                                {{ __('Save and proceed to documents upload') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
        <script>
            $(":input").inputmask();

            $(document).ready(function(){
                $("#marital_status").change(function(){
                    $(this).find("option:selected").each(function(){
                        var optionValue = $(this).attr("value");
                        if(optionValue == "Married"){
                            $("#spouse-details").show();
                        } else{
                            $("#spouse-details").hide();
                        }
                    });
                }).change();
            });
        </script>
    @endpush
</x-app-layout>