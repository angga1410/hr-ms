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
                        <!-- <div class="card-header">
                            <h5 class="title">{{ __('Modular Generic Hierarchy') }}</h5>
                        </div> -->
                        <div class="card-body">
                    
          <div class="row">
            <div class="col-md-12">
                <?php /* 
                if($_SERVER['HTTP_HOST'] == 'localhost')
                { ?>
                    <iframe src="{{url('http://localhost/hierarchy_modular/hierarchy_setup_embeded')}}" width="100%" height="1900">Your browser isn't compatible</iframe>
                <?php } else { */ ?>
                <iframe src="{{url('http://18.141.137.82/hierarchy_modular/one_page_settings')}}" width="100%" height="560" frameBorder="0" style="border:0px none;">Your browser isn't compatible</iframe>
                <?php // } ?>
                
            </div>
          </div>
                      
                    </div>
                
            </div>
                    </form>
        </div>
    </div>
@endsection