@extends('layouts.pages')
<!--SLIDERS-->
@section('content')

<div id="carouselExampleCaptions" class="carousel slide " data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active ">
            <div class="imgoverlay container-fluid">
                <div class="container-fluid divoverlay">
                    <h4 class="text-white"style="font-family: 'El Messiri', sans-serif;">These are unprecedented times for delsu and for the wold. Find out how we are combating the global COVID 19 pandemic and how you can help</h4>
                    <br>
                    <button class="btn btn-success ">Learn More <b> ></b></button>
                </div>
            </div>
            <img src="images/satelite.jpg" class="d-block w-100 " alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1 style="font-family: 'El Messiri', sans-serif;" class="text-white">FACULTY OF SOCIAL SCIENCE</h1>
            </div>
        </div>
        <div class="carousel-item">
            <div class="imgoverlay">
                <div class="container-fluid divoverlay">
                    <h4 class="text-white"style="font-family: 'El Messiri', sans-serif;">These are unprecedented times for delsu and for the wold. Find out how we are combating the global COVID 19 pandemic and how you can help</h4>
                    <br>
                    <button class="btn btn-info ">Learn More <b> ></b></button>
                </div>
            </div>
            <img src="images/studio.jpg" class="d-block w-100 " alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1 style="font-family: 'El Messiri', sans-serif;" class="text-white">DELTA STATE UNIVERSITY ABRAKA</h1>
            </div>
        </div>
        <div class="carousel-item ">
            <div class="imgoverlay">
                <div class="container-fluid divoverlay">
                    <h4 class="text-white"style="font-family: 'El Messiri', sans-serif;">We deliver an outstanding learning experience that equips our students for future success. Study with us and you'll be challenged.</h4>
                    <br>
                    <button class="btn btn-warning ">Learn More <b> ></b></button>
                </div>
            </div>
            <img src="images/presentation.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="text-white" style="font-family: 'El Messiri', sans-serif;">DEPARTMENT OF MASS COMMUNICATION</h1>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!--- End of Slider--->
<div class="container-fluid delsu text-center ">
        <h5 class="pt-3 text-white " style="font-family: 'El Messiri', sans-serif;">Knowledge Character Service</h5>
</div>
<!--- Department --->
<div class="row justify-content-md-center pt-5 ">
    <div class="container">
        <div class="card-deck">
            <div class="card shrink">
                <img src="images/research.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="text-success"><i class="fas fa-building fa-fw  mr-2 "></i> Department </h3>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
            <div class="card shrink">
                <img src="images/postgraduate.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="text-info" ><i class="fas fa-graduation-cap fa-fw  mr-2 text-gray-400"></i> Undergraduate </h3>
                    <p class="card-text">We are a world-leading university, advancing knowledge, providing creative solutions, and addressing global problems.</p>
                </div>
            </div>
            <div class="card shrink">
                <img src="images/undergraduate.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h3 class="text-warning"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Postgraduate </h3>
                    <p class="card-text">Extend your subject knowledge past undergraduate level. Perhaps specialise in an academic field.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--- End of Department --->

<!-- Small Banner -->
<div class="row amasscos">
    <div class="container">
        <div class="row shrink" >
            <div class="col-8 text-white mt-lg-5 text-center">
                <h2 style="font-family: 'El Messiri', sans-serif;">Get support from Amascos</h2>
                <p class="lead">Join our department association to know more on what you stand to gain</p>
            </div>
            <div class="col mt-lg-5">
                <a type="button" href="{{ route('amasscos') }}" class=" btn btn-info  ">Join Amascos <i class="fas fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Small Banner -->

