<div class="form-row">
    <div class="form-group col-md-6">
        <label for="cnic">CNIC/CRC</label>
        <input class="form-control" id="cnic" name="cnic" type="text" data-inputmask="'mask': '99999-9999999-9'" value="{{ old('cnic') ? old('cnic') : ( isset($applicant) ? $applicant->cnic : "") }}" placeholder="XXXXX-XXXXXXX-X" required>
    </div>
    <div class="form-group col-md-6">
        <label for="dob">Date of birth</label>
        <input class="form-control" id="dob" name="dob" type="date" value="{{ old('dob') ? old('dob') : ( isset($applicant) ? $applicant->dob->format('Y-m-d') : "") }}" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">Applicant name</label>
        <input class="form-control" id="name" name="name" type="text" value="{{ old('name') ? old('name') : ( isset($applicant) ? $applicant->name : '') }}" placeholder="Enter applicant name" required>
    </div>
    <div class="form-group col-md-6">
        <label for="father_name">Father name</label>
        <input class="form-control" id="father_name" name="father_name" type="text" value="{{ old('father_name') ? old('father_name') : ( isset($applicant) ? $applicant->father_name : '') }}"placeholder="Enter father name" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="">Select gender</option>
            <option value="Male" {{ (old("gender") == 'Male' || (isset($applicant) && $applicant->gender == "Male") ) ? "selected" : "" }}>Male</option>
            <option value="Female" {{ (old("gender") == 'Female' || (isset($applicant) && $applicant->gender == "Female") ) ? "selected" : "" }}>Female</option>
            <option value="Other" {{ (old("gender") == 'Other' || (isset($applicant) && $applicant->gender == "Other") ) ? "selected" : "" }}>Other</option>
        </select>
    </div>
    <div class="form-group col-md-6">
        <label for="phone_no">Mobile Number</label>
        <input class="form-control" id="phone_no" name="phone_no" type="text" data-inputmask="'mask': '0399-9999999'" value="{{ old('phone_no') ? old('phone_no') : ( isset($applicant) ? $applicant->phone_no : '') }}" placeholder="03XX-XXXXXXX" maxlength="12" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="address">Address</label>
        <input class="form-control" id="address" name="address" type="text" value="{{ old('address') ? old('address') : ( isset($applicant) ? $applicant->address : '') }}" placeholder="Enter address" required>
    </div>
    <div class="form-group col-md-6">
        <label for="marital_status">Marital Status</label>
        <select class="form-control" id="marital_status" name="marital_status" required>
            <option value="">Select marital status</option>
            <option value="Single" {{ (old("marital_status") == 'Single' || ( isset( $applicant ) && $applicant->marital_status == "Single" ) ) ? "selected" : "" }}>Single</option>
            <option value="Married" {{ (old("marital_status") == 'Married' || ( isset( $applicant ) && $applicant->marital_status == "Married" ) ) ? "selected" : "" }}>Married</option>
            <option value="Divorced" {{ (old("marital_status") == 'Divorced' || ( isset( $applicant ) && $applicant->marital_status == "Divorced" ) ) ? "selected" : "" }}>Divorced</option>
            <option value="Widowed" {{ (old("marital_status") == 'Widowed' || ( isset( $applicant ) && $applicant->marital_status == "Widowed" ) ) ? "selected" : "" }}>Widowed</option>
        </select>
    </div>
</div>
<div class="form-row" id="spouse-details">
    <div class="form-group col-md-12">
        <label for="spouse_name">Spouse Name</label>
        <input class="form-control" id="spouse_name" name="spouse_name" type="text" value="{{ old('spouse_name') ? old('spouse_name') : ( isset($applicant) ? $applicant->spouse_name : '') }}" placeholder="Enter spouse name">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="qualification">Qualification</label>
        <input class="form-control" id="qualification" name="qualification" type="text" value="{{ old('qualification') ? old('qualification') : ( isset($applicant) ? $applicant->qualification : '') }}" placeholder="Enter qualification" required>
    </div>
    <div class="form-group col-md-6">
        <label for="type_of_disability">Type of disability</label>
        <select class="form-control" id="type_of_disability" name="type_of_disability" required>
            <option value="">Select type of disability</option>
            @foreach($disabilityTypes as $id => $type)
                <option {{ (old("type_of_disability") == $id || ( isset( $applicant ) && $applicant->type_of_disability == $id ) ) ? "selected" : "" }} value="{{ $id }}">{{ $type }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="nature_of_disability">Nature of disability</label>
        <input class="form-control" id="nature_of_disability" name="nature_of_disability" type="text" value="{{ old('nature_of_disability') ? old('nature_of_disability') : ( isset($applicant) ? $applicant->nature_of_disability : '') }}"  placeholder="Enter nature of disability" required>
    </div>
    <div class="form-group col-md-6">
        <label for="cause_of_disability">Cause of disability</label>
        <input class="form-control" id="cause_of_disability" name="cause_of_disability" type="text" value="{{ old('cause_of_disability') ? old('cause_of_disability') : ( isset($applicant) ? $applicant->cause_of_disability : '') }}" placeholder="Enter cause of disability" required>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label for="source_of_income">Source of income</label>
        <input class="form-control" id="source_of_income" name="source_of_income" type="text" value="{{ old('source_of_income') ? old('source_of_income') : ( isset($applicant) ? $applicant->source_of_income : '') }}" placeholder="Enter source of income" required>
    </div>
    <div class="form-group col-md-6">
        <label for="type_of_job">Type of job (that applicant can do)</label>
        <input class="form-control" id="type_of_job" name="type_of_job" type="text" value="{{ old('type_of_job') ? old('type_of_job') : ( isset($applicant) ? $applicant->type_of_job : '') }} "placeholder="Enter type of job" required>
    </div>
</div>