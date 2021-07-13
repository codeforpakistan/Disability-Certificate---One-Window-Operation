<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row my-5">
        <div class="col-md-12">
            {{-- <livewire:search-applicant /> --}}
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                            <strong>Success!</strong> {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (request()->has('issue'))
                        <div class="alert alert-success" role="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                            <strong>Success!</strong> Disability certificate issued successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <table class="table table-borderless" id="applicants_datatable" data-order='[[ 1, "asc" ]]' data-page-length='25'>
                        <thead>
                            <tr>
                                <th scope="col">CNIC / CRC</th>
                                <th scope="col">Name</th>
                                <th scope="col">Current Status</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applicants as $applicant)
                                <tr>
                                    <td scope="row" class="align-middle">{{ $applicant->cnic }}</td>
                                    <td class="align-middle">{{ $applicant->name }}</td>
                                    <td class="align-middle">
                                        @php
                                            $assessment = $applicant->assessments()->where('user_id', \Auth::id())->count()
                                        @endphp
                                        @if(\Auth::user()->hasRole('Assessment') && $applicant->applicationStatus->title == 'Documents Uploaded' && $assessment == 1)
                                            Assessment In progress
                                        @elseif(\Auth::user()->hasRole('Assessment') && $applicant->applicationStatus->title == 'Reassessment' && $assessment == 2)
                                            Reassessment in progress
                                        @else
                                            {{ $applicant->applicationStatus->title }}
                                        @endif
                                    </td>
                                    <td class="float-right align-middle">
                                        @if(\Auth::user()->hasRole('Help Desk'))
                                            <a href="{{ route('client.applications.create', ['applicant_id' => $applicant->id]) }}" type="button" class="btn btn-outline-success">Upload Documents</a>
                                            @if( $applicant->applicationStatus->title == 'Registered' )
                                                <a href="{{ route('client.applications.edit', [$applicant->id]) }}" type="button" class="btn btn-outline-primary">Edit</a>
                                            @endif
                                        @endif
                                        @if(\Auth::user()->hasRole('Assessment'))
                                            @if( ( $applicant->applicationStatus->title == 'Documents Uploaded' && $assessment == 0 ) || ($applicant->applicationStatus->title == 'Reassessment' && $assessment == 1))
                                                <a href="{{ route("client.applications.assessment", [$applicant->id]) }}" type="button" class="btn btn-outline-success">Start Assessment</a>
                                            @else
                                                    <a href="{{ route('client.applications.assessment', [$applicant->id, 'edit' => 1]) }}" type="button" class="btn btn-outline-primary">Edit My Assessment</a>
                                            @endif
                                        @endif
                                        @if(\Auth::user()->hasRole('CRPD') && $applicant->applicationStatus->title == "Assessed" )
                                            <a href="{{ route("client.applications.verification", [$applicant->id]) }}" type="button" class="btn btn-outline-success">Start Verification</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready( function () {
                $('#applicants_datatable').DataTable({
                    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                           "<'row'<'col-sm-12'tr>>" +
                           "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                });

                $('#applicants_datatable_paginate').addClass('pull-right');
                $('#applicants_datatable_wrapper').removeClass('form-inline');
            } );
        </script>
    @endpush
</x-app-layout>