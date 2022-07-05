@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'profile'
])

@section('content')
    <div class="content">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('password_status'))
            <div class="alert alert-success" role="alert">
                {{ session('password_status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 text-center">
                <form class="col-md-12" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">{{ __('One Pager') }}</h5>
                        </div>
                       
                    
          <div class="row">
            <div class="col-md-12 d-flex align-items-stretch">
                
                <?php /* 
                if($_SERVER['HTTP_HOST'] == 'localhost')
                { ?>
                    <iframe src="{{url('http://localhost/hierarchy_modular/dashboard_embeded_v2')}}" width="100%" height="1800">Your browser isn't compatible</iframe>
                <?php } else { */ ?>
                    <iframe src="{{url('http://18.141.137.82/hierarchy_modular/dashboard_embeded_v3')}}" frameBorder="0" width="100%" height="490%">Your browser isn't compatible</iframe>
                <?php // } ?>
                
            </div>
          </div>
                      
               
                
            </div>
                    </form>
        </div>
    </div>
@endsection