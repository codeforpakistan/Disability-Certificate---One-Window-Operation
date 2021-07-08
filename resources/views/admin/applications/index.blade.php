<x-admin.app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            {{ __('Applications') }}
        </h2>
    </x-slot>
    <x-slot name="buttons"></x-slot>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>

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
    @endpush
</x-admin.app-layout>