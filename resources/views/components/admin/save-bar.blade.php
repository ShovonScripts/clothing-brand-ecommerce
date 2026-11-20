@props([
    'dirty' => false,
    'saving' => false,
    'onSave' => null,
    'onCancel' => null,
    'saveText' => 'Save',
    'cancelText' => 'Cancel',
    'showCancel' => true,
])

<div class="gm-admin-save-bar" {{ $attributes }}>
    <div class="gm-admin-save-bar__left">
        <span class="gm-admin-save-bar__status">
            <span class="gm-admin-save-bar__status-indicator{{ $dirty ? ' gm-admin-save-bar__status-indicator--dirty' : '' }}{{ $saving ? ' gm-admin-save-bar__status-indicator--saving' : '' }}"></span>
            <span>
                @if($saving)
                    Saving...
                @elseif($dirty)
                    Unsaved changes
                @else
                    Saved
                @endif
            </span>
        </span>
    </div>

    <div class="gm-admin-save-bar__right">
        @if($showCancel)
            <x-ui.button variant="ghost" size="md" :disabled="$saving">{{ $cancelText }}</x-ui.button>
        @endif
        <x-ui.button variant="primary" size="md" class="gm-admin-save-bar__btn" type="submit" :loading="$saving" :disabled="$saving">{{ $saveText }}</x-ui.button>
    </div>
</div>