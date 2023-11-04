<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SkinController extends Controller
{

    public function available()
    {
        $skins = Skin::all();

        return response()->json($skins);
    }

    public function buy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $skin = Skin::find($request->id);

        if (!$skin) {
            return response()->json(['error' => 'El skin no se encontró'], 400);
        }

        //el skin debe poder comprarse por varios usuarios, por lo tanto se debe crear una tabla nueva que debe contener el user_id y el skin_id (correspondiente al skin comprado por el user)
        if ($skin->user_id !== null) {
            return response()->json(['error' => 'El skin ya ha sido comprado'], 422);
        }

        $user_id = $request->user()->id;
        $skin->user_id = $user_id;
        $skin->save();

        return response()->json(['message' => '¡Has comprado el skin con éxito!'], 200);
    }

    public function myskins(Request $request)
    {
        $user_id = $request->user()->id;

        $myskins = Skin::where('user_id', $user_id)->get();

        return response()->json($myskins, 200);
    }

    public function color(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Debes estar autenticado para actualizar un skin'], 401);
        }

        //buscar el skin por id
        $skinName = $request->input('name');

        if (!$skinName) {
            return response()->json(['error' => 'Debes proporcionar el nombre del skin'], 422);
        }

        $skin = $user->skins()->where('name', $skinName)->first();

        if (!$skin) {
            return response()->json(['error' => 'El skin no se encontró'], 404);
        }

        $rules = [
            'color' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $skin->color = $request->color;

        $skin->save();

        return response()->json([
            'skin' => $skin,
            'message' => '¡Genial! Acabas de editar el color de tu skin.'
        ], 200);
    }

    public function delete($id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Debes estar autenticado para eliminar un skin'], 401);
        }

        $skin = Skin::find($id);

        if (!$skin) {
            return response()->json(['error' => 'El skin no se encontró'], 404);
        }

        if ($skin->user_id !== $user->id) {
            return response()->json(['error' => 'No tienes comprado este skin'], 400);
        }

        //la funcion debe eliminar la entrada correspondiente en la tabla 2
        $skin->user_id = null;
        $skin->save();

        return response()->json(['message' => 'Skin eliminado con éxito'], 200);
    }

    public function getskin($id)
    {
        $skin = Skin::find($id);

        if (!$skin) {
            return response()->json(['error' => 'El skin no se encontró'], 404);
        }

        return response()->json([
            'skin' => $skin,
        ]);
    }
}
