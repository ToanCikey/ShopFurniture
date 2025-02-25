@extends('layouts.app')
@section('title')
Bài viết
@endsection
@section('content')
<style>
/* Header/Blog Title */


/* Container for the main content */
.content {
    display: flex;
    margin-top: 20px;
}

/* Left column for main articles */
.leftcolumn {
    flex: 70%;
    /* 70% width */
    padding-right: 20px;
}

/* Right column for supplementary titles */
.rightcolumn {
    flex: 30%;
    /* 30% width */
}

/* Card style for articles */
.card {
    background-color: white;
    padding: 20px;
    margin-top: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.card:hover {
    transform: scale(1.02);
}



/* Styles for supplementary titles in right column */
.supplementary {
    background-color: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    margin-top: 20px;
}

/* Responsive layout */
@media screen and (max-width: 800px) {
    .content {
        flex-direction: column;
        /* Stack columns on small screens */
    }

    .leftcolumn,
    .rightcolumn {
        flex: 100%;
        /* Full width on small screens */
        padding: 0;
    }
}

.custom-a {
    text-decoration: none;
    color: black;
}

.tag-list {
    width: 30rem;
    height: 450px;
    max-width: 90vw;
    display: flex;
    flex-shrink: 0;
    flex-direction: column;
    gap: 1rem 0;
    position: relative;
    padding: 1.5rem 0;
    overflow: hidden;
}

.loop-slider {
    .inner {
        display: flex;
        width: fit-content;
        animation-name: loop;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        animation-direction: var(--direction);
        animation-duration: var(--duration);
    }
}

.tag {
    display: flex;
    align-items: center;
    gap: 0 0.2rem;
    color: #e2e8f0;
    font-size: 0.9rem;
    border-radius: 0.4rem;
    padding: 0.7rem 1rem;
    margin-right: 1rem;
    box-shadow:
        0 0.1rem 0.2rem rgb(0 0 0 / 20%),
        0 0.1rem 0.5rem rgb(0 0 0 / 30%),
        0 0.2rem 1.5rem rgb(0 0 0 / 40%);

    span {
        font-size: 1.2rem;
        color: #64748b;
    }
}

.tag img {
    object-fit: cover;
}

.fade {
    pointer-events: none;
    background: linear-gradient(90deg, #1e293b, transparent 30%, transparent 70%, #1e293b);
    position: absolute;
    inset: 0;
}

@keyframes loop {
    0% {
        transform: translateX(0);
    }

    100% {
        transform: translateX(-50%);
    }
}
</style>

<div class="container" style="margin-top: 70px;">

    <h2>Tin Tức</h2>

    <div class="content">
        <div class="leftcolumn">
            @foreach($blogs as $blog)
            <div class="card">
                <h2>{{ $blog->title }}</h2>
                <h5>{{ \Carbon\Carbon::parse($blog->data)->format('M d, Y') }}</h5>

                <div class="fakeimg" style="height:200px;">
                    <img src="{{ asset('assets/image/blogs/' . $blog->image) }}" alt="{{ $blog->title }}"
                        style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                </div>
                <p>{{ $blog->description }}</p>
            </div>
            @endforeach
        </div>
        <div class="rightcolumn">
            <div class="supplementary">
                <h3>Chủ Đề Nội Thất</h3>
                <ul>
                    <li><a href="#" class="custom-a">Xu Hướng Nội Thất 2024</a></li>
                    <li><a href="#" class="custom-a">Mẹo Bày Trí Không Gian Nhỏ</a></li>
                    <li><a href="#" class="custom-a">Cách Chọn Đồ Nội Thất Phù Hợp</a></li>
                    <li><a href="#" class="custom-a">Phong Cách Thiết Kế Hiện Đại</a></li>
                    <li><a href="#" class="custom-a">Ý Tưởng Trang Trí Phòng Khách</a></li>
                    <li><a href="#" class="custom-a">Cải Tạo Nhà Cửa Tiết Kiệm Chi Phí</a></li>
                    <li><a href="#" class="custom-a">Những Màu Sắc Phổ Biến Năm Nay</a></li>
                </ul>
            </div>
            <div class="supplementary">
                <h3>Sản Phẩm Nổi Bật</h3>
                <ul>
                    <li><a href="#" class="custom-a">Ghế Sofa Cao Cấp</a></li>
                    <li><a href="#" class="custom-a">Bàn Trang Điểm Đẹp</a></li>
                    <li><a href="#" class="custom-a">Kệ Sách Thông Minh</a></li>
                    <li><a href="#" class="custom-a">Giường Ngủ Hiện Đại</a></li>
                    <li><a href="#" class="custom-a">Đèn Trang Trí Sang Trọng</a></li>
                </ul>
            </div>
            <div class="supplementary">
                <h3>Bài Viết Phổ Biến</h3>
                <ul>
                    <li><a href="#" class="custom-a">Thiết Kế Nội Thất Nhà Bếp</a></li>
                    <li><a href="#" class="custom-a">Cách Chọn Rèm Cửa Phù Hợp</a></li>
                    <li><a href="#" class="custom-a">Mẹo Trang Trí Phòng Tắm</a></li>
                    <li><a href="#" class="custom-a">Thiết Kế Phòng Làm Việc Tại Nhà</a></li>
                </ul>
            </div>
            <div class="supplementary">
                <div class="tag-list">
                    <div class="loop-slider" style="--duration:15951ms; --direction:normal;">
                        <div class="inner">
                            <div class="tag"><img src="assets/image/c1.png" alt="" srcset=""></div>
                            <div class="tag"><img src="assets/image/card4.png" alt="" srcset=""></div>
                            <div class="tag"><img src="assets/image/card8.png" alt="" srcset=""></div>
                            <div class="tag"><img src="assets/image/c3.png" alt="" srcset=""></div>
                            <div class="tag"><img src="assets/image/card7.png" alt="" srcset=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection