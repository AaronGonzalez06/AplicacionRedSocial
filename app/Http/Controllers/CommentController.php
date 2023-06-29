<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        //validar
        $validate = $this->validate($request, [
            'image_id' => 'integer|required',
            'content' => 'string|required'
        ]);
        //datos
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        $user = \Auth::user();

        //asignar valores
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        //guardar
        $comment->save();

        return redirect()->route('image.detail', ['id' => $image_id])
                        ->with([
                            'message' => 'comentario añadido'
        ]);
    }

    public function delete($id) {
        //datos del usuario registrado
        $user = \Auth::user();

        //conseguir objeto del comentario
        $comment = Comment::find($id);

        //comprobar si es mia la foto o el comentario.
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with([
                                'message' => 'comentario eliminado'
            ]);
        } else {

            return redirect()->route('image.detail', ['id' => $comment->image->id])
                            ->with([
                                'message' => 'comentario no eliminado'
            ]);
        }
    }

}
