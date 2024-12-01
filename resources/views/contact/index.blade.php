@extends('layouts.app')
@section('content')
<div class="contact-container custom-contact ">
    <div class="contact-left">
        <h1>Hãy nói về mọi thứ.</h1>
        <p>Khách hàng là thượng đế, vui lòng khách đến vừa lòng khách đi.</p>
        <div class="illustration">
            <img src="https://cdn.pixabay.com/photo/2016/06/16/02/33/telephone-1460517_1280.png" alt="Illustration">
        </div>
    </div>
    <div class="contact-right">
        <form action="#" class="contact-form">
            <input type="text" placeholder="Your name" required>
            <input type="email" placeholder="Email" required>
            <input type="text" placeholder="Subject">
            <textarea placeholder="Write your message" rows="5" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</div>
@endsection