@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif

            <div class="card pub_image pub_image_detail">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ url('/user/avatar/'.$image->user->image) }}" class="avatar" />
                    </div>
                    @endif
                    <div class="data-user">
                        {{$image->user->name .' '.$image->user->surname}}
                        <span class="nickname">
                            {{' | @'.$image->user->nick}} 
                        </span>

                    </div>

                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('image.file',['filename' => $image->image_path ]) }}" />
                    </div>
                </div>
                <div class="likes">
                    {{count($image->likes)}}
                    <?php $user_like = false; ?>
                    @foreach($image->likes as $like)
                    @if($like->user->id == Auth::user()->id)
                    <?php $user_like = true; ?>
                    @endif
                    @endforeach                   
                    @if($user_like)                   
                    <img src="{{ asset('img/rojo.png') }}" data-id="{{$image->id}}" class="btn-dislike" />
                    @else
                    <img src="{{ asset('img/negro.png') }}" data-id="{{$image->id}}" class="btn-like" />
                    @endif
                </div>
                <div class="description">
                    <span class="nickname">{{'@'. $image->user->nick }}</span>
                    <span class="nickname">{{' | '. \FormatTime::LongTimeFilter($image->created_at) }}</span>
                    <p>{{ $image->description}}</p>
                </div>

                @if(Auth::user() && Auth::user()->id == $image->user->id )
                <div class="actions">
                    <a href="{{ route('image.edit',['id' => $image->id ]) }}" class="btn btn-sm btn-primary">Actualizar.</a>
                    <a href="{{ route('image.delete',['id' => $image->id ]) }}" class="btn btn-sm btn-danger">Borrar.</a>



                </div>
                @endif
                @include('includes.comment')
                @foreach($image->comments as $comment)
                <div class="comment">
                    <div class="description">
                        <span class="nickname">{{'@'. $comment->user->nick }}</span>
                        <span class="nickname">{{' | '. \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                        <p>{{ $comment->content}}</p> 
                        @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                        <a href="{{ route('comment.delete',['id' => $comment->id ]) }}" class="btn btn-sm btn-danger">
                            eliminar
                        </a>
                        @endif
                    </div>                    
                </div>                
                @endforeach


            </div>
        </div>
    </div>
</div>
@endsection
