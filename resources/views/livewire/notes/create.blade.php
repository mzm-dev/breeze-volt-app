<?php

use function Livewire\Volt\{layout, state, rules};

layout('layouts.app');

state(['content' => '']);

rules(['content' => 'required|min:5|string']);

$save = function () {
    $this->validate();

    auth()
        ->user()
        ->notes()
        ->create([
            'user_id' => auth()->user()->id,
            'content' => $this->content,
        ]);

    session()->flash('message', 'Nota berjaya dicipta!');

    return $this->redirect(route('notes.index'), navigate: true);
};

?>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Cipta Nota') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm rounded-lg">
            <form wire:submit="save">
                <label class="block mb-2 font-bold">Isi Nota Anda:</label>
                <textarea wire:model="content"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="5"></textarea>

                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mt-4 flex justify-end space-x-2">
                    <a href="{{ route('notes.index') }}" wire:navigate
                        class="px-4 py-2 text-gray-600 hover:text-gray-900">Batal</a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
