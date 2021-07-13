<x-admin.app-layout>
    <x-slot name="header">
        <h2 class="page-title">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <x-slot name="buttons">
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-new-user">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Create new user
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
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                </div>
            </div>
        </div>
    </div>

    @push('modals')
        <div class="modal modal-blur fade" id="modal-new-user" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.users.store') }}" method="POST" id="create_new_user">
                        @csrf
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
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
                            </div>
                            <label class="form-label">Role</label>
                            <div class="form-selectgroup-boxes row mb-3">
                                @foreach ($roles as $role)
                                    <div class="col-lg-3">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="role" value="{{ $role->id}}" class="form-selectgroup-input" {{ $role->name == 'Help Desk' ? 'checked' : ""}} {{ ($role->name == 'Help Desk' || old('role') == $role->id) ? 'checked' : ""  }} required>
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                <span class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </span>
                                                <span class="form-selectgroup-label-content">
                                                    <span class="form-selectgroup-title strong mb-1">{{ $role->name }}</span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password should be minimum 8 characters." required>
                                    <span class="input-group-text">
                                        <a href="#" id="show_password" class="input-group-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="2"></circle>
                                                <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                                
                            </div> 
                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" required>
                                    <span class="input-group-text">
                                        <a href="#" id="show_password2" class="input-group-link">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="12" cy="12" r="2"></circle>
                                                <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
                            <button type="submit" class="btn btn-primary ms-auto" id="submit">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg> Create new user
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
                        $('#modal-new-user').modal('show');
                    @endif

                    $("#create_new_user").on('submit', function(e) {
                        let password = $('#password').val();
                        let confirm_password = $('#password_confirmation').val();
                        var submit = true;
                        e.preventDefault();
                        $.ajax({
                            url: '{{ route('admin.users.check_email') }}',
                            type: 'POST',
                            data: {
                                email: $('#email').val()
                            },
                            success: function (response) {
                                if (response.status == 'error') {
                                    $('#email').focus();
                                    $('#email').addClass('is-invalid');
                                    $('#email').after('<span class="invalid-feedback">' + response.message + '</span>');
                                    submit = false;
                                } else {
                                    $('#create_new_user').off('submit').submit();
                                }
                            }
                        });
                        if (password != confirm_password) {
                            $('#password').val('');
                            $('#password_confirmation').val('');
                            $('#password').focus();
                            $('#password').addClass('is-invalid');
                            $('#password_confirmation').addClass('is-invalid');
                            $('#password').after('<span class="invalid-feedback">Passwords do not match</span>');
                            submit = false;
                        }
                        if ( ! submit ) {
                            return false;
                        }
                    });
                    $('#show_password, #show_password2').on('click', function() {
                        let eyeOpen = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="2"></circle><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path></svg>';
                        let eyeClose = '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-off" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="3" y1="3" x2="21" y2="21"></line><path d="M10.584 10.587a2 2 0 0 0 2.828 2.83"></path><path d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341"></path></svg>';
                        // check if the password input type text
                        if ($('#password').attr('type') == 'password') {
                            $('#password').attr('type', 'text');
                            $('#password_confirmation').attr('type', 'text');
                            $('#show_password').html(eyeClose);
                            $('#show_password2').html(eyeClose);
                        } else {
                            $('#password').attr('type', 'password');
                            $('#password_confirmation').attr('type', 'password');
                            $('#show_password').html(eyeOpen);
                            $('#show_password2').html(eyeOpen);
                        }
                    });
                });
        </script>
    @endpush
</x-admin.app-layout>