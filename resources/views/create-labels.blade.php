
<x-app-layout>
    <x-slot name="header">
	<div style="display: flex">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard / Bulkanator 3000: One and only commercial label maker') }}
        </h2>
	</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
		<x-auth-validation-errors class="mb-4" :errors="$errors" />

		<form method="POST" action="{{ route('store-labels') }}">
		    @csrf
		<x-label for="api-calls"  value="API-calls (seperate each call with a comma): " />

		<x-input id="api-calls" style="height: 300px; margin: auto;" class="block mt-1 w-full" type="text" name="api-calls" :value="old('')" required autofocus />
	    <div class="flex items-center justify-end mt-4">
		<x-button value="submit" class="ml-4">
		    {{ __('Add') }}
		</x-button>
		</form>
		</div>
            </div>
        </div>
    </div>
</x-app-layout>
