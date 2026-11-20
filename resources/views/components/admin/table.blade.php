@props([
    'columns' => [],
    'rows' => [],
    'striped' => false,
    'hover' => true,
    'responsive' => true,
    'emptyMessage' => 'No records found',
    'actions' => null,
])

<?php
$classes = ['gm-admin-table'];
if ($striped) $classes[] = 'gm-admin-table--striped';
if ($hover) $classes[] = 'gm-admin-table--hover';
if ($responsive) $classes[] = 'gm-admin-table--responsive';
$class = implode(' ', $classes);
?>

<div style="overflow-x: auto;">
    <table {{ $attributes->merge(['class' => $class]) }}>
        <thead>
            <tr>
                @foreach($columns as $column)
                    <th
                        style="text-align: {{ $column['align'] ?? 'left' }};"
                        {{ isset($column['width']) ? 'width="' . $column['width'] . '"' : '' }}
                    >
                        {{ $column['label'] ?? ucfirst($column['key'] ?? '') }}
                    </th>
                @endforeach
                @if($actions)
                    <th class="gm-admin-table__cell--actions">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $row)
                <tr>
                    @foreach($columns as $column)
                        <td style="text-align: {{ $column['align'] ?? 'left' }};">
                            @if(isset($column['render']))
                                {{ $column['render']($row) }}
                            @else
                                {{ $row[$column['key']] ?? '' }}
                            @endif
                        </td>
                    @endforeach
                    @if($actions)
                        <td class="gm-admin-table__cell--actions">
                            <div class="gm-admin-table__actions">
                                @foreach($actions as $action)
                                    @php
                                        $label = $action['label'] ?? '';
                                        $url = $action['url']($row) ?? '#';
                                        $icon = $action['icon'] ?? '';
                                        $class = $action['class'] ?? '';
                                        $attrs = $action['attrs'] ?? [];
                                    @endphp
                                    <a
                                        href="{{ $url }}"
                                        class="gm-admin-table__action-btn gm-admin-table__action-btn--{{ $action['type'] ?? 'view' }} {{ $class }}"
                                        {{ collect($attrs)->map(fn($v, $k) => "$k=\"$v\"")->implode(' ') }}
                                        aria-label="{{ $label }}"
                                    >
                                        {!! $icon !!}
                                    </a>
                                @endforeach
                            </div>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + ($actions ? 1 : 0) }}" style="text-align: center; padding: var(--s-8); color: var(--c-ink-500);">
                        {{ $emptyMessage }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>