@props(['disabled' => false, 'options' => [], 'defaultValue' => null, 'placeholder' => 'Select an option'])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'class="flex h-10 w-full rounded-md border border-black dark:border-gray-500 bg-white dark:bg-black capitalize px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-gray-400 dark:placeholder:text-gray-500 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"',
]) !!}>
    <option value="" disabled selected class="capitalize
    text-gray-400 dark:text-gray-500">
        {{ $placeholder }}
    </option>
    @foreach ($options as $key => $value)
        <option @if ($defaultValue === $key) selected @endif value="{{ $key }}" class="capitalize">
            {{ $value }}
        </option>
    @endforeach
</select>
