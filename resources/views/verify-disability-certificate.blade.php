<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="card-body">

            {{-- <x-jet-validation-errors class="mb-3 rounded-0" /> --}}

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('guest.view-disability-certificate') }}">
                @csrf
                <div class="form-group">
                    <x-jet-label value="{{ __('CNIC / CRC') }}" />

                    <x-jet-input class="{{ $errors->has('cnic') ? 'is-invalid' : '' }}" type="text" id="cnic" name="cnic" :value="old('cnic')" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" required />
                    <x-jet-input-error for="cnic"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Disability certificate issue date') }}" />

                    <x-jet-input class="form-control{{ $errors->has('issue_date') ? ' is-invalid' : '' }}" type="date" :value="old('issue_date')" name="issue_date" required />
                    <x-jet-input-error for="issue_date"></x-jet-input-error>
                </div> 

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted mr-3" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        @endif

                        <x-jet-button>
                            {{ __('Verify Disability Certificate') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
    @push('scripts')
        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
        <script>
            $(":input").inputmask();
        </script>
    @endpush
</x-guest-layout>