@extends('admin.layout.master')
@section('content')
<style>
    .picture-drag-drop {

        padding: 5px;
        border-radius: 5px;
        box-shadow: 0 0 5px 2px rgba(0, 0, 0, 0.1);
    }

    .picture-drag-drop .preview {
        position: relative;
        width: 80%;
        margin: 0 auto;
        height: 350px;
    }

    .picture-drag-drop .preview .btn-cancel-image {
        position: absolute;
        right: 15px;
        top: 5px;
        cursor: pointer;
        opacity: 0.3;
        display: none;
    }

    .picture-drag-drop .preview .btn-cancel-image:hover {
        opacity: 1;
    }

    .picture-drag-drop .preview img {
        display: block;
        margin: 0 auto;
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
    }

    .picture-drag-drop input {
        display: block;
        width: 100%;
        height: 150px;
        border: none;
        outline: none;
        visibility: hidden;
        cursor: pointer;
        line-height: 150px;
    }

    .picture-drag-drop input::before {
        content: attr(dataTitle);
        visibility: visible;
        display: block;
        width: 100%;
        height: 100%;
        border: 3px dashed lightgray;
        text-align: center;
        border-radius: 5px;
        transition: all ease .25s;
        opacity: 0.6;

    }

    .picture-drag-drop .form-group:hover input::before {
        border: 4px dashed purple;
    }
</style>

{{-- CSS lại cho select 2 --}}
<style>
    .select2-selection__choice{
        background-color: rgb(102, 178, 245) !important;
        border: none !important;
    }
    .select2-selection__choice__remove{
        color: white !important;
    }
    .select2-selection__choice__remove:hover{
        color: red !important;
    }
