@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Usuarios</h1>
            <form method="GET" action="{{ route('user.index') }}" id="buscador" >
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control" />
                    </div>
                    <div class="form-group col">
                        <input type="submit" value="buscar" class="btn btn-success" />
                    </div>
                </div>
            </form>
            <hr/>
            @foreach($users as $user)
            <br/>
            <div class="profile-user">

                @if($user->image)
                <div class="container-avatar">
                    <img src="{{ url('/user/avatar/'.$user->image) }}" class="avatar" />
                </div>
                @endif

                <div class="user-info">
                    <h3>{{$user->nick}}</h3>
                    <h4>{{$user->name .' '. $user->surname}}</h4>
                    <p>{{'Se unio: '. \FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <a href="{{route('profile',['id' => $user->id])}}" class="btn btn-success">Ver perfil</a>
                </div>
            </div>
            <br/>

            @endforeach
            <!-- paginacion -->
            <div class="clearfix"></div>
            {{ $users->links()}}
        </div>
    </div>
</div>
@endsection

