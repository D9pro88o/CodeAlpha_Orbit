@php
$sizeClasses = match($size) {
    'xs' => 'w-6 h-6 text-[10px]',
    'sm' => 'w-8 h-8 text-xs',
    'md' => 'w-10 h-10 text-sm',
    default => 'w-8 h-8 text-xs',
};
$ringInset = match($size) {
    'xs' => '-inset-[3px]',
    'sm' => '-inset-1',
    'md' => '-inset-1.5',
    default => '-inset-1',
};
@endphp

<span class="relative inline-flex items-center justify-center {{ $sizeClasses }} rounded-full bg-ink-navy text-canvas font-mono font-medium shrink-0">
    {{ $initials }}
    <span class="absolute {{ $ringInset }} rounded-full border border-dashed border-orbit-teal/50"></span>
</span>