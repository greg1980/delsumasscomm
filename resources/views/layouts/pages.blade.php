<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@700&display=swap" rel="stylesheet">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <title>DelsuMassComm</title>
</head>
<body>
<!--Navigation-->
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #e3f2fd; ">
    <a class="navbar-brand text-primary ml-5" href="#">
        <img src="{{'images/logo.jpg'}}" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
        <b>Delsumasscomm</b>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mr-5 " id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto ">
            <li class="nav-item {{Request::path() === '/' ? 'active' : ''}}">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{Request::path() === '/about' ? 'active' : ''}}">
                <a class="nav-link"  href="{{ route('about') }}">About Us</a>
            </li>
            <li class="nav-item {{Request::path() === '/research' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('research') }}">Research</a>
            </li>
            <li class="nav-item dropdown {{Request::path() === '/students' ? 'active' : ''}}">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Students
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('undergraduate') }}">Undergraduate</a>
                    <a class="dropdown-item" href="{{ route('postgraduate') }}">Postgraduate</a>
                    <a class="dropdown-item" href="{{ route('amasscos') }}">Amasscos</a>
                </div>
            </li>
            <li class="nav-item dropdown {{ Request::path() === '/alumni' ? 'active' : ''}}">
                <a href="{{ route('alumni') }}" class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Alumni
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('events') }}" class="dropdown-item">Events</a>
                    <a href="{{ route('news')}}" class="dropdown-item">News</a>
                </div>
            </li>
            <li class="nav-item {{Request::path() === '/contact' ? 'active' : ''}}">
                <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
            </li>
            @if (!auth()->user())
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}" tabindex="-1" aria-disabled="true">Login</a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('logout') }}" tabindex="-1" aria-disabled="true">Logout</a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<div>
    @yield('content')
</div>

<!-- Blue Banner -->
<div class="container-fluid delsu text-center ">

</div>

<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h3 class="mb-3">Contact Us</h3>
                <p><i class="far fa-envelope"></i>: info@delsumascomm.com</p>
                <p><i class="fab fa-twitter"></i>: @delsumascomm</p>
                <p><i class="fab fa-facebook-f"></i>: delsumascomm</p>
                <p><i class="fas fa-mobile-alt"></i>: 08086628044</p>
            </div>

            <div class="col-lg-4">
                <h3 class="mb-3">Related links</h3>
                <p><a href=""><i class="fa fa-check"></i>  Terms and condition</a></p>
                <p><a href=""><i class="fas fa-user-secret"></i> Privacy Policy</a></p>
                <p><a href=""><i class="fas fa-question-circle"></i> Frequently Asked Questions</a></p>
                <p><a href=""><i class="fas fa-briefcase"></i> Work For Us</a></p>
            </div>

            <div class="col-lg-4">
                <h3 class="mb-3">Delta State University </h3>
                <p>Department Of Mass Communication </p>
                <p>Copyright <i class="fa fa-copyright"></i> <?php echo date('Y') ?> . All Rights Reserved.</p>
            </div>

        </div>

    </div>

</div>
<!-- footer -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
