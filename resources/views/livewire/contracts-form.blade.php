<div class="contract-form max-w-7xl p-4" wire:ignore.self>
    <h2 class="h2">Lease Agreement/Contract</h2>
    <form class="grid grid-cols-2 gap-x-8 gap-y-4" action="addContract" enctype="multipart/form-data">
        <!-- Unit Select -->
        <div>
            <x-input-label for="unit_id" :value="__('Select Unit')" />
            <x-select name="unit_id" id="unit_id"
                @change="$wire.getRooms($event.target.options[$event.target.selectedIndex].value)">
                <option>Select Unit</option>
                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}">
                        {{ $unit->unit_name }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('unit_id')" class="mt-2" />
        </div>

        <!-- Room Select -->
        <div>
            <x-input-label for="room_id" :value="__('Select Room')" />
            <x-select name="room_id" id="room_id">
                @forelse ($rooms as $room)
                    <option value="{{ $room->id }}">
                        {{ $room->room_number }}
                    </option>
                @empty
                    <option>Select a unit first</option>
                @endforelse
            </x-select>
            <x-input-error :messages="$errors->get('room_id')" class="mt-2" />
        </div>

        <!-- Start Date -->
        <div>
            <x-input-label for="start_date" :value="__('Start Date')" />
            <input type="date" name="start_date" id="start_date" class="input-text" value="{{ old('start_date') }}">
            <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
        </div>

        <!-- End Date -->
        <div>
            <x-input-label for="end_date" :value="__('End Date')" />
            <input type="date" name="end_date" id="end_date" class="input-text" value="{{ old('end_date') }}">
            <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
        </div>

        <!-- Terms of Payment -->
        <div>
            <x-input-label for="terms_of_payment" :value="__('Terms of Payment')" />
            <x-select name="terms_of_payment" id="terms_of_payment">
                @php
                    $default = old('terms_of_payment') ? old('terms_of_payment') : 'monthly';
                @endphp

                @foreach (App\Models\LeaseAgreement::$terms as $index => $term)
                    <option value="{{ $term }}" @selected($term === $default)>{{ Str::ucfirst($term) }}
                    </option>
                @endforeach
            </x-select>
            <x-input-error :messages="$errors->get('terms_of_payment')" class="mt-2" />
        </div>

        <!-- Agreed Payment -->
        <div>
            <x-input-label for="agreed_payment" :value="__('Agreed Payment Amount')" />
            <x-text-input id="agreed_payment" class="block mt-1 w-full" type="number" name="agreed_payment"
                :value="old('agreed_payment') ?? 0" required />
            <x-input-error :messages="$errors->get('agreed_payment')" class="mt-2" />
        </div>

        <!-- Months Deposit -->
        <div>
            <x-input-label for="months_deposit" :value="__('Months Deposit')" />
            <x-text-input id="months_deposit" class="block mt-1 w-full" type="number" name="months_deposit"
                :value="old('months_deposit') ?? 0" required />
            <x-input-error :messages="$errors->get('months_deposit')" class="mt-2" />
        </div>

        <!-- Deposit Amount -->
        <div>
            <x-input-label for="deposit_amount" :value="__('Total Deposit Amount')" />
            <x-text-input id="deposit_amount" class="block mt-1 w-full" type="number" name="deposit_amount"
                :value="old('deposit_amount') ?? 0" required />
            <x-input-error :messages="$errors->get('deposit_amount')" class="mt-2" />
        </div>

        <!-- Includes City Services -->
        <div class="flex gap-2 items-center">
            <input type="checkbox" name="includes_city_services" class="cursor-pointer" id="includes_city_services"
                @checked(old('includes_city_services'))>
            <x-input-label for="includes_city_services" class="cursor-pointer" :value="__('Includes City Services')" />
        </div>

        <!-- Contract Document -->
        <div>
            <x-input-label for="contract_doc" :value="__('Contract Document')" />
            <input class="mt-1" type="file" id="contract_doc" name="contract_doc" accept=".doc,.docx,.pdf" />
            <x-input-error :messages="$errors->get('contract_doc')" class="mt-2" />
        </div>

        <div class="flex col-span-2 justify-center my-4 gap-2">
            <button class="btn btn-success w-48" type="submit">
                Create New Contract
            </button>
            <button class="btn btn-danger w-48" wire:click.prevent="$dispatch('closeModal')">Cancel</button>
        </div>


    </form>
</div>
