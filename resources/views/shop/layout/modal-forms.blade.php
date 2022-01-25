<div class="modal fade" id="Modal-SignIn" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"><i class="ion-android-close"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="modal-title text-center">Đăng nhập</h2>
                            @error('msg', 'login')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <br>

                            <form class="signin" action="{{ route('shop.login') }}" method="post">
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                                    required="" class="form-control" />
                                <br>
                                @csrf
                                <input type="password" name="password" value="" placeholder="Mật khẩu" required=""
                                    class="form-control" />
                                <br>

                                <button type="submit" class="btn btn-primary">OK</button>
                                <a href="#forgin-password" id="btnForget" data-action="Forgot-Password">Quên mật khẩu? ></a>
                            </form>
                            <br>

                            {{-- <div class="social-login">
                                <div class="or">
                                    <p>Hoặc</p>
                                </div>
                                <a href="#"><i class="icon"
                                        data-src="shop/assets/img/icons/facebook.svg"></i></a>
                                <p>&</p>
                                <a href="#"><i class="icon"
                                        data-src="shop/assets/img/icons/google-plus.svg"></i></a>
                            </div> --}}
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modal-Registration" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"><i class="ion-android-close"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="modal-title text-center">Đăng ký tài khoản</h2>
                            <br>

                            <form class="join" action="{{ route('shop.register') }}" method="post">
                                @csrf

                                <div class="form-group @error('name', 'register') has-error @enderror">
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Họ tên"
                                        required="" class="form-control" />
                                    <br>
                                    @error('name', 'register')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group @error('email', 'register') has-error @enderror">
                                    <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"
                                        required="" class="form-control  " />
                                    <br>
                                    @error('email', 'register')


                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('phone', 'register') has-error @enderror">
                                    <input type="text" name="phone" id="" value="{{ old('phone') }}"
                                        class="form-control " required placeholder="Số điện thoại">
                                    <br>
                                    @error('phone', 'register')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('password', 'register') has-error @enderror">
                                    <input type="password" name="password" value=""
                                        onkeypress="return event.charCode != 32" placeholder="Mật khẩu" required=""
                                        class="form-control" />
                                    <br>
                                    @error('password', 'register')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group @error('confirm', 'register') has-error @enderror">
                                    <input type="password" name="confirm" value="" placeholder="Nhập lại mật khẩu"
                                        required="" class="form-control" />
                                    <br>

                                    @error('confirm', 'register')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">OK</button> &nbsp;&nbsp;
                                {{-- <a href="#">Terms ></a> --}}

                                <br><br>
                                <p>
                                    Đăng ký tài khoản để mua sắm tiện lợi hơn!
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modal-ForgotPassword" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"><i class="ion-android-close"></i></span></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="modal-title">Bạn quên mật khẩu?</h4>
                            <br>

                            <form class="join" action="{{ route('forget.password.post') }}" method="post">
                                <div class="form-group">
                                    <input type="email" name="email" value="" placeholder="E-mail" required=""
                                        class="form-control" />
                                    <br>
                                    @error('email', 'forget')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    @if (Session::has('email-sent'))
                                        <div class="alert alert-success">
                                            {{Session::get('email-sent')}}
                                        </div>
                                    @endif
                                </div>
                                @csrf
                                
                                <button type="submit" class="btn btn-primary btn-sm">Tiếp tục</button>
                                <a href="#Sign-In" data-action="Sign-In">Trở lại ></a>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <br><br>
                            <p>
                                Nhập lại email bạn đã dùng để đăng ký tài khoản, nhấn "Tiếp tục" và truy cập link từ
                                email để đặt lại mật khẩu!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modal-Gallery" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"><i class="ion-android-close"></i></span></button>
                <h4 class="modal-title">Title</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
