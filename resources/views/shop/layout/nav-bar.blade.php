<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('shop.index')}}"> NNCSHOP </a>
            <a class="navbar-brand pull-right hidden-sm hidden-md hidden-lg" href="#open-cart"> <i
                    class="ion-bag"></i> 7 </a>
        </div>

        <style>
            .nav li a {
                font-weight: 500 !important;
                font-size: 16px !important;
                color: #fff;
                text-decoration: none;
                display: block;
                width: 100%;
                padding: 15px 0 15px 35px;
               
            }


            .nav .dropdown-menu {
                background-color: rgba(0, 0, 0, 0.8);
            }

            .nav .dropdown-menu ul {
                padding: 0;
                list-style-type: none;
            }

            @media screen and (min-width:800px) {

                .nav .dropdown-menu>ul>li:hover>a {
                    color: rgb(0, 0, 0) !important;
                }

                .nav .dropdown-menu>ul>li:hover {
                    background-color: #fff;
                }

                .nav .dropdown:hover>.dropdown-menu {
                    display: block;
                }

                .nav .dropdown-submenu {
                    position: relative;
                }

                .nav .dropdown-submenu:hover>.dropdown-menu {
                    display: block;
                    left: 100%;
                    top: 0;
                }
            }

            @media screen and (max-width:799px) {
                .nav .dropdown a,
                .nav .dropdown-submenu a {
                    display: block;
                    padding: 15px 35px;
                }
                .nav .dropdown>.dropdown-menu {
                    position: initial !important;
                    outline: none;
                    border: none;
                    margin: 0;
                    width: inherit;
                    padding: 0;
                }
                .nav .dropdown-menu{
                    width: 100% !important;
                    border: none;
                }
                .nav .dropdown-submenu .dropdown-menu {
                    position: unset;
                }

                .nav ul li {
                    overflow: hidden;
                }
                .nav .dropdown:hover, .dropdown-submenu:hover{
                    background: none;
                }
                .nav .dropdown:hover>.dropdown-menu {

                    display: block;
                    overflow: hidden;
                }

                .nav .dropdown-submenu:hover>.dropdown-menu {
                    display: block;
                }
                .nav .dropdown-menu li {
                    width: inherit;
                }
                .nav .dropdown-menu>ul>li:hover>a {
                    color: rgb(0, 0, 0) !important;
                }
                .nav .dropdown-menu li:hover {
                    background-color: #fff !important;
                }
                .nav .dropdown-menu li:hover ul {
                    background-color: rgb(31, 30, 30) !important;
                }
            }

            /*cart*/
            .cart .media-heading{
                width: 200px;
                word-break: break-all;
            }
        </style>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{route('shop.index')}}">Trang chủ</a></li>
                <li class="dropdown">
                    <a href="{{route('shop.product.index')}}">Sản Phẩm</a>
                    <div class="dropdown-menu">
                        <ul>
                            <?php
                            showCategoriesMenu(1, $categories);
                            ?>
                        </ul>
                    </div>
                </li>
                <li><a href="./blog/">Bài viết</a></li>
                <li><a href="./contacts/">Liên hệ</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->


        <div class="search hidden-xs" data-style="hidden">
            <div class="input">
                <button type="button"><i class="ion-ios-search"></i></button>

                <input type="text" name="search" value="" placeholder="Type here..." />
            </div>
        </div>
    </div>
    <!--/.container-fluid -->
</nav>
