<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- IE Compatibility Meta-->
    <meta name="author" content="Satt IT" />
    <meta name="description" content="Point of Sell | Satt IT" />
    <link rel="icon" href="{{ asset('images/sfavicon.png') }}" type="image/gif" sizes="64x64">
    <title> Point of Sell | Satt IT </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <!--    fontawesome cdn link-->
    <link rel="stylesheet" href="{{ asset('frontend/css/font.min.css') }}" crossorigin="anonymous">
    <!-- Stylesheets-->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/rsanimations.css') }}">
    <!--    AOS - Animate on scroll library -->
    <link href="{{ asset('frontend/css/aws.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>

<body>
    <section class="header-area" id="home" style="background:rgba(0, 0, 0, 0.7) url({{ asset('frontend/images/bg02.jpg') }});">
        <!-- header start-->
        <header class="">
            <div class="container">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('images/logo.png') }}" alt="logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">

                            <li class="nav-item">
                                <a class="nav-link" href="#">Contact</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn-success rounded px-4 text-light" href="{{ route('login') }}"> Log in </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- header end-->
        <div class="container">
            <div class="col-md-12 my-auto text-center slidr-text text-light">
                <p class="h1 shorif mb-0 animated fadeInDown delay-1s text-light align-self-center"> স্যাট পস </p>
                <h1 class="h3  animated  fadeInUp delay-2s"> সফ্টওয়্যার দিয়ে আপনার খুচরা বিক্রয় দ্রুত বাড়ান
                </h1>
                <p class="h5 mt-4"> স্যাট হলো cloud আপনার ব্যবসার চালনা ও বিকাশের জন্য প্রয়োজনীয় সমস্ত কিছু সহ একটি
                    শীর্ষস্থানীয় খুচরা বিক্রয় পস সফটওয়্যার। </p>

                <a href="#" class="btn btn-success px-4 py-2"> Try to Free </a>
            </div>
        </div>
    </section>
    <!--    about us area start -->
    <section class="container about-area my-5" id="about">
        <div class="row">
            <div class="col-md-6 my-auto">
                <h2 class="shorif"> Omnichannel পয়েন্ট অফ সেল </h2>
                <p> খুচরা ইভেন্টগুলিতে, পপ-আপ স্টোর এবং এমনকি অনলাইনে ইন-স্টোর বিক্রয় করুন। একটি POS সফ্টওয়্যার সমস্ত
                    বিক্রয় চ্যানেল সহ, আপনার খুচরা ব্যবসায়ের সমস্ত দিক পরিচালনা করে। </p>
                <ul class="mx-0 list-unstyled">
                    <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; দোকানে বিক্রয়
                    </li>
                    <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; বিক্রি রাস্তায়
                        চলতে চলতে </li>
                    <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইন্টিগ্রেটেড
                        ইকমার্স সাথে অনলাইনে বিক্রি </li>
                    <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; আমাজন
                        মার্কেটপ্লেসের বিক্রি
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <img class="w-100 img-thumbnail aos-init aos-animate" src="{{ asset('frontend/images/m2.jpg') }}" alt="screen"
                    data-aos="fade-down" data-aos-duration="1000">
            </div>
        </div>
    </section>
    <!--    about us area end -->
    <!-- services area start -->
    <div class="service-area" id="services">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="w-100 img-thumbnail aos-init aos-animate" src="{{ asset('frontend/images/Retail.webp') }}" alt="screen" data-aos="fade-down" data-aos-duration="1000">
                </div>
                <div class="col-md-6 my-auto">
                    <h2 class="shorif"> অল-ইন-ওয়ান খুচরো প্ল্যাটফর্ম </h2>
                    <p> আপনার খুচরা ব্যবসায় কার্যকরভাবে চালানোর জন্য এবং বাড়ানোর জন্য আপনার প্রয়োজনীয় সমস্ত কিছুই এর
                        অন্তর্ভুক্ত।
                    </p>

                    <ul class="mx-0 list-unstyled">
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; পয়েন্ট অফ
                            সেল </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইন্টিগ্রেটেড
                            ইকমার্স </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইন্টিগ্রেটেড
                            পেমেন্ট </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইনভেনটরি
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইনভেন্টরি
                            গণনা
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; গ্রাহক
                            প্রোফাইল
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; মাল্টি দোকান
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; রিপোর্টিং
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- services area end -->
    <!-- Product area start -->
    <section class="product-area" id="product">
        <div class="container">
            <div class="text-center py-4">
                <h2 class=""> খুচরা দোকানে জন্য সবচেয়ে পারফেক্ট পস সফ্টওয়্যার </h2>
                <h4 class="shorif"> পস সফ্টওয়্যার দিয়ে আপনার খুচরা ব্যবসায় শুরু করুন, চালান এবং বাড়ান </h4>
                <hr class="hr-1">
            </div>
            <div class="row " data-aos="zoom-in-down" data-aos-duration="1000">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/shopping.svg') }}" alt="Concept and Strategy">
                            <h4 class="card-title"><a href="#"> পোশাকের দোকান </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/coffee.svg') }}" alt="Interactive Business">
                            <h4 class="card-title"><a href="#"> কফি শপ </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/jewelry.svg') }}" alt="Best Performance">
                            <h4 class="card-title"><a href="#"> জুয়েলারীর দোকান </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/shelves.svg') }}" alt="Best Performance">
                            <h4 class="card-title"><a href="#"> ফার্নিচারের দোকান </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/entertainment.svg') }}" alt="Financial Institution">
                            <h4 class="card-title"><a href="#"> খাদ্য ট্রাক </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/business.svg') }}" alt="Full Security">
                            <h4 class="card-title"><a href="#"> উপহারের দোকান </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/animals.svg') }}" alt="Worldwide Access">
                            <h4 class="card-title"><a href="#"> পোষা প্রাণীর দোকান </a></h4>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 my-3">
                    <div class="card">
                        <div class="card-block block-1">
                            <img src="{{ asset('frontend/images/store.svg') }}" alt="Worldwide Access">
                            <h4 class="card-title"><a href="#"> খুচরা উদাহরণ </a></h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Product area end -->
    <!--    news area start -->
    <section class="news-area" id="news">
        <div class="container">
            <div class="row" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-md-6 my-auto">
                    <h2 class="shorif"> 1 থেকে 100 এর বেশি খুচরো দোকান </h2>
                    <p> আপনার ব্যবসার সাথে এটি বৃদ্ধি পায়। প্রয়োজন অনুসারে সহজেই আরও নগদ রেজিস্টার, ব্যবহারকারী বা
                        এমনকি লোকেশন সঞ্চয় করুন।
                    </p>
                    <p> শক্তিশালী হার্ডওয়্যার সামঞ্জস্যতা এবং যে কোনও পিসি, ম্যাক বা আইপ্যাডের সাথে ব্যবহার করার
                        স্বাধীনতার সাথে, আপনি প্রতিটি রেজিস্টারকে তার পাল্টা জায়গা এবং বিন্যাস অনুসারে ডিজাইন করতে
                        পারেন।
                    </p>
                    <a href="#" class="btn btn-success px-5 py-2 rounded-pill"> Start my free trial </a>
                </div>
                <div class="col-md-6">
                    <img class="img-thumbnail " src="{{ asset('frontend/images/apple.jpg') }}" alt="">
                </div>
            </div>
            <div class="row mt-5" data-aos="fade-up" data-aos-duration="1000">
                <div class="col-md-6">
                    <img class="img-thumbnail " src="{{ asset('frontend/images/apple.jpg') }}" alt="">
                </div>
                <div class="col-md-6 my-auto">
                    <h2 class="shorif"> বৃদ্ধির ক্ষমতা বাড়ান </h2>
                    <p> আমাদের পস সফটওয়্যারটি নির্বিঘ্নে শিল্পের শীর্ষস্থানীয় অ্যাকাউন্টিং, ইকমার্স, অর্থ প্রদান এবং
                        বিপণনের অ্যাপ্লিকেশনগুলির সাথে সংহত করে। </p>

                    <ul class="mx-0 list-unstyled">
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; পয়েন্ট অফ
                            সেল </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইন্টিগ্রেটেড
                            ইকমার্স </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইন্টিগ্রেটেড
                            পেমেন্ট </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইনভেনটরি
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; ইনভেন্টরি
                            গণনা
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; গ্রাহক
                            প্রোফাইল
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; মাল্টি দোকান
                        </li>
                        <li class="my-2"> <i class="far fa-check-circle" style="color: #8d97ad"></i> &nbsp; রিপোর্টিং
                        </li>
                    </ul>

                    <a href="#" class="btn btn-success px-5 py-2 rounded-pill"> Start my free trial </a>
                </div>
            </div>
        </div>
    </section>
    <!--    news area end -->
    <!--    Contact area start -->
    <section class="contact-area" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-10 mx-auto text-center">
                    <h2> শুরু করা সহজ </h2>
                    <p class="h5"> 14 দিনের ফ্রি ট্রায়াল দিয়ে হাইক পস সফটওয়্যারটি ব্যবহার শুরু করুন এবং 3 টি সহজ ধাপে
                        খুচরা জন্য এটি প্রস্তুত করুন। </p>
                    <hr class="hr-1">
                </div>
            </div>
            <div class="row mt-5" data-aos="zoom-in-down" data-aos-duration="1000">
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <div class="icon-part">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="icon-text">
                            <h3 class="icon-title shorif"> আপলোড </h3>
                            <br>
                            <p class="mb-0"> আমাদের বিদ্যমান সিএসভি আমদানি উইজার্ড ব্যবহার করে বিদ্যমান সমস্ত পণ্য এবং
                                গ্রাহকের ডেটা একবারে আপলোড করুন।
                            </p>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <div class="icon-part">
                            <i class="fas fa-puzzle-piece"></i>
                        </div>
                        <div class="icon-text">
                            <h3 class="icon-title shorif"> কাস্টমাইজ </h3>
                            <br>
                            <p class="mb-0"> হাইক আপনাকে মুদ্রা, সময় অঞ্চল, করের হারের সেটিংস এবং এমনকি ভাষা সহ সমস্ত
                                বিষয় কাস্টমাইজ করতে দেয়। </p>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="contact-card">
                        <div class="single-icon text-center">
                            <div class="icon-part">
                                <i class="fas fa-plug"></i>
                            </div>
                            <div class="icon-text">
                                <h3 class="icon-title shorif"> হার্ডওয়্যার সংযুক্ত করুন
                                </h3>
                                <p class="mb-0"> যে কোনও পিসি, ম্যাক বা আইপ্যাড ব্যবহার করে স্টোর কাউন্টার সেট আপ করুন।
                                    হাইক বেশিরভাগ খুচরা হার্ডওয়ারের সাথে প্লাগ-এন-প্লে সামঞ্জস্যতা সরবরাহ করে।
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--   Contact area end -->
    <!--    Contact area start -->
    <section class="contact-area" id="contact" style="background-color: #ececec;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Contact Us</h2>
                    <h4>Get in touch and let us know how we can help</h4>
                    <hr class="hr-1">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row py-5">
                <div class="col-md-6">
                    <div class="leave-comments-area">
                        <h3>GET IN TOUCH</h3>
                        <div id="form-messages"></div>
                        <form id="contact-form" method="post"
                            action="http://rstheme.com/products/html/news24/sports-magazine/contact.php">
                            <fieldset>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" class="form-control" required=""
                                                placeholder="First Name*">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="lname" id="lname" class="form-control" required=""
                                                placeholder="Last Name*">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control" required=""
                                                placeholder="Email*">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" class="form-control" required=""
                                                placeholder="Phone*">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea cols="40" id="message" name="message" rows="10"
                                                class="textarea form-control" placeholder="Your Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-success py-2 rounded-pill w-50" type="submit">Send
                                                Message </button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29076.184766284438!2d88.6061780949695!3d24.363099877789672!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3754fc8cffffffff%3A0x398330dea7d93595!2sSATT%20IT-%20Web%20Development%20Company%20in%20Bangladesh!5e0!3m2!1sen!2sbd!4v1587383542784!5m2!1sen!2sbd"
                        style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!--   Contact area end -->
    <!--brand area start -->
    <section class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2> আপনি ভাল সংস্থায় আছেন </h2>
                    <hr class="hr-1">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-2">
                    <img class="w-100" src="https://sattit.com/frontend/img/Logo2.png" alt="">
                </div>
                <div class="col-md-2">
                    <img class="w-100" src="https://sattit.com/frontend/img/Logo2.png" alt="">
                </div>
                <div class="col-md-2">
                    <img class="w-100" src="https://sattit.com/frontend/img/Logo2.png" alt="">
                </div>
                <div class="col-md-2">
                    <img class="w-100" src="https://sattit.com/frontend/img/Logo2.png" alt="">
                </div>
                <div class="col-md-2">
                    <img class="w-100" src="https://sattit.com/frontend/img/Logo2.png" alt="">
                </div>
                <div class="col-md-2">
                    <img class="w-100" src="https://sattit.com/frontend/img/Logo2.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <!--brand area end -->
    <!--free area start-->
    <section style="background-color: #ececec; padding: 70px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="h2"> Try Hike free for 14 days </p>
                    <p> তাত্ক্ষণিক অ্যাক্সেস, কোনও ক্রেডিট কার্ড নেই, ঝুঁকি নেই। </p>
                </div>
                <div class="col-md-6 text-right my-auto">
                    <a href="#" class="btn btn-outline-success px-5 py-2 rounded-pill"> Contact Sales </a>
                    <a href="#" class="btn btn-outline-success px-5 py-2 rounded-pill ml-3"> Try SattPOS for Free </a>
                </div>
            </div>
        </div>
    </section>
    <!--free area end-->
    <!-- footer area start -->
    <div class="footer-area" id="footer">
        <div class="container text-light">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="footer-info-area">
                        <div class="footer-logo">
                            <a href="#" class="logo-link">
                                <img src="{{ asset('images/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <div class="text">
                            <p>Conveying or northward offending admitting perfectly my. Colonel gravity get thought fat
                                smiling add
                                but.
                            </p>
                        </div>
                    </div>
                    <div class="fotter-social-links">
                        <ul>
                            <li>
                                <a href="#" class="facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dribbble">
                                    <i class="fab fa-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-bg text-center text-light">
            <p>Copyright © {{date('Y') }}. Powered by <a href="http://souatsadikhan.com">Sadik</a>
            </p>
        </div>
    </div>
    <!-- footer area end -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}">
    </script>
    <script src="{{ asset('frontend/js/popper.min.js') }}">
    </script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}">
    </script>
    <!--    AOS - Animate on scroll library -->
    <script src="{{ asset('frontend/js/aws.min.js') }}"></script>
    <script>
        AOS.init();
    </script>
    <!--     for smoothscroll js -->
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/easi.min.js') }}"></script>
    <script src="{{ asset('frontend/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('frontend/js/scrolls.js') }}"></script>
    <script>
        scroller.init();
    </script>
    <script>
        jQuery(function ($) {
            $(document).SmoothScroll({
                target: 'a[href^="#"]',
                duration: 1300,
                easing: 'easeOutQuint'
            });
        });


        /* ========================================== 
        scrollTop() >= 300
        Should be equal the the height of the header
        ========================================== */

        $(window).scroll(function () {
            if ($(window).scrollTop() >= 250) {
                $('header').addClass('fixed-header');
            } else {
                $('header').removeClass('fixed-header');
            }
        });
    </script>
</body>

</html>