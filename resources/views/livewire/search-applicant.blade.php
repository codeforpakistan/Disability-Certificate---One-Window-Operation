<form>
    <div class="form-group has-search">
        <div class="input-group">
            <input type="text" class="form-control" id="cnic" name="cnic" placeholder="Search by CNIC / CRC" value="{{ request()->has('cnic') ? request()->input('cnic'): "" }}" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X" required>
            @if(request()->has('cnic'))
                <div class="input-group-append">
                    <span class="input-group-text" style="background-color: white !important;"><a href="{{ route('dashboard') }}">Reset</a></span>
                </div>
            @endif
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div>
</form>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script>
        $(":input").inputmask();
    </script>
@endpush