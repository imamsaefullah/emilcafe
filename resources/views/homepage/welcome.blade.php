<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gusto</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons
        ================================================== -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico ') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href=" {{ asset('img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href=" {{ asset('img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href=" {{ asset('img/apple-touch-icon-114x114.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href=" {{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('fonts/font-awesome/css/font-awesome.css') }}">

    <!-- Stylesheet
        ================================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rochester" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<!-- Navigation
    ==========================================-->
<nav id="menu" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle navigation</span> <span
                    class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#features" class="page-scroll">Specials</a></li>
                <li><a href="#about" class="page-scroll">About</a></li>
                <li><a href="#restaurant-menu" class="page-scroll">Menu</a></li>
                <li><a href="#team" class="page-scroll">Chef</a></li>
                <li><a href="#contact" class="page-scroll">Contact</a></li>
                <li><a href="{{ route('login') }}" class="page-scroll">Login</a></li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>
{{--<!-- Header -->--}}
<header id="header">
    <div class="intro">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="intro-text">
                        <h1>Emil Cafe & Resto</h1>
                        <p>
                            <button onclick="order()" class="btn btn-primary">Order</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Features Section -->
<div id="features" class="text-center">
    <div class="container">
        <div class="section-title">
            <h2>Menu Spesial Kami</h2>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <div class="features-item">
                    <h3>Nasi Goreng Spesial</h3>
                    <img src="{{ asset('img/specials/1.jpg') }}" class="img-responsive" alt="Nasi Goreng Spesial">
                    <p>Nasi goreng khas Indonesia dengan topping telur mata sapi, ayam suwir, dan kerupuk. Cocok
                        dinikmati kapan saja.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="features-item">
                    <h3>Sate Ayam Madura</h3>
                    <img src="{{ asset('img/specials/2.jpg') }}" class="img-responsive" alt="Sate Ayam Madura">
                    <p>Sate ayam bumbu kacang khas Madura, disajikan dengan lontong dan sambal kecap pedas.</p>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="features-item">
                    <h3>Sop Buntut</h3>
                    <img src="{{ asset('img/specials/3.jpg') }}" class="img-responsive" alt="Sop Buntut">
                    <p>Sop buntut sapi dengan kuah bening kaya rempah, dilengkapi dengan wortel, kentang, dan daun
                        seledri segar.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- About Section -->
<div id="about">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-6 about-img"></div>
            <div class="col-xs-12 col-md-3 col-md-offset-1">
                <div class="about-text">
                    <div class="section-title">
                        <h2>Cerita Kami</h2>
                    </div>
                    <p>Usaha ini berawal dari dapur kecil di rumah keluarga kami, dengan cita rasa masakan rumahan yang
                        autentik dan penuh kehangatan. Kami percaya bahwa makanan bukan hanya soal rasa, tapi juga
                        tentang kenangan dan kebersamaan.</p>
                    <p>Dengan semangat dan cinta pada kuliner nusantara, kami menghadirkan menu-menu pilihan yang dibuat
                        dari bahan-bahan segar dan resep warisan keluarga. Kami terus berkembang, namun satu hal yang
                        tak pernah berubah: komitmen kami untuk menyajikan rasa terbaik untuk Anda.</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{--<!-- Restaurant Menu Section -->--}}
<div id="restaurant-menu">
    <div class="container">
        <div class="section-title text-center">
            <h2>Menu</h2>
        </div>
        <div class="row">
            <!-- Sarapan & Pembuka -->
            <div class="col-xs-12 col-sm-6">
                <div class="menu-section">
                    <h2 class="menu-section-title">Sarapan & Pembuka</h2>
                    <div class="menu-item">
                        <div class="menu-item-name">Lontong Sayur</div>
                        <div class="menu-item-price">Rp15.000</div>
                        <div class="menu-item-description">Lontong disajikan dengan kuah santan, labu siam, tahu, dan
                            telur rebus.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Bubur Ayam</div>
                        <div class="menu-item-price">Rp12.000</div>
                        <div class="menu-item-description">Bubur nasi hangat dengan suwiran ayam, kacang kedelai goreng,
                            dan kerupuk.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Tahu Isi</div>
                        <div class="menu-item-price">Rp6.000</div>
                        <div class="menu-item-description">Tahu goreng berisi sayuran dan bihun, cocok sebagai camilan
                            pembuka.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Pisang Goreng</div>
                        <div class="menu-item-price">Rp8.000</div>
                        <div class="menu-item-description">Pisang matang dibalut tepung renyah, pas untuk teman teh
                            pagi.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hidangan Utama -->
            <div class="col-xs-12 col-sm-6">
                <div class="menu-section">
                    <h2 class="menu-section-title">Hidangan Utama</h2>
                    <div class="menu-item">
                        <div class="menu-item-name">Nasi Goreng Spesial</div>
                        <div class="menu-item-price">Rp22.000</div>
                        <div class="menu-item-description">Nasi goreng dengan telur, ayam suwir, sosis, dan kerupuk.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Ayam Geprek</div>
                        <div class="menu-item-price">Rp20.000</div>
                        <div class="menu-item-description">Ayam goreng tepung dengan sambal geprek pedas dan lalapan
                            segar.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Mie Ayam Bakso</div>
                        <div class="menu-item-price">Rp18.000</div>
                        <div class="menu-item-description">Mie kenyal dengan potongan ayam manis dan bakso sapi.</div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Soto Ayam Lamongan</div>
                        <div class="menu-item-price">Rp19.000</div>
                        <div class="menu-item-description">Soto bening khas Lamongan dengan koya, suwiran ayam, dan
                            telur rebus.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Makan Malam -->
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="menu-section">
                    <h2 class="menu-section-title">Makan Malam</h2>
                    <div class="menu-item">
                        <div class="menu-item-name">Ikan Bakar Kecap</div>
                        <div class="menu-item-price">Rp28.000</div>
                        <div class="menu-item-description">Ikan gurame bakar dengan bumbu kecap manis dan sambal
                            terasi.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Nasi Liwet Komplit</div>
                        <div class="menu-item-price">Rp25.000</div>
                        <div class="menu-item-description">Nasi gurih dengan ayam goreng, tahu, tempe, sambal dan
                            lalapan.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Sate Ayam</div>
                        <div class="menu-item-price">Rp23.000</div>
                        <div class="menu-item-description">Sate ayam bumbu kacang disajikan dengan lontong dan bawang
                            goreng.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Rawon Daging</div>
                        <div class="menu-item-price">Rp30.000</div>
                        <div class="menu-item-description">Sup daging khas Jawa Timur dengan kuah hitam dari kluwek,
                            lengkap dengan nasi dan sambal.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Makanan Penutup -->
            <div class="col-xs-12 col-sm-6">
                <div class="menu-section">
                    <h2 class="menu-section-title">Makanan Penutup</h2>
                    <div class="menu-item">
                        <div class="menu-item-name">Es Cendol</div>
                        <div class="menu-item-price">Rp10.000</div>
                        <div class="menu-item-description">Minuman dingin khas Indonesia dengan cendol, santan, dan gula
                            merah cair.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Kolak Pisang</div>
                        <div class="menu-item-price">Rp9.000</div>
                        <div class="menu-item-description">Pisang rebus dalam kuah santan manis dengan tambahan ubi dan
                            kolang-kaling.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Es Campur</div>
                        <div class="menu-item-price">Rp12.000</div>
                        <div class="menu-item-description">Campuran buah segar, agar-agar, cincau, dan sirup manis
                            disajikan dengan es serut.
                        </div>
                    </div>
                    <div class="menu-item">
                        <div class="menu-item-name">Puding Cokelat</div>
                        <div class="menu-item-price">Rp11.000</div>
                        <div class="menu-item-description">Puding lembut rasa cokelat disajikan dengan saus vla vanila
                            dingin.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--<!-- Gallery Section -->--}}
