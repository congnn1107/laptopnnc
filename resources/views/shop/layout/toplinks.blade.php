<div class="toplinks">

    @if (auth()->check())
        <a href="{{route('shop.logout')}}"> <i class="fa fa-power-off"></i> Đăng xuất </a>
        <a href="{{route('shop.logout')}}"> <i class="fa fa-book"></i> Lịch sử mua hàng </a>
        <a href="#"> <i class="ion-ios-heart"></i> Danh sách mua sau </a>
        <a href="#"> <i class="fa fa-cogs"></i> Thông tin cá nhân </a>
        
        <a href="#"> <i class="ion-person"></i> Hi 
            {{ auth()->user()->name }}</a>
        

    @else
        <a href="#signin" data-toggle="modal" id="btnRegister" data-target="#Modal-Registration"> <i class="ion-person"></i>
            Đăng ký</a>
        <a href="#signin" data-toggle="modal" id="btnLogin" data-target="#Modal-SignIn"> <i class="ion-unlocked"></i> Đăng nhập</a>
    @endif
    <a href="tel:0352765398" class="hidden-xs"> <i class="ion-android-call"></i> 035 276 5398 </a>
</div>