<!-- About US -->
<div class="container pt-5 about">
    <div class="row">
        <div class="col-lg-5" >
            <h1 class="text-center text-muted" style="font-family: 'El Messiri', sans-serif;">About Us</h1>
            <div class="img-fluid text-center press">
                <a href=""><img src="/images/drOgwezi.jpg" alt="Responsive" class="img-center bd-placeholder-img rounded-circle"></a>
                <h6 class=" text-muted">Dr OGWEZI, JOYCE OGHO - HEAD OF DEPARTMENT</h6>
            </div>
        </div>
        <div class="col-lg-7 mt-lg-5" >
            <h2 class="text-muted"> Want to know more about the department?</h2>
            <p class="lead text-justify">Delta state university was established in 1989 and had her first head of department who is now the current HOD.</p>
            <p class="lead text-justify">Dr Ogwezi is a communication expert and has expertise in the area of community development.</p>
            <div class="text-center"><a class=" btn btn-info " href="{{route('about')}}" type="button" >Find out more</a> </div>
        </div>
    </div>
</div>
<!-- End of About US -->

<!-- Cards -->
<div class="container" >
    <div class="row text-center">
        <div class="card-group mt-5">
            <div class="card fadeout">
                <img src="images/steve-halama-t5zp-0ZXFPg-unsplash.jpg" class="card-img-top" alt="...">
                <div class="card-img-overlay text-white centerimgoverlay ">
                    <h2 class="card-title text-success mb-5 mt-5">RESEARCH</h2>
                    <h1 class="card-text text-center"style="font-family: 'El Messiri', sans-serif;">Our researchers are developing solutions to some pressing issues facing the world</h1>
                    <br>
                    <br><a href="{{route('research')}}" class="btn btn-success">Read More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="card fadeout">
                <img src="images/gene-jeter-kcV7BxcVtU4-unsplash.jpg" class="card-img-top" alt="...">
                <div class="card-img-overlay text-white centerimgoverlay">
                    <h2 class="card-title text-info mb-5 mt-5">JOURNALISM</h2>
                    <h1 class="card-text text-center" style="font-family: 'El Messiri', sans-serif;">We offer a wide range of training delivered by our experienced media veterans</h1>
                    <br>
                    <br><a href="#" class="btn btn-info">Read More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
            <div class="card fadeout" >
                <img src="images/jounalism.jpg" class="card-img-top" alt="...">
                <div class="card-img-overlay text-white centerimgoverlay ">
                    <h2 class="card-title text-warning mb-5 mt-5">EVENTS</h2>
                    <h1 class="card-text text-center" style="font-family: 'El Messiri', sans-serif;">News and events within the department of mass communication</h1>
                    <br>
                    <br> <a href="{{route('events')}}" class="btn btn-warning text-white">Read More <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of cards -->

<!-- Alumni -->
<div class="container pt-5  alumni">
    <div class="row ">
        <div class="col-lg-7">
            <div class="text-center mt-lg-5">
                <p class="text-muted text-justify mb-5">
                    Our global alumni network is a unique community of former communicators who are now currently making impact around the world in almost every sphere
                </p>
                <button class="btn btn-info btn-lg">Join Us <i class="fas fa-chevron-circle-right"></i></button>
            </div>
        </div>
        <div class="col-lg-5 press">
            <h1 class="text-center text-info" style="font-family: 'El Messiri', sans-serif;">Alumni</h1>
            <a href=""><img src="/images/student.jpg" alt="" class="w-100 img-fluid bd-placeholder-img rounded-circle"></a>
        </div>
    </div>
</div>
<!-- end of alumni -->
<!-- Small Banner -->
<div class="row subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 text-white mt-lg-5 text-justify">
                <p class="lead text-muted">The simplest way to keep up-to-date is to register your details below and we will send you our email communications.</p>
            </div>
            <div class="col-lg-4 mt-lg-5" style="margin-left: 90px;">
                <a href="{{route('news')}}" type="button" class=" btn btn-info ml-auto mt-2 btn-lg">SUBSCRIBE <i class="fas fa-chevron-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>
@stop
<!-- Small Banner -->

<!-- Blue Banner -->
