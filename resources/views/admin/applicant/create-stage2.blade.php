<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Registration - Document uploads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id='stage2' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white grid grid-cols-1 gap-2 place-items-center">
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Error!</p>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        <br>
                    @endif
                    <form method="POST" action="{{ route('admin.resources.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="applicant_id" value="{{ request()->input('applicant_id') }}">
                        <input class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" type="file" name="applicant_files[]" id="applicant_files" multiple required/>
                        <button class="px-8 rounded-r-lg bg-green-700  text-white font-bold p-4 uppercase border-green-900 border-t border-b border-r">Upload Document</button>
                    </form>
                </div>
            </div>
            <div class="overflow-hidden sm:rounded-lg mt-6 grid grid-cols-4 gap-2 place-items-center">
                @foreach($resources as $resource)
                    <livewire:show-thumbnail :resource="$resource" />
                @endforeach
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">
                <div class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    <form method="GET" action="">
                        @csrf
                        <div class="grid grid-cols-1 gap-2 place-items-end">
                            <button class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Next
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
</x-app-layout>