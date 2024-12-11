@extends('layouts.app')
@section('title')
Bài viết
@endsection
@section('content')
<style>
/* Header/Blog Title */
/* .header {
    padding: 30px;
    font-size: 40px;
    text-align: center;
} */

/* Create two unequal columns that floats next to each other */
.leftcolumn {
    float: left;
    width: 100%;
}

/* Right column */

/* Fake image */
.fakeimg {
    width: 100%;
    padding: 20px;
}

/* Add a card effect for articles */
.card {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
}

/* Clear floats after the columns */
/* .row:after {
    content: "";
    display: table;
    clear: both;
} */

/* Footer */
.footer {
    padding: 20px;
    text-align: center;
    background: #ddd;
    margin-top: 20px;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 800px) {

    .leftcolumn,
    .rightcolumn {
        width: 100%;
        padding: 0;
    }
}
</style>
<div class="container" style="margin-top: 70px;">
    <h2>Tin Tức</h2>
    <div class="row">
        <div class="leftcolumn">
            <div class="leftcolumn"> @foreach($blogs as $blog) <div class="card">
                    <h2>{{ $blog->title }}</h2>
                    <h5>{{ $blog->created_at->format('M d, Y') }}</h5>
                    <div class="fakeimg" style="height:200px;">
                        <img src="{{ asset('assets/image/blogs/' . $blog->image) }}" alt="{{ $blog->title }}"
                            style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <p>{{ $blog->description }}</p>
                </div> @endforeach </div>
        </div>
    </div>
</div>
@endsection