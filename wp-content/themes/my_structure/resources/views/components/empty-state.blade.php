@props([
    'message' => __('No content found.', 'my_structure'),
])

<div class="rounded-xl border border-dashed border-gray-300 bg-gray-50 p-8 text-center">
    <p class="text-gray-700">{{ $message }}</p>
</div>
