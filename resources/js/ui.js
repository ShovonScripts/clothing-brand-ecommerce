/**
 * Shared behaviour for the design-system components in
 * resources/views/components/ui. Uses event delegation, so it works for any
 * number of instances and for markup inserted later (e.g. AJAX product lists).
 */

const OPEN = 'gm-drawer--open';
const MODAL_OPEN = 'gm-modal--open';

/* ------------------------------------------------------------------ */
/* Drawers and modals                                                  */
/* ------------------------------------------------------------------ */

function overlayFor(id) {
    // Accept either the panel id or the overlay id.
    const base = id.endsWith('-overlay') ? id.slice(0, -'-overlay'.length) : id;
    return {
        panel: document.getElementById(base),
        overlay: document.getElementById(`${base}-overlay`),
    };
}

function lockScroll(lock) {
    document.body.style.overflow = lock ? 'hidden' : '';
}

export function openLayer(id) {
    const { panel, overlay } = overlayFor(id);
    if (!panel && !overlay) return;
    if (overlay && overlay.hasAttribute('data-gm-modal')) {
        overlay.classList.add(MODAL_OPEN);
    } else {
        overlay?.classList.add(OPEN);
        panel?.classList.add(OPEN);
    }
    lockScroll(true);
    (panel || overlay).querySelector('[data-gm-close], button, a, input')?.focus({ preventScroll: true });
}

export function closeLayer(id) {
    const { panel, overlay } = overlayFor(id);
    overlay?.classList.remove(OPEN, MODAL_OPEN);
    panel?.classList.remove(OPEN);
    if (!document.querySelector(`.${OPEN}, .${MODAL_OPEN}`)) lockScroll(false);
}

function closeAll() {
    document.querySelectorAll(`.gm-drawer.${OPEN}, .gm-modal-overlay.${MODAL_OPEN}`).forEach((el) => {
        closeLayer(el.id);
    });
}

document.addEventListener('click', (e) => {
    const opener = e.target.closest('[data-gm-open]');
    if (opener) {
        e.preventDefault();
        openLayer(opener.getAttribute('data-gm-open'));
        return;
    }

    const closer = e.target.closest('[data-gm-close]');
    if (closer) {
        const layer = closer.closest('.gm-drawer, .gm-modal-overlay');
        if (layer) closeLayer(layer.id);
        return;
    }

    // Click on the dimmed overlay itself (not its content).
    if (e.target.matches('.gm-drawer-overlay[data-gm-overlay-for]')) {
        closeLayer(e.target.getAttribute('data-gm-overlay-for'));
    } else if (e.target.matches('.gm-modal-overlay[data-gm-modal]')) {
        closeLayer(e.target.id);
    }
});

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAll();
});

['drawer', 'modal'].forEach((kind) => {
    window.addEventListener(`gm:open-${kind}`, (e) => e.detail?.id && openLayer(e.detail.id));
    window.addEventListener(`gm:close-${kind}`, (e) => e.detail?.id && closeLayer(e.detail.id));
});

/* ------------------------------------------------------------------ */
/* Tabs  (components/ui/tabs.blade.php)                                */
/* ------------------------------------------------------------------ */

function tabParts(root) {
    const triggers = [...root.querySelectorAll(':scope > .gm-tabs__list > [data-gm-tab]')];
    const panels = [...root.querySelectorAll(':scope > [data-gm-tab-panel]')];
    return { triggers, panels };
}

function selectTab(root, index, focus = false) {
    const { triggers, panels } = tabParts(root);
    triggers.forEach((t, i) => {
        const on = i === index;
        t.setAttribute('aria-selected', on ? 'true' : 'false');
        t.setAttribute('tabindex', on ? '0' : '-1');
        t.classList.toggle('gm-tabs__trigger--active', on);
        if (on && focus) t.focus();
    });
    panels.forEach((p, i) => { p.hidden = i !== index; });
}

