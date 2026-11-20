@props([
    'name' => null,
    'value' => null,
    'label' => null,
    'help' => null,
    'error' => null,
    'disabled' => false,
    'multiple' => false,
    'accept' => 'image/*',
    'maxSize' => 5120, // KB
])

<?php
$dropzoneId = 'gm-dropzone-' . uniqid();
$inputId = $name ?? 'gm-upload-' . uniqid();
?>

<div {{ $attributes->merge(['class' => 'gm-admin-image-uploader']) }}>
    @if($label)
        <label for="{{ $inputId }}" class="gm-admin-form-row__label">{{ $label }}</label>
    @endif

    <div class="gm-admin-image-uploader__dropzone {{ $value ? 'has-image' : '' }}" id="{{ $dropzoneId }}" data-image-uploader>
        <input
            type="file"
            name="{{ $name }}"
            id="{{ $inputId }}"
            accept="{{ $accept }}"
            @if($multiple) multiple @endif
            class="gm-admin-image-uploader__input"
            @if($disabled) disabled @endif
        >

        @if($value)
            @if(is_array($value))
                @foreach($value as $index => $img)
                    <div style="position: relative; display: inline-block; margin: var(--s-2);">
                        <img src="{{ $img }}" alt="" class="gm-admin-image-uploader__preview" style="max-width: 120px; max-height: 120px;">
                        <button type="button" class="gm-admin-image-uploader__remove" aria-label="Remove image">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>
                @endforeach
            @else
                <img src="{{ $value }}" alt="" class="gm-admin-image-uploader__preview" style="max-width: 100%; max-height: 160px;">
                <button type="button" class="gm-admin-image-uploader__remove" aria-label="Remove image">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            @endif
        @else
            <div class="gm-admin-image-uploader__placeholder">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                <span>Click or drag to upload</span>
                @if($maxSize)
                    <small style="color: var(--c-ink-300);">Max {{ $maxSize / 1024 }}MB</small>
                @endif
            </div>
        @endif
    </div>

    @if($error)
        <p class="gm-admin-form-row__error">{{ $error }}</p>
    @elseif($help)
        <p class="gm-admin-image-uploader__hint">{{ $help }}</p>
    @endif
</div>

@push('scripts')
<script>
    (function() {
        const dropzone = document.getElementById('{{ $dropzoneId }}');
        const input = document.getElementById('{{ $inputId }}');
        if (!dropzone || !input) return;

        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => dropzone.classList.add('dragover'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => dropzone.classList.remove('dragover'), false);
        });

        dropzone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            if (files.length) {
                input.files = files;
                input.dispatchEvent(new Event('change', { bubbles: true }));
            }
        }, false);

        dropzone.addEventListener('click', () => input.click());
    })();
</script>
@endpush