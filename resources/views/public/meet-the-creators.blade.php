@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Meet The Devs</h1>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4 p-5">
            <div class="text-center p-3 pt-5 mt-2 mb-5">
                <img height="210" src="{{ asset('img/public/undraw_team_goals_hrii.svg') }}" alt="welcome!">
            </div>
            <br>
            <div class="card shadow mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Muhammad Saad Hussaini</h6>
                    <small>Deputy Director</small>
                </div>
                <div class="card-body">
                    <div class="text-center mt-2 mb-3">
                        <img height="200" heignt="200" src="{{ asset('img/public/creator_saad.jpg') }}" class="rounded-circle">
                    </div>
                    <div class="text-center">
                        <small class="font-weight-bold text-primary">"Έχω ένα hoolala στο παντελόνι μου."</small>
                    </div>
                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <a href="https://github.com/msaad1999" target="_blank">
                                    <i class="fab fa-2x fa-github text-dark"></i>
                                </a>
                            </div>
                            <div class="col">
                                <a href="https://www.linkedin.com/in/muhammadsaadhussaini/" target="_blank">
                                    <i class="fab fa-2x fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4 p-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Anas Imran Tasadduq</h6>
                    <small>Director</small>
                </div>
                <div class="card-body">
                    <div class="text-center mt-2 mb-3">
                        <img height="200" heignt="200" src="{{ asset('img/public/creator_anas.jpg') }}" class="rounded-circle">
                    </div>
                    <div class="text-center">
                        <small class="font-weight-bold text-primary">
                            "Πάρε με πέρα ​​από τον Πλούτωνα."
                        </small>
                    </div>
                    <div class="text-center mt-4">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <a href="https://github.com/aitasadduq" target="_blank">
                                    <i class="fab fa-2x fa-github text-dark"></i>
                                </a>
                            </div>
                            <div class="col">
                                <a href="https://www.linkedin.com/in/anas-imran-tasadduq-25285115a/" target="_blank">
                                    <i class="fab fa-2x fa-linkedin"></i>
                                </a>
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4 mx-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Meet The Dev House</h6>
            <small>Um yea</small>
        </div>
        <div class="card-body">
            <div class="text-center mt-2">
                <a class="btn btn-default" target="_blank" href="https://github.com/CykoDev">
                    <h1 class="display-3">CykoDev</h1>
                </a>
            </div>
            <div class="text-center mb-3">
                <a href="https://github.com/aitasadduq" class="btn btn-default px-1" target="_blank">
                    <img height="40" heignt="40" src="{{ asset('img/public/creator_anas.jpg') }}" class="rounded-circle">
                </a>
                <a href="https://github.com/msaad1999" class="btn btn-default px-1" target="_blank">
                    <img height="40" heignt="40" src="{{ asset('img/public/creator_saad.jpg') }}" class="rounded-circle">
                </a>
                <a href="https://github.com/skamal16" class="btn btn-default px-1" target="_blank">
                    <img height="40" heignt="40" src="{{ asset('img/public/creator_kamal.jpg') }}" class="rounded-circle">
                </a>
            </div>
            <div class="text-center">
                <p class="font-weight-bold text-primary">
                    "Braccas meas vescimini"
                </p>
                <a class="btn btn-default py-0" href="mailto:cykodev@gmail.com">
                    <small class="text-muted">
                        cykodev@gmail.com
                    </small>
                </a>
            </div>
            <div class="text-center mt-4">
                <div class="row pt-3">
                    <div class="col ml-5 mr-2">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 my-auto">
                                        <a href="https://github.com/CykoDev/GitKLiK" class="btn btn-default px-1" target="_blank">
                                            <i class="fas fa-4x fa-code-branch text-warning"></i>
                                        </a>
                                    </div>
                                    <div class="col-8 text-left">
                                        <a href="https://github.com/CykoDev/GitKLiK" class="btn btn-default px-1" target="_blank">
                                            <h3 class="text-dark">
                                                GitKLiK
                                            </h3>
                                        </a>
                                        <p class="small">
                                            Laravel Version Control Application employing Git, with remote repositories. Made with GitHub as inspiration
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mr-5 ml-2">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 my-auto">
                                        <a href="https://github.com/CykoDev/LaraFest" class="btn btn-default px-1" target="_blank">
                                            <i class="fab fa-4x fa-laravel text-danger"></i>
                                        </a>
                                    </div>
                                    <div class="col-8 text-left">
                                        <a href="https://github.com/CykoDev/LaraFest" class="btn btn-default px-1" target="_blank">
                                            <h3 class="text-dark">
                                                LaraFest
                                            </h3>
                                        </a>
                                        <p class="small">
                                            Laravel Festival management application with roles, data exports, multiple events, challan generation and more.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection


