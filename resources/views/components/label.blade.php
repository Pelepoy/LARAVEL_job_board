<label for="{{ $for }}" class="mb-2 block text-small font-medium text-slate-700">
    {{ $slot }} @if ($required) <span class="text-red-500">*</span> 
    @endif
</label>
