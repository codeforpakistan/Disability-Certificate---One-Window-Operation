<x-admin.app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            {{ __('Log Details') }}
        </h2>
    </x-slot>
    <x-slot name="buttons"></x-slot>
    <div class="col-md-12">
        <div class="card shadow bg-light">
            <div class="card-heading bg-white px-4 py-3 border-bottom rounded-top">
                <h2>{{ __('Log Details') }}</h2>
            </div>
            <div class="card-body bg-white px-4 py-3 border-bottom">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Activity ID</th>
                                <th scope="col">User</th>
                                <th scope="col">Action</th>
                                <th scope="col">Model</th>
                                <th scope="col">When</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->causer->name }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->subject_type }}</td>
                                <td>{{ $log->created_at->diffForHumans() }}</td>
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
                <h2>{{ __('Changes to the model') }}</h2>
            </div>
            <div class="card-body bg-white px-4 py-3 border-bottom">
                <div class="row">
                    <div class="col-md-12">
                        <pre class="highlight"><code class="language-javascript">{!! json_encode($log->properties, JSON_PRETTY_PRINT) !!}</code></pre>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    @push('css')
        <link rel="stylesheet" href="{{ asset('admin/css/prism.css') }}">
    @endpush
    @push('scripts')
        <script src="{{ asset('admin/js/prism.js') }}"></script>
    @endpush
</x-admin.app-layout>