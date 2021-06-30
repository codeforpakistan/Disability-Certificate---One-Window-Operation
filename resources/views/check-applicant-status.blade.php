<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="row my-5">
        <div class="col-md-12">
            <livewire:search-applicant />
            @if(request()->has('cnic'))
                <div class="card shadow bg-light">
                    <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">CNIC / CRC</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Current Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applicants as $applicant)
                                    <tr>
                                        <td scope="row" class="align-middle">{{ $applicant->cnic }}</td>
                                        <td class="align-middle">{{ $applicant->name }}</td>
                                        <td class="align-middle">
                                            @php
                                                $assessment = $applicant->assessments()->where('user_id', \Auth::id())->count()
                                            @endphp
                                            @if(\Auth::user()->hasRole('Assessment') && $applicant->status == 2 && $assessment == 1)
                                                Assessment In progress
                                            @elseif(\Auth::user()->hasRole('Assessment') && $applicant->status == 9 && $assessment == 2)
                                                Reassessment in progress
                                            @else
                                                {{ $applicant->applicationStatus->title }}
                                            @endif
                                        </td>
                                        <td class="float-right align-middle">
                                            @if(\Auth::user()->hasRole('Help Desk'))
                                                <a href="{{ route('admin.applications.create', ['applicant_id' => $applicant->id]) }}" type="button" class="btn btn-outline-success">Upload Documents</a>
                                            @endif
                                            @if(\Auth::user()->hasRole('Assessment') && (($applicant->status == 2 && $assessment == 0) || $applicant->status == 9 && $assessment == 1) )
                                                <a href="{{ route("admin.applications.assessment", [$applicant->id]) }}" type="button" class="btn btn-outline-success">Start Assessment</a>
                                            @endif
                                            @if(\Auth::user()->hasRole('CRPD') && $applicant->status == 3 )
                                                <a href="{{ route("admin.applications.verification", [$applicant->id]) }}" type="button" class="btn btn-outline-success">Start Verification</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="4"><span class="lead text-muted">Applicant not registered.</span></td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @push('scripts')
    @endpush
</x-app-layout>