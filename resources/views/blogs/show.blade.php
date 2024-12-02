@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="blog-title">Tin Tức</h1>
    <div class="blog-post">
        <img src="../{{$blog->image}}" alt="Blog Image" class="blog-image">
        <p class="blog-description">{{ $blog->description }}</p>
        <p class="blog-content">Trang trí cầu thang là một phần quan trọng trong nội thất của một ngôi nhà của bạn. Xu
            hướng sử dụng gỗ trang trí cầu thang là một ý tưởng vô cùng độc đáo biến căn nhà bạn trở nên rực rỡ và nổi
            bật.

            Mẫu thiết kế cầu thang đẹp Lan can cầu thang với một bức vách dựng thẳng đứng bằng các lam gỗ ngang, cho cảm
            giác nửa kín nửa hở cho mẫu cầu thang này. Ánh sáng được đặt dưới hệ lam để tạo hiệu ứng ánh sáng tô điểm
            thêm cho cầu thang. Ánh sáng cũng là một phần quan trọng trong việc thiết kế nên một cầu thang đẹp.</p>
    </div>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .blog-title {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 20px;
        font-size: 2.5em;
    }

    .blog-post {
        margin-bottom: 30px;
    }

    .blog-image {
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .blog-description {
        font-weight: bold;
        color: #34495e;
        margin: 15px 0;
    }

    .blog-content {
        line-height: 1.6;
        color: #555;
        font-size: 1.1em;
    }
</style>
@endsection