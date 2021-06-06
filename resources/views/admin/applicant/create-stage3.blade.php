<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Registration') }}
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
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">CNIC / CRC</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Name</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Father Name</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Age</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">{{ $applicant->cnic }}</td>
                                <td class="px-6 py-4">{{ $applicant->name }}</td>
                                <td class="px-6 py-4">{{ $applicant->father_name }}</td>
                                <td class="px-6 py-4">{{ $applicant->dob->age . " Years" }}</td>
                            </tr>
                        </tbody>
                        <thead class="bg-gray-50">
                            <tr class="text-gray-600 text-left">
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Gender</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Type of disability</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Nature of disability</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Cause of disability</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4">{{ $applicant->gender }}</td>
                                <td class="px-6 py-4">{{ $applicant->disabilityType->type }}</td>
                                <td class="px-6 py-4">{{ $applicant->nature_of_disability }}</td>
                                <td class="px-6 py-4">{{ $applicant->cause_of_disability }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="overflow-hidden sm:rounded-lg mt-6 grid grid-cols-4 gap-2 place-items-center">
                        @foreach($applicant->resources as $resource)
                            <livewire:show-thumbnail :resource="$resource" />
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id='stage1' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5 pb-8 grid grid-cols-1 gap-2 place-items-center">
                        {{ __("Doctor's Assessment") }}
                    </h2>
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Error!</p>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        <br>
                    @endif
                    <form method="POST" action="{{ route('admin.assessments.store') }}">
                        @csrf
                        <input type="hidden" name="applicant_id" value="{{ $applicant->id }}">
                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="cnic">
                                    Doctor's Name.
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <input class="form-input block w-full focus:bg-white" id="doctor_name" name="doctor_name" type="text" value="{{ old('doctor_name') }}" required>
                                <p class="py-2 text-sm text-gray-600">The name of the doctor who is performing the assessment.</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                                    Clinical Findings
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <textarea class="form-textarea block w-full focus:bg-white" id="clinical_findings" name="clinical_findings" rows="8" required>{{ old('clinical_findings') }}</textarea>
                                <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="cnic">
                                    Fit for job?
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <span class="mr-12">
                                    <input class="form-input focus:bg-white" id="fit_for_job" name="fit_for_job" type="radio" value="1" {{ (old("fit_for_job") == '1' ? "checked" : "") }} required> Yes
                                </span>
                                <span>
                                    <input class="form-input focus:bg-white" id="fit_for_job" name="fit_for_job" type="radio" value="0" {{ (old("fit_for_job") == '0' ? "checked" : "") }} required> No
                                </span>
                                <p class="py-2 text-sm text-gray-600">Is the applicant fit for job?</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/3">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="cnic">
                                    Fit for Driving?
                                </label>
                            </div>
                            <div class="md:w-2/3">
                                <span class="mr-12">
                                    <input class="form-input focus:bg-white" id="fit_for_driving" name="fit_for_driving" type="radio" value="1" {{ (old("fit_for_driving") == '1' ? "checked" : "") }} required> Yes
                                </span>
                                <span>
                                    <input class="form-input focus:bg-white" id="fit_for_driving" name="fit_for_driving" type="radio" value="0" {{ (old("fit_for_driving") == '0' ? "checked" : "") }} required> No
                                </span>
                                <p class="py-2 text-sm text-gray-600">Is the applicant fit for driving?</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-2 place-items-end">
                            <button class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                Submit Clinical Assessment
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