<div id="gallery">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="gallery-item"><img src="{{ asset('img/gallery/01.jpg') }}" class="img-responsive" alt="">
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="gallery-item"><img src="{{ asset('img/gallery/02.jpg')}}" class="img-responsive" alt="">
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="gallery-item"><img src="{{ asset('img/gallery/03.jpg')}}" class="img-responsive" alt="">
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="gallery-item"><img src="{{ asset('img/gallery/04.jpg')}}" class="img-responsive" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- secsion chef --}}
<div id="team">
    <div class="container">
        <div id="row">
            <div class="col-md-6">
                <div class="col-md-10 col-md-offset-1">
                    <div class="section-title">
                        <h2>Kenali Koki Kami</h2>
                    </div>
                    <p>Koki utama kami, Chef Andika, telah mengabdikan lebih dari 15 tahun dalam dunia kuliner.
                        Keahliannya dalam memadukan cita rasa tradisional Indonesia dengan sentuhan modern menjadikan
                        setiap hidangan istimewa.</p>
                    <p>Dengan dedikasi dan cinta terhadap masakan nusantara, Chef Andika memastikan setiap bahan yang
                        digunakan adalah pilihan terbaik, demi menghadirkan pengalaman kuliner yang tak terlupakan untuk
                        Anda.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="team-img"><img src="{{ asset('img/chef.jpg') }}" alt="Koki Kami" class="img-responsive">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section -->
<div id="contact" class="text-center">
    <div class="container text-center">
        <div class="col-md-4">
            <h3>Reservasi</h3>
            <div class="contact-item">
                <p>Silakan hubungi</p>
                <p>(887) 654-3210</p>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Alamat</h3>
            <div class="contact-item">
                <p>Jalan Mawar No. 123</p>
                <p>Jakarta Selatan, 12345</p>
            </div>
        </div>
        <div class="col-md-4">
            <h3>Jam Operasional</h3>
            <div class="contact-item">
                <p>Senin–Kamis: 10.00 – 23.00 WIB</p>
                <p>Jumat–Minggu: 11.00 – 02.00 WIB</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="section-title text-center">
            <h3>Kirim Pesan kepada Kami</h3>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <form name="sentMessage" id="contactForm" novalidate>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" id="name" class="form-control" placeholder="Nama Lengkap"
                                   required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="email" id="email" class="form-control" placeholder="Alamat Email"
                                   required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="message" id="message" class="form-control" rows="4"
                              placeholder="Tulis pesan Anda di sini..." required></textarea>
                    <p class="help-block text-danger"></p>
                </div>
                <div id="success"></div>
                <button type="submit" class="btn btn-custom btn-lg">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>

<div id="footer">
    <div class="container text-center">
        <div class="col-md-6">
            <p>&copy; 2025 RasaNusantara. Seluruh hak cipta dilindungi. Desain oleh <a
                    href="http://www.templatewire.com" rel="nofollow">TemplateWire</a></p>
        </div>
        <div class="col-md-6">
            <div class="social">
                <ul>
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<script>
        function order() {
        window.location.href = "/order"; // arahkan ke halaman order
    }
</script>
<script type="text/javascript" src="js/jquery.1.11.1.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/SmoothScroll.js"></script>
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script>
<script type="text/javascript" src="js/contact_me.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
