<?php

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{layout, with, usesPagination};

layout('layouts.app');

// Guna pagination supaya page tak berat
usesPagination();

with(
    fn() => [
        'notes' => Note::where('user_id', Auth::id())->latest()->paginate(10),
    ],
);

$delete = function (Note $note) {
    // Pastikan user hanya delete nota sendiri
    $this->authorize('delete', $note);
    $note->delete();

    session()->flash('message', 'Nota berjaya dipadam!');
};

?>


<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Senarai Nota') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div class="flex justify-end">
            <a href="{{ route('notes.create') }}" wire:navigate
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                + Tambah Nota Baru
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg divide-y">
            @foreach ($notes as $note)
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <a href="{{ route('notes.show', $note) }}" wire:navigate
                            class="text-lg font-bold hover:underline">
                            {{ Str::limit($note->content, 50) }}
                        </a>
                        <p class="text-xs text-gray-500">{{ $note->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="flex space-x-2">
                        <a href="{{ route('notes.edit', $note) }}" wire:navigate
                            class="text-yellow-600 hover:text-yellow-800">
                            Edit
                        </a>

                        <button wire:click="delete({{ $note->id }})" wire:confirm="Anda pasti?"
                            class="text-red-600 hover:text-red-800">
                            Padam
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $notes->links() }}
        </div>

    </div>
</div>
