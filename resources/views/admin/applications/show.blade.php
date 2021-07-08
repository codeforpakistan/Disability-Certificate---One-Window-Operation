<x-admin.app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            {{ __('Application Details') }}
        </h2>
    </x-slot>
    <x-slot name="buttons"></x-slot>
    <div class="col-md-12">
        <div class="card shadow bg-light">
            <div class="card-heading bg-white px-4 py-3 border-bottom rounded-top">
                <h2>{{ __('Applicant\'s Info') }}</h2>
            </div>
            <div class="card-body bg-white px-4 py-3 border-bottom">
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
    
    <div class="col-md-12 mt-3">
        <div class="card shadow bg-light">
            <div class="card-heading bg-white px-4 py-3 border-bottom rounded-top">
                <h2>{{ __('Applicant\'s Documents') }}</h2>
            </div>
            <div class="card-body bg-white px-4 py-3 border-bottom">
                <div class="row">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Type</th>
                                <th scope="col">Uploaded at</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applicant->resources as $resource)
                                <tr>
                                    <td>{{ $resource->name }}</td>
                                    <td>{{ $resource->type }}</td>
                                    <td>
                                        <span style="font-size: 12px;">{{ $resource->created_at->diffForHumans() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ $resource->url }}" target="_blank" class="btn btn-outline-dark float-end">View / Download</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="card shadow bg-light">
            <div class="card-heading bg-white px-4 py-3 border-bottom rounded-top">
                <h2>{{ __("Clinical Findings") }}</h2>
            </div>
            <div class="card-body bg-white px-4 py-3 border-bottom">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Organization / Department</th>
                                <th scope="col">Doctor's Name</th>
                                <th scope="col">Clinical Findings</th>
                                <th scope="col">Is fit for Job?</th>
                                <th scope="col">Is fit for Driving?</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applicant->assessments as $assessment)
                                <tr>
                                    <td>{{ $assessment->user->name }}</td>
                                    <td>{{ $assessment->doctor_name }}</td>
                                    <td>{{ $assessment->clinical_findings }}</td>
                                    <td>{{ $assessment->fit_for_job ? "Yes" : "No" }}</td>
                                    <td>{{ $assessment->fit_for_driving ? "Yes" : "No" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('css')
    @endpush
    @push('scripts')
    @endpush
</x-admin.app-layout>