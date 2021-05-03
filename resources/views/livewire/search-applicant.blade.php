<div class="grid grid-cols-1 gap-2 place-items-center">
    <form class="m-6 flex">
        <input class="rounded-l-lg p-4 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" placeholder="Your CNIC / Form-B"/>
        <button class="px-8 rounded-r-lg bg-green-700  text-white font-bold p-4 uppercase border-green-900 border-t border-b border-r">Search Applicant</button>
    </form>
    
    <div class="m-6 flex">
        <p class="text-3xl">OR</p>
    </div>

    <div class="m-6 flex">
        <a href="{{ route('admin.applications.index') }}" class="px-8 rounded-lg bg-green-700 text-white font-bold p-4 uppercase border-green-900 border-t border-b border-r">Start a new Application</a>
    </div>
</div>