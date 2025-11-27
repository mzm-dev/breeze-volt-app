<?php

use App\Models\Note;
use function Livewire\Volt\{layout, state, mount};

layout('layouts.app');

state(['note' => null]);

mount(function (Note $note) {
    $this->note = $note;
});

?>


<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Lihat Nota') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 shadow-sm rounded-lg">
            <div class="mb-4">
                <h3 class="text-lg font-bold text-gray-700">Kandungan Nota:</h3>
                <p class="mt-2 text-gray-900 whitespace-pre-wrap">{{ $this->note->content }}</p>
            </div>

            <div class="border-t pt-4 text-sm text-gray-500">
                Dicipta pada: {{ $this->note->created_at->format('d M Y, h:i A') }}
            </div>

            <div class="mt-6">
                <a href="{{ route('notes.index') }}" wire:navigate class="text-indigo-600 hover:text-indigo-900">
                    &larr; Kembali ke Senarai
                </a>
            </div>
        </div>
    </div>
</div>
