
<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Your package
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
			@if ($package->status == "delivered" && $package->review == NULL)
				<x-button onclick="location.href='review-delivery/{{ $package->id }}'" style="float: right">
					    {{ __('Leave feedback') }}
				</x-button>

			@elseif ($package->review != NULL)
	 		<x-button style="float: right" disabled>
				    {{ __('Feedback recieved') }}
			</x-button>
			@endif
		        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
			    {{ __('Package') }}
			</h3>
			Status: {{ $package->status}} <br>
			Sender: {{ $package->Sender->name }}  <br>
			
			<div style="display: flex; padding: 5px">
			<div style="margin: 5px">
			Sender Addresss:<br>
			{{ $package->SenderAddress->firstname }} 
			{{ $package->SenderAddress->lastname}} <br>
			{{ $package->SenderAddress->street_name}}  
			{{ $package->SenderAddress->house_number}} <br>
			{{ $package->SenderAddress->postal_code}}
			{{ $package->SenderAddress->city}}<br>
			{{ $package->SenderAddress->country}} <br>
			</div>
			<div style="margin: 5px; margin-left: 30px">
			Recipient Address:<br>
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
			<div style="display: block ruby;">
			<x-button onclick="location.href='/register-reciever'">
				    {{ __('Register now') }}
			</x-button>
			<h4> to manage your deliveries through the app!</h4>
			</div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
