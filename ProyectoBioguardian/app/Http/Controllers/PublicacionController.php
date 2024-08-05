<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage; // Importa Storage aquí
use Carbon\Carbon;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function create()
    {
        return view('publicacion'); // Asegúrate de que esta vista exista
    }

    // Agrega el método guardarPublicacion aquí también
    public function guardarPublicacion(Request $req)
    {
        $req->validate([
            'titulo' => 'required|string|max:255',
            'comentarios' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opcional, debe ser imagen y no superar 2MB
        ]);

        $idUsuario = auth()->id(); // Obtiene el ID del usuario autenticado

        $fotoPath = null;
        if ($req->hasFile('foto') && $req->file('foto')->isValid()) {
            $fotoPath = $req->file('foto')->store('profile_photos', 'public');
        }

        DB::table('tb_publicaciones')->insert([
            'titulo' => $req->input('titulo'),
            'id_usuario' => $idUsuario,
            'comentario' => $req->input('comentarios'),
            'foto_publi' => $fotoPath,
            'fecha' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect('/publicar')->with('confirmacion', 'Tu publicación se guardó en la base de datos');
    }

    public function update(Request $req, string $id)
    {
        $req->validate([
            'txtTitulo' => 'required|string|max:255',
            'txtComentario' => 'required|string',
            'foto_publi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = [
            'titulo' => $req->input('txtTitulo'),
            'comentario' => $req->input('txtComentario'),
            'updated_at' => Carbon::now(),
        ];
    
        if ($req->hasFile('foto_publi')) {
            $file = $req->file('foto_publi');
            $path = $file->store('public/publicaciones'); // Guarda la imagen en storage/app/public/publicaciones
            $data['foto_publi'] = basename($path); // Guarda solo el nombre del archivo
    
            // Opcional: Eliminar la imagen anterior
            $publicacion = DB::table('tb_publicaciones')->where('id', $id)->first();
            if ($publicacion->foto_publi) {
                Storage::delete('public/publicaciones/' . $publicacion->foto_publi);
            }
        }
    
        DB::table('tb_publicaciones')->where('id', $id)->update($data);
    
        return redirect('/home')->with('confirmacion', 'Publicación editada correctamente');
    }

    public function eliminarpublicacion(Request $req, string $id)
    {
        DB::table('tb_publicaciones')->where('id', $id)->delete();

        return redirect('/home')->with('confirmacion', 'Publicación eliminada correctamente');
    }
}

