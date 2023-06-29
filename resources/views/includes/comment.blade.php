<div class="comments">
    <h2>Comentarios ({{ count($image->comments) }})</h2>
    <hr>

    <form method="POST" action="{{route('comment.store')}}" >
        @csrf
        <input type="hidden" name="image_id" value="{{$image->id}}" />
        <p>
            <textarea class="form-control {{$errors->has('content') ? 'is-invalid' :'' }}" name="content"></textarea>
        </p>
        <input class="btn btn btn-sucess" type='submit' value='comentar.'/>
    </form>

</div>