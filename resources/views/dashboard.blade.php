<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Success!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                    <br>
                @endif
                <livewire:search-applicant />
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">
                <table class="mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-600 text-left">
                            <th class="font-semibold text-sm uppercase px-6 py-4">CNIC / CRC</th>
                            <th class="font-semibold text-sm uppercase px-6 py-4">Name</th>
                            <th class="font-semibold text-sm uppercase px-6 py-4">Current Status</th>
                            <th class="font-semibold text-sm uppercase px-6 py-4"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($applicants as $applicant)
                            <tr>
                                <td class="px-6 py-4">{{ $applicant->cnic }}</td>
                                <td class="px-6 py-4">{{ $applicant->name }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $assessment = $applicant->assessments()->where('user_id', \Auth::id())->count()
                                    @endphp
                                    @if(\Auth::user()->role == 'Assessment' && $applicant->status == 2 && $assessment > 0)
                                        Assessment In progress
                                    @else
                                        {{ $applicant->applicationStatus->title }}
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center rounded-lg text-lg" role="group">
                                        @if(\Auth::user()->role == 'Help Desk')
                                            <a href="{{ route('admin.applications.create', ['applicant_id' => $applicant->id]) }}" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Upload Documents</a>
                                        @endif
                                        @if(\Auth::user()->role == 'Assessment' && $applicant->status == 2 && $assessment == 0 )
                                            <a href="{{ route("admin.applications.assessment", [$applicant->id]) }}" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Start Assessment</a>
                                        @endif
                                        @if(\Auth::user()->role == 'CRPD' && $applicant->status == 3 )
                                            <a href="{{ route("admin.applications.verification", [$applicant->id]) }}" class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Start Verification</a>
                                        @endif
                                        {{-- <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 border-r-0 px-2 py-2 mx-0 outline-none focus:shadow-outline">Send for Board Approval</button> --}}
                                        {{-- <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 px-2 border-r-0 py-2 mx-0 outline-none focus:shadow-outline">Details</button> --}}
                                        {{-- <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 rounded-r-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">View Info</button> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-8">
                    {{ $applicants->links() }}
                </div>
                @if($applicants->isEmpty())
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        <p class="font-bold">Yay!</p>
                        <p>Your workspace seems clear.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