</style>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="text-info">Tạo sản phẩm mới</h3>
    </div>
    <div class="box-body">
        <form action="{{route('product.store')}}" method="post">
            @csrf
            <h4 class="text-muted">Thông tin sản phẩm</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="">Tên sản phẩm</label>
                            <input type="text" placeholder="Nhập đầy đủ tên sản phẩm..." name="name" id="txtName" class="form-control" value="{{old('name')}}">
                            @error('name')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">SKU</label>
                            <input type="text" placeholder="Mã SKU sản phẩm" name="sku" id="txtSku" class="form-control" value="{{old('sku')}}">
                            @error('sku')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-8">
                            <label for="">Danh mục</label>
                            <select name="categories[]" id="slCategories" class="form-control" multiple="multiple">
                            <?php
                            showCategoriesMenu(0,$categories,old('categories')??[]);
                            ?>
                            </select>
                            @error('categories')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <h4 class="text-muted">Bộ nhớ & ổ cứng</h4>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="">Số lượng khe ram</label>
                            <input type="text" placeholder="Ví dụ: 1 Khe onboard | 2 Khe | 1 onboard, 1 Khe mở rộng..." name="memory_slots" min="0" max="4" id="txtMemSlot" class="form-control" value="{{old('memory_slot')}}">
                            @error('memory_slots')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Loại bộ nhớ ram</label>
                            <input type="text" placeholder="Ví dụ: DDR4 3600 Mhz..." name="memory_type" id="txtMemType" class="form-control" value="{{old('memory_type')}}">
                            @error('memory_type')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="">Dung lượng bộ nhớ ram: </label>
                            <input type="text" placeholder="Ví dụ: 4GB | 8GB (4GB onboard, 4GB sodimm..." name="memory_capacity" id="txtMemCap" class="form-control" value="{{old('memory_capacity')}}">
                            @error('memory_capacity')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Ổ cứng SSD: </label>
                            <input type="text" placeholder="Có hoặc bỏ trống.." name="ssd_storage" id="txtSSD" class="form-control">
                            @error('ssd_storage')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Dung lượng ổ SSD: </label>
                            <select name="ssd_capacity" class="form-control" id="slSSDCap">
                                <option value="0">0</option>
                                @foreach($capacity as $cap)
                                <option value="{{$cap}}" {{old('ssd_capacity')==$cap?"selected":""}}>{{$cap}}</option>
                                @endforeach
                            </select>
                            @error('ssd_capacity')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Ổ cứng HDD: </label>
                            <input type="text" placeholder="Có hoặc bỏ trống.." name="hdd_storage" id="txtHDD" class="form-control">
                            @error('hdd_storage')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Dung lượng ổ HDD: </label>
                            <select name="hdd_capacity" class="form-control" id="slHDDCap">
                                <option value="0">0</option>
                                @foreach($capacity as $cap)
                                <option value="{{$cap}}" {{old('hdd_capacity')==$cap?"selected":""}}>{{$cap}}</option>
                                @endforeach
                            </select>
                            @error('hdd_capacity')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="">Ảnh đại diện sản phẩm</label>
                    <!-- Drag và Drop upload 1 ảnh -->
                    <div class="picture-drag-drop">
                        <div class="preview">
                            <img src="{{asset('images\default-product.png')}}" id="card-preview" alt="Xem trước ảnh bìa sản phẩm">
                            <div class="btn-cancel-image" title="Hủy ảnh">
                                <i class="fa fa-times"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="file" accept="image/*" dataTitle="Chọn hoặc kéo thả ảnh..." name="card_image" id="singleImageInput" defaultUrl="{{asset('images\default-product.png')}}" class="form-control">
                        </div>
                    </div>
                </div>

            </div>



            <h4 class="text-muted">CPU & GPU</h4>
            <div class="row">
                <!-- Hoàn thiện lấy cpu và gpu từ database sau -->
                <div class="form-group col-md-6">
                    <label for="">CPU: </label>
                    <select name="cpu" class="form-control" id="slCPU">
                        @foreach($cpuList as $cpu)
                        <option value="{{$cpu->id}}" {{old('cpu')==$cpu->id?'selected':''}}>{{"$cpu->branch $cpu->series - $cpu->name"}}</option>
                        @endforeach
                    </select>
                    @error('cpu')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <!-- Laptop có thể có 1 hoặc 2 gpu -> cần xử lý sau -->
                <div class="form-group col-md-6">
                    <label for="">GPU Rời (nếu có)</label>
                    <select name="gpu" id="slGPU" class="form-control">
                        @foreach($gpuList as $gpu)
                        <option value="{{$gpu->id}}" {{old('gpu')==$gpu->id?'selected':''}}>{{$gpu->branch}} {{$gpu->name}} - {{$gpu->graph_memory_cap}}</option>
                        @endforeach
                    </select>
                    @error('gpu')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <h4 class="text-muted">Màn hình</h4>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Loại màn hình</label>
                    <select name="screen_type" id="slSCreenType" class="form-control">
                        @foreach($screenTypes as $val)
                        <option value="{{$val}}" {{old('screen_type')==$val?"selected":""}}>{{$val}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Kích thước màn hình</label>
                    <select name="screen_size" id="slScreenSize" class="form-control">
                        @foreach($screenSizes as $val)
                        <option value="{{$val}}" {{old('screen_size')==$val?"selected":""}}>{{$val}} Inches</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="">Thông tin thêm về màn hình:</label>
                <input type="text" placeholder="Ví dụ: Antiglare, 144hz, 100% sRGB..." id="txtScreenDetail" class="form-control" name="screen_detail" value="{{old('screen_detail')}}">
                @error('screen_detail')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <h4 class="text-muted">
                Vỏ
            </h4>
            <div class="form-group">
                <label for="">Chất liệu vỏ</label>
                <input type="text" placeholder="Ví dụ: Nhựa | Kim loại nguyên khối | ..." id="txtCaseMaterial" class="form-control" name="case_material" value="{{old('case_material')}}">
                @error('case_material')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <h4 class="text-muted">Kết nối</h4>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="">Bluetooth</label>
                    <input type="text" placeholder="Ví dụ: Có, Bluetooth 5.1 ..." name="bluetooth" id="txtBluetooth" class="form-control" value="{{old('bluetooth')}}">
                    @error('bluetooth')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="">Wifi</label>
                    <input type="text" name="wifi" id="txtWifi" placeholder="Ví dụ: Wifi 6 ..." class="form-control" value="{{old('wifi')}}">
                    @error('wifi')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="">Cổng kết nối</label>
                    <input type="text" placeholder="Ví dụ: 2xUSB 3.2, 1xCombo audio/microphone jacket" name="connection_jacks" id="txtConnect" class="form-control" value="{{old('connection_jacks')}}">
                    @error('connection_jacks')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <h4 class="text-muted">Khác</h4>
            <div class="row">

                <div class="form-group col-md-3">
                    <label for="">Bàn phím</label>
                    <input type="text" placeholder="Ví dụ: Bàn phím full size..." name="keyboard" id="txtKeyboard" class="form-control" value="{{old('keyboard')}}">
                    @error('keyboard')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="">Dung lượng pin: </label>
                    <input type="text" placeholder="Ví dụ: 3 cells - 56Wh..." name="battery" id="txtBattery" class="form-control" value="{{old('battery')}}">
                    @error('battery')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="">Màu sắc: </label>
                    <input type="text" name="color" placeholder="Ví dụ: Bạc | Đen | Xanh | Xám..." id="txtColor" class="form-control" value="{{old('color')}}">
                    @error('color')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="">Hệ điều hành theo máy: </label>
                    <input type="text" placeholder="Ví dụ: Windows 10 Home SL | FreeOS..." name="operating_system" id="txtOperatingSystem" class="form-control" value="{{old('operating_system')}}">
                    @error('operating_system')
                    <p class="text-danger">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="">Tính năng khác: </label>
                <textarea placeholder="Ví dụ: Bảo mật vân tay, Đèn nền bàn phím, bảo mật khuôn mặt..." type="text" name="addition" id="txtAddition" class="form-control" value="{{old('addition')}}"></textarea>
                @error('addition')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Mô tả sản phẩm: </label>
                <textarea type="text" placeholder="Phần viết giới thiệu, mô tả cho sản phẩm..." name="describe" id="txtDescribe" class="form-control" value="{{old('describe')}}"></textarea>
                @error('describe')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <h4 class="text-muted">Thông tin kho:</h4>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Giá nhập: </label>
                        <input type="text" name="import_price" id="" class="form-control" value="{{ old('import_price') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Giá bán: </label>
                        <input type="text" name="sell_price" id="" class="form-control" value="{{ old('sell_price') }}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="">Số lượng: </label>
                        <input type="text" name="quantity" id="" class="form-control" value="{{ old('quantity') }}">
                    </div>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="form-button btn bg-purple">Lưu</button>
            </div>
        </form>

    </div>

</div>

<script>
    $(document).ready(() => {
        $('select').select2();
        ckeditor = CKEDITOR.replace('txtDescribe', {
            filebrowserBrowseUrl: "{{asset('plugins/ckfinder/ckfinder.html')}}",
            filebrowserImageBrowseUrl: "{{ asset('plugins/ckfinder/ckfinder.html?type=Images') }}",
            filebrowserFlashBrowseUrl: "{{ asset('plugins/ckfinder/ckfinder.html?type=Flash') }}",
            filebrowserUploadUrl: "{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
            filebrowserImageUploadUrl: "{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}",
            filebrowserFlashUploadUrl: "{{ asset('plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}",
            // filebrowserUploadMethod:"form",
            // filebrowserUploadUrl: '/upload-image.php',
            extraPlugins: "textindent",
            removePlugins: "about,flash",
            height: 400
        })
        CKFinder.setupCKEditor(ckeditor)

        $("#singleImageInput").on("change", (event) => {
            console.log(event.target);
            input = event.target;
            reader = new FileReader();
            reader.onload = () => {
                $('#card-preview').attr('src', reader.result)
                $(".btn-cancel-image").show();
            }
            reader.readAsDataURL(input.files[0])
        })
        // nút hủy ảnh
        $(".btn-cancel-image").on("click", (event) => {
            input = $("#singleImageInput")
            input.val(null)
            $('#card-preview').attr('src', input.attr('defaultUrl'))
            $(".btn-cancel-image").hide();
        })
    })
</script>



@endsection