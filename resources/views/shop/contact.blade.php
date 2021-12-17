@extends('shop.layout.master')
@section('title')
    Liên hệ
@endsection
@section('content')
<hr class="offset-top">

<div class="white">
  <hr class="offset-sm">

  <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div id="Address">
            <address>
              <label class="h3">LAPTOPNNC</label><br>
              Số 8, Ngõ 173, Đường Trâu Quỳ<br>
              TT. Trâu Quỳ, Gia Lâm, Hà Nội<br>
              <abbr title="Phone">P:</abbr> (035) 276-5398
            </address>

            <address>
              <strong>Hỗ trợ:</strong><br>
              <a href="mailto:#">sup@example.com</a>
              <br><br>

              <strong>Cộng tác:</strong><br>
              <a href="mailto:#">col@example.com</a>
            </address>
          </div>
        </div>
        <div class="col-sm-8">
          <div id="GoMap">
            <iframe style="display: block; width:100%; height: 100%" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d232.45249874823807!2d105.31633594895771!3d21.222330333007797!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1637773065719!5m2!1svi!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
  </div>

  <hr class="offset-lg">
</div>

<div class="gray">
  <hr class="offset-lg">

  <div class="container align-center">
    <h1 class="upp"> Bạn cần tư vấn? </h1>
    <p> Để lại câu hỏi ở bên dưới cho chúng tôi! </p>
    <hr class="offset-md">

    <div class="row">
      <div class="col-sm-4 col-sm-offset-4">
        <form class="contact" action="index.php" method="post">
          <textarea class="form-control" name="message" placeholder="Nội dung thắc mắc..." required="" rows="5"></textarea>
          <br>

          <input type="email" name="email" value="" placeholder="Email" required="" class="form-control" />
          <br>

          <button type="submit" class="btn btn-primary justify"> Gửi </button>
        </form>
      </div>
    </div>
  </div>
  <br>
</div>


<hr class="offset-lg">
<hr class="offset-sm">

@endsection

@section('scripts')
    @parent
@endsection