<div class="grid grid-cols-1 gap-2 place-items-center">
    <form class="m-6 flex">
        <input class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" placeholder="Enter CNIC / CRC" id="cnic" name="cnic" type="text" value="" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X" required/>
        <button class="px-8 rounded-r-lg bg-green-700  text-white font-bold p-4 uppercase border-green-900 border-t border-b border-r">Search Applicant</button>
    </form>
    
    <div class="m-6 flex">
        <p class="text-3xl">OR</p>
    </div>

    <div class="m-6 flex">
        <a href="{{ route('admin.applications.index') }}" class="px-8 rounded-lg bg-green-700 text-white font-bold p-4 uppercase border-green-900 border-t border-b border-r">Start a new Application</a>
    </div>
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