@extends('layouts.app')
@section('title')
Liên Hệ
@endsection
@section('content')
<div class="contact-container custom-contact">
    @if (session('success'))
    <div class="notification">
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <div style="display: flex;">
        <div class="contact-left">
            <h1>Hãy nói về mọi thứ.</h1>
            <p>Khách hàng là thượng đế, vui lòng khách đến vừa lòng khách đi.</p>
            <div class="illustration">
                <img src="https://cdn.pixabay.com/photo/2016/06/16/02/33/telephone-1460517_1280.png" alt="Illustration">
            </div>
        </div>
        <div class="contact-right">
            <form action="{{ route('contact') }}" class="contact-form" method="POST">
                @csrf
                <input type="text" name="name" placeholder="Your name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="tieude" placeholder="Subject">
                <textarea name="message" placeholder="Write your message" rows="5" required></textarea>
                <button type="submit">Gửi</button>
            </form>
        </div>
    </div>
</div>
@endsection