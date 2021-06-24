<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Patient Registration - Document uploads') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-heading bg-white px-5 py-3 border-bottom rounded-top">
                    <h2>{{ __('Patient Info') }}</h2>
                </div>
                <div class="card-body bg-white px-5 py-3 border-bottom">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">CNIC / CRC</th>
                                <th scope="col">Name</th>
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
        <div class="col-md-12 mt-5">
            <div class="card shadow bg-light">
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
                    <form method="POST" action="{{ route('admin.resources.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applicant_id" value="{{ request()->input('applicant_id') }}">
                        <div class="form-row align-items-center">
                            <div class="col-3 offset-3">
                                <input type="file" class="form-control-file" name="applicant_files[]" id="applicant_files" multiple required>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-success pull-right">Upload Document</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-5">
                         @foreach($resources as $resource)
                            <div class="col-md-2">
                                <livewire:show-thumbnail :resource="$resource" />
                            </div>
                        @endforeach
                    </div>
                    <form method="POST" action="{{ route('admin.applications.update', [$applicant->id]) }}">
                        @method("PUT")
                        <input type="hidden" name="status" value="2">
                        @csrf
                        <div class="grid grid-cols-1 gap-2 place-items-end">
                            <button class="btn btn-success pull-right" type="submit">
                                Submit for clinical assessment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-app-layout>