@extends('frontend.app')

@section('title', 'Contact — GENTRY')

@section('content')
@php $info = \App\Models\Information::first(); @endphp
<main class="main-wrapper">
    <x-ui.breadcrumb
        :items="[
            ['label' => 'Home', 'url' => route('front.home')],
            ['label' => 'Contact'],
        ]"
    />

    <x-ui.section size="lg">
        <div class="gm-container">
            <div class="gm-page__header">
                <span class="gm-eyebrow">Client services</span>
                <h1 class="gm-page__title">We're here to help.</h1>
                <p class="gm-page__subtitle">Questions about fit, an order or a return? Send us a note and a real person will reply within one business day.</p>
            </div>

            <div class="gm-contact-grid">
                <div class="gm-contact-card">
                    <span class="gm-eyebrow">Client services</span>
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4);">Visit or call</h3>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        <div>
                            <span>Studio</span>
                            <p>{{ $info->address }}</p>
                        </div>
                    </div>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <div>
                            <span>Phone</span>
                            <a href="tel:{{ $info->owner_phone }}">{{ $info->owner_phone }}</a>
                        </div>
                    </div>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <div>
                            <span>Email</span>
                            <a href="mailto:{{ $info->owner_email }}">{{ $info->owner_email }}</a>
                        </div>
                    </div>
                    <div class="gm-contact-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="color: var(--c-accent);"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <div>
                            <span>Hours</span>
                            <p>Saturday – Thursday, 10:00 – 19:00</p>
                        </div>
                    </div>
                </div>

                <div class="gm-contact-form-wrapper">
                    <h3 style="font-size: var(--t-lg); font-weight: 500; font-family: var(--f-display); color: var(--c-ink-900); margin: 0 0 var(--s-4);">Write to us</h3>

                    <form id="ajax_form" method="POST" action="{{ route('front.contact') }}" class="gm-form" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact-name">Name <span class="gm-label__required" aria-hidden="true">*</span></label>
                                    <input type="text" name="name" id="contact-name" required class="gm-input">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact-phone">Phone <span class="gm-label__required" aria-hidden="true">*</span></label>
                                    <input type="tel" name="phone" id="contact-phone" placeholder="01XXXXXXXXX" required class="gm-input">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-email">Email</label>
                                    <input type="email" name="email" id="contact-email" class="gm-input">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-message">Message <span class="gm-label__required" aria-hidden="true">*</span></label>
                                    <textarea name="message" id="contact-message" rows="6" required class="gm-textarea"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <x-ui.button variant="primary" size="lg" full type="submit">Send message</x-ui.button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-ui.section>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('ajax_form');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const formData = new FormData(form);

            submitBtn.disabled = true;
            submitBtn.classList.add('gm-btn--loading');

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (window.toastr) toastr.success(data.msg || 'Message sent successfully');
                    form.reset();
                } else {
                    if (window.toastr) toastr.error(data.msg || 'Failed to send message');
                }
            })
            .catch(err => {
                console.error('Contact form error:', err);
                if (window.toastr) toastr.error('Something went wrong');
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.classList.remove('gm-btn--loading');
            });
        });
    });
</script>
@endpush