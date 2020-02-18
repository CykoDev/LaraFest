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

</div>

@endsection


