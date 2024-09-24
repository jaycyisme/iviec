<ul class="breadcrumb">
    @if(!request()->is('/'))<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Bảng điều khiển</a></li>@endif
    @if(request()->is('ho-so-ca-nhan/*'))<li class="breadcrumb-item">Hồ sơ cá nhân</li>@endif
    @if(request()->is('quan-tri-he-thong/*'))<li class="breadcrumb-item">Quản trị hệ thống</li>@endif
    @if(request()->is('quan-tri-he-thong/quyen*'))<li class="breadcrumb-item">Quyền</li>@endif
</ul>