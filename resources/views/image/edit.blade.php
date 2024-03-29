@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar imagen.</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" value="{{$image->id}}" />
                        <div class="form-group row">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right"> Imagen </label>
                            <div class="col-md-7">

                                
                                <div class="container-avatar">
                                    <img src="{{ route('image.file',['filename' => $image->image_path ]) }}" class="avatar" />
                                </div>
                                

                                <input id="image_path" type="file" name="image_path" class="form-control"/>

                                @if($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Description" class="col-md-3 col-form-label text-md-right"> Descripcion </label>
                            <div class="col-md-7">
                                <textarea id="Description" type="file" name="Description" class="form-control" required>{{$image->description}}</textarea>

                                @if($errors->has('Description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('Description') }}</strong>
                                </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row">                           
                            <div class="col-md-6 offset-md-3">                                                       
                                <input type="submit" class="btn btn-primary" value="editar imagen" />
                            </div>
                        </div>                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection