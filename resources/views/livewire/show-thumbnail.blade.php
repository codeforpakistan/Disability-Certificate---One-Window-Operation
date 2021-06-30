<div class="card" style="width: {{ $imageSize ? '9rem' : '12rem' }};">
    <img class="card-img-top" style="max-height:{{ $imageSize ? $imageSize : 180 }}px; max-width:{{ $imageSize ? $imageSize : 180 }}px; overflow:hidden;" src="{{ $resource->type == "application/pdf" ? asset('img/pdf.png') : $resource->url }}" alt="{{ $resource->name }}">
    <div class="card-body ">
        @if(!$imageSize)
            <p class="card-text">{{ $resource->type }}</p>
        @endif
        <h6 class="card-title">
            @if($resource->name)
                {{ $resource->name }}
            @else
                <select wire:change="setName" wire:model="name" class="form-control" id="attachment_type" name="attachment_type" required>
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
        </h6>
        @if(!$imageSize)
            <p class="card-text align-items-center">
                <svg class="opacity-75 mr-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="12" height="12" viewBox="0 0 97.16 97.16" style="enable-background:new 0 0 97.16 97.16;" xml:space="preserve">
                    <path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823    c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/>
                    <path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832    c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>
                </svg> <span style="font-size: 12px;">{{ $resource->created_at->diffForHumans() }}</span>
            </p>
        @endif
        <a href="{{ $resource->url }}" class="btn btn-primary" target="_blank">View{{ !$imageSize ?? ' / Download' }}</a>
    </div>
</div>