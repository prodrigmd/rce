<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Casebook | Welcome</title>
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/icon type">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Actor&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alike+Angular&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Baloo+Tammudu+2&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/Pretty-Footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/untitled.css') }}">
</head>

<body style="background: rgb(102,102,102);">
    <nav class="navbar navbar-light navbar-expand-md fixed-top" style="background-color:#292c2f;">
        <div class="container-fluid"><a class="navbar-brand" href="{{ url('/') }}" style="color: #e9711c;font-family: 'Alike Angular', serif;font-size: 24px;">
{{--                <img class="logo" src="{{ asset('assets/img/logo.jpg') }}">--}}
                <strong>CaseBook</strong></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#foot">About Us</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="promo">
        <section>
            <div class="bg-light border rounded border-light jumbotron">
                <h1 class="text-center" style="font-size: 28px;color: rgb(255,255,255);">Welcome to Casebook!</h1>
                <p class="text-center" style="font-size: 16px;color: rgb(255,255,255);">This is the site of clinical cases kept with the highest security standards. The anonymity of the information is ensured for the sole purpose of learning and improving health care.</p>
                <p class="text-center">
                    @if (Route::has('login'))
                        @auth
                            <a class="btn btn-info btn-lg" role="button" href="{{ url('/home') }}" style="font-size: 16px;">Home</a>
                        @else
                            <a class="btn btn-info btn-lg" role="button" href="{{ url('/login') }}" style="font-size: 16px;">Log in</a>
                            @if (Route::has('register'))
                            <a class="btn btn-info btn-lg" role="button" href="{{ route('register') }}" style="font-size: 16px;">Register</a>
                            @endif
                        @endauth
                    @endif
                </p>
            </div>
        </section>
    </div>
    <div class="container site-section" id="welcome">
        <h1 style="color: rgb(255,255,255);font-size: 28px;">A powerful and elegant communication tool</h1>
        <p style="color: rgb(255,255,255);font-size: 16px;text-align: justify">The idea under the roof is to be able to have a powerful tool to keep your clinical cases safe and private, and to be able to bring them to life when needed. It may be a clinical meeting, or a conversation with a colleague, or perhaps you want to show images to a patient. For a presentation and to be able to share with the audience. The level of privacy is up to you. We believe that sharing your knowledge can generate a virtuous circle by being able to return the contribution that others have made. You and others can learn to the extent that you voluntarily decide how to share fully, partially, or leave the cases completely private. That is the principle of our company: share and learn. Welcome!</p>
    </div>
    <div class="container site-section" id="learn">
        <h1 style="color: rgb(255,255,255);font-size: 28px;">A frame image collection for your cases</h1>
        <div class="row">
            <div class="col-auto col-md-3">
                <div class="card bg-black"><a href="{{ asset('assets/img/1.png') }}" target="_blank" data-lightbox="cakes"><img class="img-fluid" src="{{ asset('assets/img/1.png') }}"></a></div>

            </div>
            <div class="col-auto col-md-3">
                <div class="card bg-black"><a href="{{ asset('assets/img/2.jpg') }}" target="_blank" data-lightbox="cakes"><img class="img-fluid" src="{{ asset('assets/img/2.jpg') }}"></a></div>
            </div>
            <div class="col-auto col-md-3">
                <div class="card bg-black"><a href="{{ asset('assets/img/3.jpg') }}" target="_blank" data-lightbox="cakes"><img class="img-fluid" src="{{ asset('assets/img/3.jpg') }}"></a></div>
            </div>
            <div class="col-auto col-md-3">
                <div class="card bg-black"><a href="{{ asset('assets/img/4.jpeg') }}" target="_blank" data-lightbox="cakes"><img class="img-fluid" src="{{ asset('assets/img/4.jpeg') }}"></a></div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container" id="foot">
            <div class="row">
                <div class="col-sm-6 col-md-4 footer-navigation">
                    <h3>CaseBook</h3>
                    <p class="links"><a href="#" style="font-size: 14px;">Create</a><strong> · </strong><a href="#welcome" style="font-size: 14px;">Share</a><strong> · </strong><a href="#learn" style="font-size: 14px;">Learn</a><strong>&nbsp;</strong></p>
                    <p class="company-name">CaseBook by Neurorad Co. © 2021</p>
                </div>
                <div class="col-sm-6 col-md-4 footer-contacts">
                    <div><span class="fa fa-map-marker footer-contacts-icon"> </span>
                        <p style="font-size: 14px;"><span class="new-line-span"></span>Santiago, Chile</p>
                    </div>
                    <div><i class="fa fa-envelope footer-contacts-icon"></i>
                        <p style="font-size: 15px;"> <a href="mailto:admin@neurorad.cl" target="_blank" style="font-size: 14px;">admin@neurorad.cl</a></p>
                    </div>
                </div>
                <div class="col-md-4 footer-about">
                    <h4>About the company</h4>
                    <p> We are a company devoted to improve the research, education and direct medical care to build high impact, innovative, diversity, equity and inclusion solutions in healthcare.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>
</body>

</html>
