<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeComtroller extends Controller
{
    public function changeTheme(Request $request)
    {
        $theme = $request->input('theme');

        // Guardar el tema en la sesión o base de datos
        session(['theme' => $theme]);

        return response()->json(['success' => true]);
    }
}
