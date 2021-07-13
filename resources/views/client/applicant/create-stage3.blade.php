<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Applicant Clinical Assessment') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-heading bg-white px-5 py-3 border-bottom rounded-top">
                    <h2>{{ __('Applicant\'s Info') }}</h2>
                </div>
                <div class="card-body bg-white px-5 py-3 border-bottom">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">CNIC / CRC</th>
                                    <th scope="col">Applicant Name</th>
                                    <th scope="col">Father Name</th>
                                    <th scope="col">Type of disability</th>
                                    <th scope="col">Nature of disability</th>
                                    <th scope="col">Cause of disability</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $applicant->cnic }}</td>
                                    <td>{{ $applicant->name }}</td>
                                    <td>{{ $applicant->father_name }}</td>
                                    <td>{{ $applicant->disabilityType->type }}</td>
                                    <td>{{ $applicant->nature_of_disability }}</td>
                                    <td>{{ $applicant->cause_of_disability }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5">
            <div class="card shadow bg-light">
                <div class="card-heading bg-white px-5 py-3 border-bottom rounded-top">
                    <h2>{{ __('Applicant\'s Documents') }}</h2>
                </div>
                <div class="card-body bg-white px-5 py-3 border-bottom">
                    <div class="row mt-5">
                        @foreach($applicant->resources as $resource)
                            <div class="col-md-3">
                                <livewire:show-thumbnail :resource="$resource" :imageSize="120" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5">
            <div class="card shadow bg-light">
                <div class="card-heading bg-white px-5 py-3 border-bottom rounded-top">
                    <h2>{{ __("Doctor's Assessment") }}</h2>
                </div>
                <div class="card-body bg-white px-5 py-3 border-bottom">
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
                    @if(request()->has('edit') && $myAssessment)
                        <form method="POST" action="{{ route('client.assessments.update', [$myAssessment->id]) }}">
                            @method('PUT')
                    @else
                        <form method="POST" action="{{ route('client.assessments.store') }}">
                    @endif
                        @csrf
                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="doctor_name">Doctor's Name</label>
                                <input class="form-control mt-2" id="doctor_name" name="doctor_name" type="text" value="{{ old('doctor_name') ? old('doctor_name') : ( isset($myAssessment) ? $myAssessment->doctor_name : '') }}" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="doctor_name">Clinical Findings</label>
                                <textarea class="form-control" id="clinical_findings" name="clinical_findings" rows="8" required>{{ old('clinical_findings') ? old('clinical_findings') : ( isset($myAssessment) ? $myAssessment->clinical_findings : '') }}</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="doctor_name">Fit for job?</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="fit_for_job_yes" name="fit_for_job" type="radio" value="1" {{ (old("fit_for_job") == '1' || ( isset( $myAssessment ) && $myAssessment->fit_for_job == "1" ) ) ? "checked" : "" }} required>
                                    <label class="form-check-label" for="fit_for_job_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="fit_for_job_no" name="fit_for_job" type="radio" value="0" {{ (old("fit_for_job") == '0' || ( isset( $myAssessment ) && $myAssessment->fit_for_job == "0" ) ) ? "checked" : "" }} required>
                                    <label class="form-check-label" for="fit_for_job_no">No</label>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="doctor_name">Fit for Driving?</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="fit_for_driving_yes" name="fit_for_driving" type="radio" value="1" {{ (old("fit_for_driving") == '1' || ( isset( $myAssessment ) && $myAssessment->fit_for_driving == "1" ) ) ? "checked" : "" }} required>
                                    <label class="form-check-label" for="fit_for_driving_yes">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="fit_for_driving_no" name="fit_for_driving" type="radio" value="0" {{ (old("fit_for_driving") == '0' || ( isset( $myAssessment ) && $myAssessment->fit_for_driving == "0" ) ) ? "checked" : "" }} required>
                                    <label class="form-check-label" for="fit_for_driving_no">No</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success pull-right">
                            @if(request()->has('edit') && $myAssessment)
                                {{ __('Update Clinical Assessment') }}
                            @else
                            {{ __('Submit Clinical Assessment') }}
                            @endif
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-app-layout>