<!-- Blade input component -->
<div>
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-100">
        {{ $value }}
    </label>
    <div class="mt-1">
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}"
               class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-100">
    </div>
</div>
