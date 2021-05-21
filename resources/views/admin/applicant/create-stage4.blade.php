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
                                <td class="px-6 py-4">{{ $applicant->type_of_disability }}</td>
                                <td class="px-6 py-4">{{ $applicant->nature_of_disability }}</td>
                                <td class="px-6 py-4">{{ $applicant->cause_of_disability }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id='stage1' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5 pb-8 grid grid-cols-1 gap-2 place-items-center">
                        {{ __("Clinical Findings") }}
                    </h2>
                    <table class="mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-auto table-fixed">
                        <thead class="bg-gray-50">
                            <tr class="text-gray-600 text-left">
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Organization / Department</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Doctor's Name</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Clinical Findings</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Is fit for Job?</th>
                                <th class="font-semibold text-sm font-bold uppercase px-6 py-4">Is fit for Driving?</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($applicant->assessments as $assessment)
                                <tr>
                                    <td class="px-6 py-4">{{ $assessment->user->name }}</td>
                                    <td class="px-6 py-4">{{ $assessment->doctor_name }}</td>
                                    <td class="px-6 py-4 overflow-ellipsis whitespace-nowrap overflow-hidden">{{ $assessment->clinical_findings }}</td>
                                    <td class="px-6 py-4">{{ $assessment->fit_for_job ? "Yes" : "No" }}</td>
                                    <td class="px-6 py-4">{{ $assessment->fit_for_driving ? "Yes" : "No" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <form method="POST" action="{{ route('admin.applications.issueCertificate', [$applicant->id]) }}" class="mt-10">
                        @csrf
                        <div class="grid grid-cols-1 gap-2 place-items-end">
                            <div class="flex justify-center rounded-lg text-lg" role="group">
                                <button type="submit" name="issue" value="yes" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-l-lg border-r-0 px-2 py-2 mx-0 outline-none focus:shadow-outline">Verify and Issue DC</button>
                                {{-- <a href="#" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 border-r-0 px-2 py-2 mx-0 outline-none focus:shadow-outline">Start Assessment</a> --}}
                                <button type="submit" name="issue" value="no" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-r-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Verify and Don't issue DC</button>
                            </div>
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