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
            @if(request()->has('cnic'))
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mt-6">
                    @if( $applicant )
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
                            <tr>
                                <td class="px-6 py-4">{{ $applicant->cnic }}</td>
                                <td class="px-6 py-4">{{ $applicant->name }}</td>
                                <td class="px-6 py-4">{{ $applicant->applicationStatus->title }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center rounded-lg text-lg" role="group">
                                        <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-r-0 border-green-700 rounded-l-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">Edit Info</button>
                                        <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 px-2 py-2 mx-0 outline-none focus:shadow-outline">Start Assessment</button>
                                        <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 px-2 border-l-0 py-2 mx-0 outline-none focus:shadow-outline">Send for Board Approval</button>
                                        <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-green-700 px-2 border-l-0 py-2 mx-0 outline-none focus:shadow-outline">Details</button>
                                        <button class="bg-white text-green-700 hover:bg-green-700 hover:text-white border border-l-0 border-green-700 rounded-r-lg px-2 py-2 mx-0 outline-none focus:shadow-outline">View Info</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Caution!</p>
                            <p>No applicant found for the cnic.</p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