function initTabs(root) {
    if (root.dataset.gmReady) return;
    root.dataset.gmReady = '1';
    const { triggers, panels } = tabParts(root);
    panels.forEach((p, i) => {
        p.setAttribute('role', 'tabpanel');
        if (triggers[i]) {
            p.id = triggers[i].getAttribute('aria-controls');
            p.setAttribute('aria-labelledby', triggers[i].id);
        }
    });
    selectTab(root, parseInt(root.dataset.gmActive || '0', 10));
}

document.addEventListener('click', (e) => {
    const trigger = e.target.closest('[data-gm-tab]');
    if (!trigger) return;
    const root = trigger.closest('[data-gm-tabs]');
    if (root) selectTab(root, parseInt(trigger.dataset.gmTab, 10));
});

document.addEventListener('keydown', (e) => {
    const trigger = e.target.closest?.('[data-gm-tab]');
    if (!trigger || !['ArrowLeft', 'ArrowRight', 'Home', 'End'].includes(e.key)) return;
    const root = trigger.closest('[data-gm-tabs]');
    const { triggers } = tabParts(root);
    const i = triggers.indexOf(trigger);
    const next = { ArrowLeft: i - 1, ArrowRight: i + 1, Home: 0, End: triggers.length - 1 }[e.key];
    e.preventDefault();
    selectTab(root, (next + triggers.length) % triggers.length, true);
});

/* ------------------------------------------------------------------ */
/* Accordion  (components/ui/accordion*.blade.php) — native <details>   */
/* ------------------------------------------------------------------ */

// The `toggle` event does not bubble, so listen in the capture phase.
document.addEventListener('toggle', (e) => {
    const item = e.target;
    if (!(item instanceof HTMLDetailsElement) || !item.open) return;
    const root = item.closest('[data-gm-accordion]');
    if (!root || root.dataset.gmAllowMultiple === 'true') return;
    root.querySelectorAll(':scope > details[open]').forEach((other) => {
        if (other !== item) other.open = false;
    });
}, true);

/* ------------------------------------------------------------------ */
/* Quantity stepper  (components/ui/quantity-stepper.blade.php)        */
/* ------------------------------------------------------------------ */

function syncStepper(wrap) {
    const input = wrap.querySelector('input[type=number]');
    if (!input) return;
    const min = parseInt(input.min || '1', 10);
    const max = parseInt(input.max || '9999', 10);
    const value = parseInt(input.value || String(min), 10);
    wrap.querySelector('[data-gm-qty-step="-1"]')?.toggleAttribute('disabled', value <= min);
    wrap.querySelector('[data-gm-qty-step="1"]')?.toggleAttribute('disabled', value >= max);
}

document.addEventListener('click', (e) => {
    const btn = e.target.closest('[data-gm-qty-step]');
    if (!btn) return;
    const wrap = btn.closest('[data-gm-qty]');
    const input = wrap?.querySelector('input[type=number]');
    if (!input) return;
    const min = parseInt(input.min || '1', 10);
    const max = parseInt(input.max || '9999', 10);
    const current = parseInt(input.value || String(min), 10) || min;
    const next = Math.min(max, Math.max(min, current + parseInt(btn.dataset.gmQtyStep, 10)));
    if (next === current) return;
    input.value = String(next);
    syncStepper(wrap);
    input.dispatchEvent(new Event('change', { bubbles: true }));
});

document.addEventListener('change', (e) => {
    const wrap = e.target.closest?.('[data-gm-qty]');
    if (!wrap || !e.target.matches('input[type=number]')) return;
    // Clamp typed values too.
    const input = e.target;
    const min = parseInt(input.min || '1', 10);
    const max = parseInt(input.max || '9999', 10);
    const v = parseInt(input.value, 10);
    if (Number.isNaN(v) || v < min) input.value = String(min);
    else if (v > max) input.value = String(max);
    syncStepper(wrap);
}, true);

/* ------------------------------------------------------------------ */
/* Boot                                                                */
/* ------------------------------------------------------------------ */

function boot(scope = document) {
    scope.querySelectorAll('[data-gm-tabs]').forEach(initTabs);
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => boot());
} else {
    boot();
}

window.gmUI = { openLayer, closeLayer, boot };
