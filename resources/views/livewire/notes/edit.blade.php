<?php

use App\Models\Note;
use function Livewire\Volt\{layout, state, rules, mount};

layout('layouts.app');

state(['note' => null, 'content' => '']);

rules(['content' => 'required|min:5|string']);

mount(function (Note $note) {
    $this->note = $note;
    $this->content = $note->content;
});

$update = function () {
    $this->validate();

    $this->note->update([
        'content' => $this->content,
    ]);

    session()->flash('message', 'Nota berjaya dikemaskini!');

    return $this->redirect(route('notes.index'), navigate: true);
};

?>

<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Edit Nota') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm rounded-lg">
            <form wire:submit="update">
                <label class="block mb-2 font-bold">Kemaskini Nota:</label>
                <textarea wire:model="content"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="5"></textarea>

                @error('content')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror

                <div class="mt-4 flex justify-end space-x-2">
                    <a href="{{ route('notes.index') }}" wire:navigate
                        class="px-4 py-2 text-gray-600 hover:text-gray-900">Batal</a>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                        Kemaskini
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
