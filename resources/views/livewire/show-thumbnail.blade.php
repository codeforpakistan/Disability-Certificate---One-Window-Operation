<div class="bg-white overflow-hidden border-b-4 border-blue-500 mx-6 my-6">
	<img src="{{ $resource->type == "application/pdf" ? asset('img/pdf.png') : $resource->url }}" alt="{{ $resource->name }}" class="w-full object-cover h-16 sm:h-24 md:h-32">
	<div class="p-4 md:p-6">
		<p class="text-blue-500 font-semibold text-xs mb-1 leading-none">{{ $resource->type }}</p>
		<h3 class="font-semibold mb-2 text-xl leading-tight sm:leading-normal">
			@if($resource->name)
				{{ $resource->name }}
			@else
				<select wire:change="setName" wire:model="name" wire class="form-select block w-full focus:bg-white" id="attachment_type" name="attachment_type" required>
                    <option value="">Select attachment type</option>
                    <option value="B Form">B Form</option>
                    <option value="CNIC">CNIC</option>
                    <option value="CRC">CRC</option>
                    <option value="Picture">Picture</option>
                    <option value="Educational Document">Educational Document</option>
                    <option value="Medical Record">Medical Record</option>
                    <option value="Employment document">Employment document</option>
                    <option value="Other">Other</option>
                </select>
               @endif
		</h3>
		<div class="text-sm flex items-center">
			<svg class="opacity-75 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="12" height="12" viewBox="0 0 97.16 97.16" style="enable-background:new 0 0 97.16 97.16;" xml:space="preserve">
				<path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823    c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/>
				<path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832    c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>
			</svg>
			<p class="leading-none">{{ $resource->created_at->diffForHumans() }}</p>
		</div>
		<p class="text-blue-500 font-semibold text-xs my-5 leading-none">
			<a class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" target="_blank" href="{{ $resource->url }}">View / Download</a>
		</p>
  	</div>
</div>