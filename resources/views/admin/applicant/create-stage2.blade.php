<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Registration - Document uploads') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="py-8 mt-6 lg:mt-0 rounded shadow bg-white grid grid-cols-1 gap-2 place-items-center">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                        {{ __('Patient Info') }}
                    </h2>
                    <table class="mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                        <thead class="bg-gray-50">
                            <tr class="text-gray-600 text-left">
                                <th class="font-semibold text-sm uppercase px-6 py-4">CNIC / CRC</th>
                                <th class="font-semibold text-sm uppercase px-6 py-4">Name</th>
                                <th class="font-semibold text-sm uppercase px-6 py-4">Father Name</th>
                                <th class="font-semibold text-sm uppercase px-6 py-4">Type of disability</th>
                                <th class="font-semibold text-sm uppercase px-6 py-4">Nature of disability</th>
                                <th class="font-semibold text-sm uppercase px-6 py-4">Cause of disability</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">{{ $applicant->cnic }}</td>
                                <td class="px-6 py-4">{{ $applicant->name }}</td>
                                <td class="px-6 py-4">{{ $applicant->father_name }}</td>
                                <td class="px-6 py-4">{{ $applicant->type_of_disability }}</td>
                                <td class="px-6 py-4">{{ $applicant->nature_of_disability }}</td>
                                <td class="px-6 py-4">{{ $applicant->cause_of_disability }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
                    <form method="POST" action="{{ route('admin.applications.update', [$applicant->id]) }}">
                        @method("PUT")
                        <input type="hidden" name="status" value="2">
                        @csrf
                        <div class="grid grid-cols-1 gap-2 place-items-end">
                            <button class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Submit for clinical assessment
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