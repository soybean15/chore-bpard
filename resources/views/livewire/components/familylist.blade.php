<?php

use function Livewire\Volt\{state,computed,on,uses};
use Mary\Traits\Toast;
use App\Models\Family;
//

uses([Toast::class]);
$families = computed(function () {
    return Auth::user()->families;
});


on(['refresh-table' => function () {
    $this->dispatch('$refresh');
}]);

$edit = function($family){

    $this->dispatch('open-create-family-modal',family:$family);
};

$delete = function(Family $family){
    $family->delete();
    $this->error('Item Deleted', position: 'toast-bottom');
};



?>

<div>



    <div class="flex items-center justify-between my-3 text-xl font-bold "><span>Family List </span>
        <livewire:components.createfamilymodal/>

    </div>
    <ul class="w-full p-10 border divide-y divide-gray-200 dark:divide-gray-700 ">

        @foreach ($this->families as $family)
            <li class="p-3 sm:pb-4">
                <div class="flex items-center space-x-4 rtl:space-x-reverse">
                    {{-- <div class="flex-shrink-0">
                  <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-1.jpg" alt="Neil image">
               </div> --}}
                    <div class="flex-1 min-w-0">
                        <p class="flex items-center font-medium text-gray-900 truncate text-md dark:text-white ">
                            {{ $family->name }}
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            Number of members : 0

                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        <x-dropdown>
                            <x-menu-item title="Edit" icon="o-pencil-square" wire:click="edit({{ $family }})" />
                            <x-menu-item title="Remove" icon="o-trash" wire:confirm='Are you sure you want to delete this item?'  wire:click="delete({{ $family }})"/>

                        </x-dropdown>

                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
