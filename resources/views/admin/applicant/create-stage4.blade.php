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
                                <div x-data="{ 'verifyAndIssueDCModal': false }" @keydown.escape="verifyAndIssueDCModal = false">
                                    <button type="button" name="issue" value="yes" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-l-lg border-r-0 px-2 py-2 mx-0 outline-none focus:shadow-outline" @click="verifyAndIssueDCModal = true">Verify and Issue DC</button>
                                    <!-- Modal -->
                                    <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="verifyAndIssueDCModal">
                                        <!-- Modal inner -->
                                        <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg" @click.away="verifyAndIssueDCModal = false" x-transition:enter="motion-safe:ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                                            <!-- Title / Close-->
                                            <div class="flex items-center justify-between">
                                                <h5 class="mr-3 text-black max-w-none">Verify and Issue Disability Certificate</h5>
                                                <button type="button" class="z-50 cursor-pointer" @click="verifyAndIssueDCModal = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- content -->
                                            <div>
                                                <form method="POST" action="{{ route('admin.applications.issueCertificate', [$applicant->id]) }}" class="mt-10">
                                                    @csrf
                                                    <div class="md:flex mb-6">
                                                        <textarea class="form-textarea block w-full focus:bg-white" id="comments" name="comments" placeholder="Add any comments here. if no comments add N/A" rows="8" required>{{ old('clinical_findings') }}</textarea>
                                                    </div>
                                                    <button type="submit" name="issue" value="yes" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Verify and Issue DC</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="{ 'verifyAndDonotIssueDC': false }" @keydown.escape="verifyAndDonotIssueDC = false">
                                    <button type="button" name="issue" value="no" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-r-lg px-2 py-2 mx-0 outline-none focus:shadow-outline" @click="verifyAndDonotIssueDC = true">Verify and Don't issue DC</button>
                                    <!-- Modal -->
                                    <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="verifyAndDonotIssueDC">
                                        <!-- Modal inner -->
                                        <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg" @click.away="verifyAndDonotIssueDC = false" x-transition:enter="motion-safe:ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                                            <!-- Title / Close-->
                                            <div class="flex items-center justify-between">
                                                <h5 class="mr-3 text-black max-w-none">Verify and Don't issue Disability Certificate</h5>
                                                <button type="button" class="z-50 cursor-pointer" @click="verifyAndDonotIssueDC = false">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </div>
                                            <!-- content -->
                                            <div>
                                                <form method="POST" action="{{ route('admin.applications.issueCertificate', [$applicant->id]) }}" class="mt-10">
                                                    @csrf
                                                    <div class="md:flex mb-6">
                                                        <textarea class="form-textarea block w-full focus:bg-white" id="comments" name="comments" placeholder="Add any comments here. if no comments add N/A" rows="8" required>{{ old('clinical_findings') }}</textarea>
                                                    </div>
                                                    <button type="submit" name="issue" value="no" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Verify and Don't issue DC</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <a href="#" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 border-r-0 px-2 py-2 mx-0 outline-none focus:shadow-outline">Start Assessment</a> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    @endpush
</x-app-layout>