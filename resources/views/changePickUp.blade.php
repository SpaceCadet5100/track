<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('content.pickupChange')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>{{__('content.warning')}}</h3>
                    @if (count(array($packages)) > 0)

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="GET" action="ConfirmPickUpChange">
                            @csrf
                            <x-button value="submit" style="margin: 10px; margin-right: 5px;">
                                {{__('content.pickupChange')}}
                            </x-button>


                            <div class="form-group">
                                <label for="formGroupExampleInput">{{__('content.country')}}:</label>
                                <input type="text" class="form-control" name="Country"  placeholder="Country input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">{{__('content.Srteetname')}}:</label>
                                <input type="text" class="form-control" name="Srteetname" placeholder="Srteet name input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">{{__('content.housenumber')}}:</label>
                                <input type="number" class="form-control" name="housenumber" placeholder="house number input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">{{__('content.postalcode')}}:</label>
                                <input type="text" class="form-control" name="postalcode" placeholder="postal code input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">{{__('content.City')}}:</label>
                                <input type="text" class="form-control" name="City" placeholder="City input">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">{{__('content.Date')}}:</label>
                                <input type="datetime-local" class="form-control" name="Date" >
                            </div>




                            <br>
                            <hr>

                            @foreach ($packages as $package)

                                <br>
                                <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ __('content.Package') }}
                                </h3>
                                <input type="hidden" name="package[]" value="{{ $package->id }}">

                                {{__('content.pickUpTime')}}: {{ $package->pick_up_time}} <br>
                                Status: {{ $package->status}} <br>
                                {{__('content.Sender')}}: {{ $package->Sender->name }}  <br>
                                {{__('content.Sharablelink')}}: <span style="background-color: lightgray; color: black">
			{{ $package->guest_link }}
			</span><br>

                                <div style="display: flex; padding: 5px">
                                    <div style="margin: 5px">
                                        {{__('content.SenderAddresss')}}:<br>
                                        {{ $package->SenderAddress->firstname }}
                                        {{ $package->SenderAddress->lastname}} <br>
                                        {{ $package->SenderAddress->street_name}}
                                        {{ $package->SenderAddress->house_number}} <br>
                                        {{ $package->SenderAddress->postal_code}}
                                        {{ $package->SenderAddress->city}}<br>
                                        {{ $package->SenderAddress->country}} <br>
                                    </div>
                                    <div style="margin: 5px; margin-left: 30px">
                                        {{__('content.RecipientAddresss')}}:<br>
                                        {{ $package->RecipientAddress->firstname }}
                                        {{ $package->RecipientAddress->lastname}} <br>
                                        {{ $package->RecipientAddress->street_name}}
                                        {{ $package->RecipientAddress->house_number}} <br>
                                        {{ $package->RecipientAddress->postal_code}}
                                        {{ $package->RecipientAddress->city}}<br>
                                        {{ $package->RecipientAddress->country}} <br>
                                    </div>

                                </div>

                                <hr>
                            @endforeach
                            <x-button value="submit" style="margin: 10px;">
                                {{__('content.pickupChange')}}
                            </x-button>

                        </form>
                    @else
                        {{__('content.Nopackagesfround')}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

