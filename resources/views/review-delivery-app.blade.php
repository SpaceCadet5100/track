<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard / Review a delivery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
	  <form method="POST" action="{{ route('add-delivery-review') }}">
		    @csrf

	            <div >
			<x-input type="hidden" id="packageId" name="packageId" value="{{ $packageId }}"/>
		    </div>

	            <div>
			<x-label for="stars" :value="__('In the 1-5 range how many stars was the delivery worth?')" />
			<x-input id="stars" class="block mt-2 w-full" type="number" min="1" max="5" name="stars" :value="old('stars')" required autofocus />
		    </div>

		    <div>
			<x-label for="text" :value="__('Voice your opinion')" />
			<x-input id="text" class="block mt-2 w-full" type="text" name="text" :value="old('text')" required autofocus />
		    </div>
			<br>
		    
		    <div class="flex items-center justify-end mt-4">
			<x-button class="ml-4">
			    {{ __('Send review') }}
			</x-button>
		    </div>
		</form>
                </div>
            </div>
        </div>
      
    </div>
</x-app-layout>
