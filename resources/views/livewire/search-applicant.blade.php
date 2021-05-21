<div class="grid grid-cols-1 gap-2 place-items-center">
    <form class="m-6 flex">
        <input class="rounded-l-lg p-4 border-t mr-0 border-r-0 border-b border-l text-gray-800 border-gray-200 bg-white" placeholder="Enter CNIC / CRC" id="cnic" name="cnic" type="text" value="{{ request()->has('cnic') ? request()->input('cnic'): "" }}" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X" required/>
        <button class="px-8 rounded-r-lg hover:bg-green-700 text-green-700 hover:text-white p-4 border-t border-b border-r outline-none focus:shadow-outline border-l-0">Search Applicant</button>
           
        <a href="{{ route('dashboard') }}" class="px-8 font-bold p-4 uppercase">Reset</a>
    </form>
    @if(\Auth::user()->role == 'Help Desk')
        <div class="m-6 flex">
            <p class="text-3xl">OR</p>
        </div>

        <div class="m-6 flex">
            <a href="{{ route('admin.applications.index') }}" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Start a new Application</a>
        </div>
    @endif
</div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
    <script>
        $(":input").inputmask();

        $(document).ready(function(){
            $("#marital_status").change(function(){
                $(this).find("option:selected").each(function(){
                    var optionValue = $(this).attr("value");
                    if(optionValue == "Married"){
                        $("#spouse-details").show();
                    } else{
                        $("#spouse-details").hide();
                    }
                });
            }).change();
        });
    </script>
@endpush