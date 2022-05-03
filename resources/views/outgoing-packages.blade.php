
<x-app-layout>
    <x-slot name="header">
	<div style="display: flex">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('content.Outgoingpackages') }}
        </h2>
	<div style="margin-left: auto; display:flex">
		<form method="GET" action="/dashboard/outgoing-packages/">
			@csrf
			<select name="status" id="status">
				<option value="" selected disabled>Filter by status...</option>
				<option value"signed up">Signed up</option>
				<option value"printed">Printed</option>
				<option value"delivered">Delivered</option>
				<option value"sorting centre">Sorting centre</option>
				<option value"on the way">On the way</option>
			</select> 
			<select name="time" id="time">
				<option value="" selected disabled>Time order...</option>
				<option value="desc">Order descending</option>
				<option value="asc">Order ascending</option>
			</select> 
			<input type="text" name="search" placeholder="Find package...">	
			<x-button value="submit">
					    {{ __('Search') }}
			</x-button>
		</form>
	</div>
	</div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
		@if (count($packages) > 0)

		<form method="POST" action="print-lables">
		@csrf
		<x-button value="submit" style="margin: 10px; margin-right: 5px;">
			Print labels
		</x-button>
		<x-button type="button" style="margin: 10px; margin-left: 5px;" onclick="
			var checkboxes = document.getElementsByName('package[]');
			for (var checkbox of checkboxes){
				checkbox.checked = true;
			}">
            {{ __('content.Selectall') }}
		</x-button>

		<br>
		<hr>

		@foreach ($packages as $package)

			<br>
		        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
			     Package: {{ $package->id }}
			</h3>
			<div style="float: right">
			     Print label:
			     <input type="checkbox" name="package[]" value="{{ $package->id }}">
			</div>

			Status: {{ $package->status}} <br>
                {{ __('content.Sender') }}: {{ $package->Sender->name }}  <br>
                Sharable link: <span style="background-color: lightgray; color: black">
			{{ $package->guest_link }}
			</span><br>
			@if ($package->review != NULL)
                    {{ __('content.Recipientfeedback') }}:
				@if ($package->review->text != NULL) <q>{{ $package->review->text }}</q> @endif
				@for ($i = 0; $i < $package->review->stars; $i++) &#9733 @endfor /
				@for ($i = 0; $i < 5; $i++) &#9733 @endfor
			@endif

			<div style="display: flex; padding: 5px">
			<div style="margin: 5px">
                {{ __('content.SenderAddresss') }}:<br>
			{{ $package->SenderAddress->firstname }}
			{{ $package->SenderAddress->lastname}} <br>
			{{ $package->SenderAddress->street_name}}
			{{ $package->SenderAddress->house_number}} <br>
			{{ $package->SenderAddress->postal_code}}
			{{ $package->SenderAddress->city}}<br>
			{{ $package->SenderAddress->country}} <br>
			</div>
			<div style="margin: 5px; margin-left: 30px">
                {{ __('content.RecipientAddresss') }}:<br>
			{{ $package->RecipientAddress->firstname }}
			{{ $package->RecipientAddress->lastname}} <br>
			{{ $package->RecipientAddress->street_name}}
			{{ $package->RecipientAddress->house_number}} <br>
			{{ $package->RecipientAddress->postal_code}}
			{{ $package->RecipientAddress->city}}<br>
			{{ $package->RecipientAddress->country}} <br>
			</div>
			<div style="margin: 5px; margin-left: 30px">
			Barcode:<br>
			{!! $package->barcode !!}
			{{ $package->barcode_str }}
			</div>
			</div>

			<hr>
		@endforeach
		<x-button value="submit" style="margin: 10px;">
			Print labels
		</x-button>

		</form>
		@else
                        {{ __('content.Nopackagesfround') }}
		@endif
                </div>
            </div>
		{{ $packages->links() }}
        </div>
    </div>
	
</x-app-layout>
