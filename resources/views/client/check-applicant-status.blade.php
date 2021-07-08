<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Check Applicant Status') }}
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
                                    <th scope="col">Applicant Name</th>
                                    <th scope="col">Father Name</th>
                                    <th scope="col">Type of disability</th>
                                    <th scope="col">Nature of disability</th>
                                    <th scope="col">Cause of disability</th>
                                    <th scope="col">Current Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applicants as $applicant)
                                    <tr>
                                        <td>{{ $applicant->cnic }}</td>
                                        <td>{{ $applicant->name }}</td>
                                        <td>{{ $applicant->father_name }}</td>
                                        <td>{{ $applicant->disabilityType->type }}</td>
                                        <td>{{ $applicant->nature_of_disability }}</td>
                                        <td>{{ $applicant->cause_of_disability }}</td>
                                        <td class="align-middle">{{ $applicant->applicationStatus->title }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="align-middle text-center" colspan="7"><span class="lead text-muted">Applicant not registered.</span></td>
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