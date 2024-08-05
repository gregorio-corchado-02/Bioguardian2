<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function show()
    {
        $userId = Auth::id(); // Obtén el ID del usuario autenticado

        // Obtén los datos del usuario desde la base de datos
        $user = DB::table('users')->where('id', $userId)->first();

        return view('perfil', ['user' => $user]); // Pasa el usuario a la vista
    }

    public function update(Request $request, string $id)
    {
        // Validar la solicitud
        $request->validate([
            'txtTitulo' => 'required|string|max:255',
            'txtComentario' => 'required|string|max:500',
            'foto_publi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $publicacion = DB::table('tb_publicaciones')->where('id', $id)->first();

        // Verificar si el usuario es el autor de la publicación o un admin
        if (Auth::user()->id !== $publicacion->id_usuario && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'No tienes permiso para editar esta publicación.');
        }

        $data = [
            'titulo' => $request->input('txtTitulo'),
            'comentario' => $request->input('txtComentario'),
            'updated_at' => Carbon::now(),
        ];

        // Manejar la carga de la imagen si está presente
        if ($request->hasFile('foto_publi')) {
            $path = $request->file('foto_publi')->store('publicaciones', 'public');
            $data['foto_publi'] = $path;
        }

        // Actualizar la publicación en la base de datos
        DB::table('tb_publicaciones')->where('id', $id)->update($data);

        // Redirigir con un mensaje de confirmación
        return redirect()->back()->with('confirmacion', 'Publicación editada correctamente');
    }

    public function destroy(Request $request, $id)
    {
        $publicacion = DB::table('tb_publicaciones')->where('id', $id)->first();

        // Verificar si el usuario es el autor de la publicación o un admin
        if (Auth::user()->id !== $publicacion->id_usuario && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar esta publicación.');
        }

        // Eliminar la publicación
        DB::table('tb_publicaciones')->where('id', $id)->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('confirmacion', 'Publicación eliminada correctamente.');
    }
}
