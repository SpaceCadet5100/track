<x-app-layout>
    <x-slot name="header">
	<div style="display: flex">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard / CSV uploader (almost worked)') }}
        </h2>
	</div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
		<x-auth-validation-errors class="mb-4" :errors="$errors" />

		<form method="POST" enctype="multipart/form-data" action="{{ route('csv-upload') }}">
		    @csrf
		<x-label for="csv"  value="Upload the CSV file:" />

		<x-input id="csv" class="block mt-1 w-full"  accept=".csv" type="file" name="csv" :value="old('')" required autofocus />
	    <div class="flex items-center justify-end mt-4">
		<x-button value="submit" class="ml-4">
		    {{ __('Add') }}
		</x-button>
		</form>
		</div>
            </div>
        </div>
    </div>
</x-app-layout>i
