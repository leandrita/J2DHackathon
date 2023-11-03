<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class SkinController extends Controller
{

    public function available()
    {
        $userId = request()->query('user_id');

        if ($userId) {
            $skins = Skin::where('user_id', $userId)->get();
        } else {
            $skins = Skin::all();
        }

        foreach ($skins as $skin) {
            $skin->image_url = asset('storage/' . $skin->image);
        }

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
            return response()->json(['error' => 'El skin no se encontró'], 404);
        }

        if ($skin->user_id !== null) {
            return response()->json(['error' => 'El skin ya ha sido comprado'], 422);
        }

        $user_id = $request->user()->id;
        $skin->user_id = $user_id;
        $skin->save();

        return response()->json(['message' => '¡Has comprado el skin con éxito!'], 200);
    }

    // public function store(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'type' => 'required|string',
    //         'price' => 'required',
    //         'color' => 'required|string',
    //         // 'image' => 'required', 
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     // $imagePath = $request->file('image')->store('images', 'public');

    //     // $imageUrl = asset('storage/' . $imagePath);

    //     $skin = new Skin();
    //     $skin->name = $request->name;
    //     $skin->type = $request->type;
    //     $skin->price = $request->price;
    //     $skin->color = $request->color;
    //     $skin->image = $request->image;

    //     $request->user()->Skin()->save($skin);

    //     $username = $skin->user->name;

    //     return response()->json([
    //         'id' => $skin->id,
    //         'user_id' => $skin->user_id,
    //         'username' => $username,
    //         // 'image_url' => $imageUrl,
    //         'message' => '¡Genial! Acabas de crear tu skin.'
    //     ], 201);
    // }

    public function myskins(Request $request)
    {
        $user_id = $request->user()->id;

        $myskins = Skin::where('user_id', $user_id)->get();

        return response()->json($myskins, 200);
    }


    // public function update(Request $request, $id)
    // {
    //     $user = $request->user();
    //     if (!$user) {
    //         return response()->json(['error' => 'Debes estar autenticado para actualizar un skin'], 401);
    //     }

    //     $skin = Skin::find($id);

    //     if (!$skin) {
    //         return response()->json(['error' => 'El skin no se encontró'], 404);
    //     }

    //     if ($skin->user_id !== $user->id) {
    //         return response()->json(['error' => 'No tienes permiso para actualizar este skin'], 403);
    //     }

    //     $rules = [
    //         'name' => 'required|string|max:255',
    //         'type' => 'required|string',
    //         'price' => 'required|string',
    //         'color' => 'required|string',
    //         // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         return response()->json(['errors' => $validator->errors()], 422);
    //     }

    //     $skin->fill($request->all());

    //     // if ($request->hasFile('image')) {
    //     //     $imagePath = $request->file('image')->store('images', 'public');

    //     //     if ($skin->image) {
    //     //         Storage::disk('public')->delete($skin->image);
    //     //     }

    //     //     $skin->image = $imagePath;
    //     // }

    //     $skin->save();

    //     return response()->json([
    //         'skin' => $skin,
    //         'message' => '¡Genial! Acabas de editar tu skin.'
    //     ], 200);
    // }

    public function color(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Debes estar autenticado para actualizar un skin'], 401);
        }

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

    //     public function destroy(Request $request, $id)
    //     {
    //         $user = $request->user();
    //         if (!$user) {
    //             return response()->json(['error' => 'Debes estar autenticado para eliminar un skin'], 401);
    //         }

    //         $skin = Skin::find($id);

    //         if (!$skin) {
    //             return response()->json(['error' => 'El skin no se encontró'], 404);
    //         }

    //         if ($skin->user_id !== $user->id) {
    //             return response()->json(['error' => 'No tienes permiso para eliminar este skin'], 403);
    //         }

    //         if ($skin->image) {
    //             Storage::disk('public')->delete($skin->image);
    //         }

    //         $skin->delete();

    //         return response()->json(['message' => 'Skin eliminado con éxito'], 200);
    //     }
    // }

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
            return response()->json(['error' => 'No tienes permiso para eliminar este skin'], 403);
        }

        $skin->user_id = null;
        $skin->save();

        return response()->json(['message' => 'Skin eliminado con éxito'], 200);
    }

    public function getskin(Request $request, $id)
    {
        // if (!$request->user()) {
        //     return response()->json(['error' => 'Debes estar autenticado para ver este skin'], 401);
        // }

        $skin = Skin::with(['user'])->find($id);

        if (!$skin) {
            return response()->json(['error' => 'El skin no se encontró'], 404);
        }

        // $username = $skin->user->name;

        // $imageUrl = asset('storage/' . $skin->image);

        // unset($skin->user);

        return response()->json([
            'skin' => $skin,
            // 'username' => $username,
            // 'image_url' => $imageUrl
        ]);
    }
}
