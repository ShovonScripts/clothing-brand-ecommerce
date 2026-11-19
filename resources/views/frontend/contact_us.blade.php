@extends('frontend.app')

@section('title', 'Contact — GENTRY')

@section('content')
@php $info = \App\Models\Information::first(); @endphp
<main class="main-wrapper">
    <div class="axil-breadcrumb-area">
        <div class="container-fluid">
            <ul class="axil-breadcrumb">
                <li class="axil-breadcrumb-item"><a href="{{ route('front.home') }}">Home</a></li>
                <li class="separator"></li>
                <li class="axil-breadcrumb-item active" aria-current="page">Contact</li>
            </ul>
        </div>
    </div>

    <section class="container-fluid">
        <div class="gm-contact-grid">
            <div class="gm-contact-card">
                <span class="gm-eyebrow">Client services</span>
                <h3>We're here to help.</h3>
                <div class="gm-contact-item">
                    <i class="fas fa-location-dot"></i>
                    <div>
                        <span>Studio</span>
                        <p>{{ $info->address }}</p>
                    </div>
                </div>
                <div class="gm-contact-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <span>Phone</span>
                        <a href="tel:{{ $info->owner_phone }}">{{ $info->owner_phone }}</a>
                    </div>
                </div>
                <div class="gm-contact-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <span>Email</span>
                        <a href="mailto:{{ $info->owner_email }}">{{ $info->owner_email }}</a>
                    </div>
                </div>
                <div class="gm-contact-item">
                    <i class="fas fa-clock"></i>
                    <div>
                        <span>Hours</span>
                        <p>Saturday – Thursday, 10:00 – 19:00</p>
                    </div>
                </div>
            </div>

            <div>
                <span class="gm-eyebrow">Write to us</span>
                <h1 class="gm-title" style="margin-bottom:12px">Send a message</h1>
                <p class="gm-subtitle" style="margin-bottom:28px">Questions about fit, an order or a return? Send us a note and a real person will reply within one business day.</p>

                <form id="ajax_form" method="POST" action="{{ route('front.contact') }}" class="gm-form">
                    @csrf
                    <div class="row row--10">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact-name">Name *</label>
                                <input type="text" name="name" id="contact-name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact-phone">Phone *</label>
                                <input type="text" name="phone" id="contact-phone" placeholder="01XXXXXXXXX" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-email">Email</label>
                                <input type="email" name="email" id="contact-email">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-message">Message *</label>
                                <textarea name="message" id="contact-message" rows="6" required></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button name="submit" type="submit" class="gm-btn">Send message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@endsection
