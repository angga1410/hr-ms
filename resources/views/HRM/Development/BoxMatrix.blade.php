@extends('layouts.app', [
'class' => '',
'elementActive' => 'admin'
])

@section('content')
<style>
    @media screen and (min-device-width:698px) {
        div#showgrid {
            width: 929px;
            margin: auto;
            float: left;
        }
    }

    div.column {}

    .row {
        width: 100%;
        margin: auto;


    }

    @media (min-device-width: 698px) {
        .column {
            width: 230px;
            height: 230px;
            display: inline;
            float: left;
        }
    }

    .column {
        width: 230px;
        height: 230px;
        margin: auto;
    }

    .vertical-text {
        transform: rotate(-90deg);
        transform-origin: left top 10;
        margin-top: 50px;

        margin-left: 50px;
        font-size: 30px;
    }

    .vertical-text-a {
        transform: rotate(-90deg);
        transform-origin: left top 10;
        margin-top: 50px;

        margin-left: 50px;
        font-size: 20px;
    }

    .vertical-text-b {

        transform-origin: left top 10;
        margin-top: 10px;

        float: left;
        font-size: 20px;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> 9 Box Matrix </h4>
                </div>

                <div class="card-body">

                    <div id="showgrid">
                        <div class="row">
                            <div class="column">
                                <div class="vertical-text">&nbsp&nbsp&nbsp&nbsp HIGH</div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Enigma</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-warning">(9) employee</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Growth Employee</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-primary">(0) employee</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Star</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-primary">(0) employee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <div class="vertical-text-a">&nbsp&nbsp&nbsp&nbsp&nbsp MODERATE</div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Assess</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-primary">(0) employee</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Core Employee</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-primary">(0) employee</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">High Impact Contributor</h5>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-danger">(7) employee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <div class="vertical-text">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp LOW</div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Under Performer</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-success">(3) employee</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Effective Employee</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-primary">(0) employee</a>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="card" style="width: 18rem;">
                                    <!-- <img class="card-img-top" src="..." alt="Card image cap"> -->
                                    <div class="card-body">
                                        <h5 class="card-title">Trusted Professional</h5>
                                        </br>
                                        <p class="card-text"></p>
                                        <a href="#" class="btn btn-primary">(0) employee</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <div class="vertical-text-a"></div>
                            </div>
                            <div class="column">
                                <div class="vertical-text-b">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp LOW</div>
                            </div>
                            <div class="column">
                                <div class="vertical-text-b">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp MODERATE</div>
                            </div>
                            <div class="column">
                                <div class="vertical-text-b">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp HIGH</div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection