<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PurchasedSkin;
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

        $user_id = $request->user()->id;
        $skin_id = $request->id;

        $purchasedSkin = PurchasedSkin::where('user_id', $user_id)
            ->where('skin_id', $skin_id)
            ->first();

        if ($purchasedSkin) {
            return response()->json(['error' => 'Ya has comprado este skin previamente'], 422);
        }

        $skin = Skin::find($request->id);

        if (!$skin) {
            return response()->json(['error' => 'El skin no se encontró'], 400);
        }

        $newPurchasedSkin = PurchasedSkin::create([
            'user_id' => $user_id,
            'skin_id' => $skin->id,
            'color' => $skin->color,
        ]);

        return response()->json([
            'message' => '¡Has comprado el skin con éxito!',
            'newPurchasedSkin' => $newPurchasedSkin
        ], 200);
    }

    public function myskins(Request $request)
    {
        $user_id = $request->user()->id;

        $skin_ids = PurchasedSkin::where('user_id', $user_id)->pluck('skin_id');

        $myskins = Skin::whereIn('id', $skin_ids)->get();

        return response()->json($myskins, 200);
    }

    public function color(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'Debes estar autenticado para cambiar el color de un skin'], 401);
        }

        $skinId = $request->input('id');

        if (!$skinId) {
            return response()->json(['error' => 'Debes proporcionar el ID del skin'], 422);
        }

        $purchasedSkin = $user->purchasedSkins()->where('skin_id', $skinId)->first();

        if (!$purchasedSkin) {
            return response()->json(['error' => 'El skin no se encontró en tus compras'], 404);
        }

        $rules = [
            'color' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $purchasedSkin->color = $request->color;
        $purchasedSkin->save();

        return response()->json([
            'skin' => $purchasedSkin,
            'message' => '¡Genial! Acabas de editar el color de tu skin.'
        ], 200);
    }

    public function delete($id)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Debes estar autenticado para eliminar un skin'], 401);
        }

        $purchasedSkin = $user->purchasedSkins()->where('skin_id', $id)->first();

        if (!$purchasedSkin) {
            return response()->json(['error' => 'El skin no se encontró'], 404);
        }

        $purchasedSkin->delete();

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
