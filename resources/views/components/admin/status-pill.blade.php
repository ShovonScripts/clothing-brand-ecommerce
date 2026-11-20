@props([
    'status' => 'pending',
    'size' => 'md',
    'dot' => false,
])

<?php
$classes = ['gm-admin-status-pill', "gm-admin-status-pill--{$status}", "gm-admin-status-pill--{$size}"];
if ($dot) $classes[] = 'gm-admin-status-pill--dot';
$class = implode(' ', $classes);
?>

<span {{ $attributes->merge(['class' => $class, 'role' => 'status']) }}>
    {{ ucwords(str_replace(['-', '_'], ' ', $status)) }}
</span>