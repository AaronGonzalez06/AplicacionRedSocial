<div class="card pub_image">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <img src="{{ url('/user/avatar/'.$image->user->image) }}" class="avatar" />
                    </div>
                    @endif
                    <div class="data-user">
                        <a href="{{ route('profile',['id' => $image->user->id]) }}">
                            {{$image->user->name .' '.$image->user->surname}}
                            <span class="nickname">
                                {{' | @'.$image->user->nick}}
                            </span>
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="image-container">
                        <img src="{{ route('image.file',['filename' => $image->image_path ]) }}" />
                    </div>
                </div>
                <div class="likes">
                    {{count($image->likes)}}
                    <?php $user_like = false;?>
                    @foreach($image->likes as $like)
                    @if($like->user->id == Auth::user()->id)
                    <?php $user_like = true;?>
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
                <a href="{{ route('image.detail',['id' => $image->id]) }}" class="btn btn btn-warning btn-comments ">
                    Comentarios ({{ count($image->comments) }})
                </a>
            </div>