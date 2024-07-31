@extends('Master.main')

@section('content')
<nav>
    <ol class="breadcrumb bg-primary text-white-all">
        <li class="breadcrumb-item"><a href="{{route('settings.index')}}"><i class="fas fa-tachometer-alt"></i> Settings</a></li>
        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-list"></i> Mot de passe par defaut des livreurs</li>
    </ol>
</nav>
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Mot de passe par defaut des livreurs</h5>
                </div>
                <div class="card-body" >
                    <div class="col-md-8">
                        <div class="card">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group manuel">
                                            <form action="{{route('password_save')}}" method="post">
                                                @csrf
                                                    <input type="text" @if($password)  value="{{ old('password', $password->value) }}" @else value=""  @endif name="password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" style="width: 100%" class="btn btn-success">{{__('message._update')}}</button>
                                                </div>
                                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
