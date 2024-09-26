<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Therapist Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Available Content</h3>

                @if ($contents->isEmpty())
                    <p class="text-gray-600">No content available.</p>
                @else
                    @foreach ($contents as $content)
                        <div class="border-b mb-4 pb-2">
                            <h4 class="font-bold">{{ $content->title }}</h4>
                            <img src="{{ asset('images/' . $content->image) }}" alt="{{ $content->title }}" class="w-32 h-32 object-cover mb-2">
                            <p class="text-gray-700">{{ $content->content }}</p>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
