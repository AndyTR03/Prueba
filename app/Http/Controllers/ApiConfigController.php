<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiConfigController extends Controller
{
    private $configFile = 'api_config_text.json'; // Archivo de configuración para mensajes de texto

    public function showForm(Request $request)
    {
        // Leer la configuración actual
        $config = json_decode(Storage::get($this->configFile), true);

        return view('api_config.form', ['config' => $config]);
    }

    public function handleRequest(Request $request)
    {
        if ($request->isMethod('post') && $request->input('action') === 'save') {
            return $this->saveConfig($request);
        } elseif ($request->isMethod('post') && $request->input('action') === 'restore') {
            return $this->restoreDefaults();
        }

        return $this->showForm($request);
    }

    private function saveConfig(Request $request)
    {
        $request->validate([
            'token' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        // Guardar la configuración
        $config = [
            'token' => $request->input('token'),
            'url' => $request->input('url'),
        ];

        Storage::put($this->configFile, json_encode($config));

        return redirect()->route('api.config')->with('success', 'Configuración guardada con éxito.');
    }

    private function restoreDefaults()
    {
        // Restaurar valores predeterminados
        $defaultConfig = [
            'token' => '8655aoLGyAXLt1EcaETHHOf2Rk1Ifj',
            'url' => 'https://andy.senati.buho.xyz/api/message/send-text',
        ];

        Storage::put($this->configFile, json_encode($defaultConfig));

        return redirect()->route('api.config')->with('success', 'Configuración restaurada a los valores predeterminados.');
    }
}
