<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Applicant Verification') }}
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
                    <h2>{{ __("Clinical Findings") }}</h2>
                </div>
                <div class="card-body bg-white px-5 py-3 border-bottom">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group pull-right" role="group">
                                @if( $applicant->assessments()->count() < 10 )
                                    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#verificationModal" data-title="Reassessment" data-url="{{ route('client.applications.issueCertificate', [$applicant->id]) }}" data-value="reassess" data-blank="0">Reassessment</button>
                                @endif
                                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#verificationModal" data-title="Verify and don't issue DC" data-url="{{ route('client.applications.issueCertificate', [$applicant->id]) }}" data-value="no" data-blank="0">Verify and don't issue DC</button>
                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#verificationModal" data-title="Verify and issue DC" data-url="{{ route('client.applications.issueCertificate', [$applicant->id]) }}" data-value="yes" data-blank="1">Verify and issue DC</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="verificationModal" tabindex="-1" role="dialog" aria-labelledby="verificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verificationModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="dc-form" action="" method="POST" target="_blank" onsubmit="reDir()">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Comments:</label>
                            <textarea class="form-control" rows="4" id="comments" name="comments" placeholder="Add any comments here. if no comments add N/A" rows="8" required>{{ old('clinical_findings') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary" name="issue" value="" id="submit-form"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @push('scripts')
        <script>
            $('#verificationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var title = button.data('title'); // Extract info from data-* attributes
                var url = button.data('url'); // Extract info from data-* attributes
                var btnVal = button.data('value');
                var blank = button.data('blank');
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                console.log(title, url, blank);
                var modal = $(this);
                modal.find('.modal-title').text(title);
                modal.find('#submit-form').text(title);
                modal.find('#submit-form').val(btnVal);
                modal.find('#dc-form').attr('action', url);
                if(blank == 0) {
                    modal.find('#dc-form').attr('target', "_self");
                    modal.find('#dc-form').attr('onsubmit', "");
                }
            });

            function reDir() {
                setTimeout(function () {
                    window.onbeforeunload = null;
                    window.location.href = '{!! route('client.dashboard', ['cnic' => $applicant->cnic, 'issue' => 'yes']) !!}';
                }, 10);
            }
        </script>
    @endpush
</x-app-layout>