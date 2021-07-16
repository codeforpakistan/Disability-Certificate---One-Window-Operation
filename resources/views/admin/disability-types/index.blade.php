<x-admin.app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            {{ __('Disability Types') }}
        </h2>
    </x-slot>
    <x-slot name="buttons">
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-new-disability-type">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Create new disability type
                </a>
            </div>
        </div>
    </x-slot>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>Woops!</strong> {{ session('error') }}
                    </div>
                @endif
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>

    @push('modals')
        <div class="modal modal-blur fade" id="modal-new-disability-type" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New disability type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.disability-types.store') }}" method="POST" id="disability-type-form">
                        @csrf
                        @method('POST')
                        <div class="modal-body">
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
                            <div class="mb-3">
                                <label class="form-label" for="type">Disability</label>
                                <input type="text" class="form-control" name="type" id="type" value="{{ old('type') }}" placeholder="Disability" required>
                            </div>
                            <label class="form-label">Eligible for Special CNIC</label>
                            <div class="form-selectgroup-boxes row mb-3">
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="eligible_for_scnic" id="eligible_for_scnic_yes" value="1" class="form-selectgroup-input" {{ old('eligible_for_scnic') == '1' ? 'checked' : ""  }} required>
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Yes</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <label class="form-selectgroup-item">
                                        <input type="radio" name="eligible_for_scnic" id="eligible_for_scnic_no" value="0" class="form-selectgroup-input" {{ old('eligible_for_scnic') == '0' ? 'checked' : ""  }} required>
                                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">No</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-auto" id="submit-modal-form">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> Create new disability type
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endpush

    @push('css')
        {{-- Datatables bootstrap --}}
        <link rel="stylesheet" href="https://nightly.datatables.net/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">
    @endpush
    @push('scripts')
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>

        <script src="{{ asset('admin/js/buttons.server-side.js') }}"></script>
        {!! $dataTable->scripts() !!}
        <script>
            $(document).ready(function () {
            @if ($errors->any())    
                $('#modal-new-disability-type').modal('show');
            @endif
                $('#modal-new-disability-type').on('show.bs.modal', function (event) {
                    var button = $(event.relatedTarget);
                    var id = button.data('id');
                    var type = '';
                    var eligible_for_scnic = '';
                    var url = '{{ url('admin/disability-types/') }}';
                    var method = 'POST';
                    var modal = $(this);
                    if( id ) {
                        type = button.data('type');
                        eligible_for_scnic = button.data('eligible_for_scnic');
                        url = '{{ url('admin/disability-types/') }}' + '/' + id;
                        modal = $(this);
                        method = 'PUT';
                        modal.find('.modal-title').text('Edit disability type (' + type + ')');
                        $("#type").val(type);
                        $("#eligible_for_scnic_yes").prop("checked", eligible_for_scnic == 1);
                        $("#eligible_for_scnic_no").prop("checked", eligible_for_scnic == 0);
                        $('input[name="_method"]').val(method);
                        $('#disability-type-form').attr('action', url);
                        $('#submit-modal-form').text('Update disability type');
                    } else {
                        modal.find('.modal-title').text('New disability type');
                        $("#type").val(type);
                        $("#eligible_for_scnic_yes").prop("checked", false);
                        $("#eligible_for_scnic_no").prop("checked", false);
                        $('input[name="_method"]').val(method);
                        $('#disability-type-form').attr('action', url);
                        $('#submit-modal-form').text('Create new disability type');
                    }
                });
            });
        </script>
    @endpush
</x-admin.app-layout>