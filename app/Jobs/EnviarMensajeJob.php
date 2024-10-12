<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use libphonenumber\PhoneNumberUtil;
use Illuminate\Support\Facades\Http;
use Exception;

class EnviarMensajeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $telefono;
    protected $mensaje;
    protected $archivoAdjunto;
    protected $nombreArchivo;
    protected $tokenTexto; // Token para mensajes de texto
    protected $tokenArchivo; // Token para archivos
    protected $urlTexto;
    protected $urlArchivo;
    protected $defaultRegion;

    public function __construct($telefono, $mensaje, $archivoAdjunto, $nombreArchivo, $tokenTexto, $tokenArchivo, $urlTexto, $urlArchivo, $defaultRegion)
    {
        $this->telefono = $telefono;
        $this->mensaje = $mensaje;
        $this->archivoAdjunto = $archivoAdjunto;
        $this->nombreArchivo = $nombreArchivo;
        $this->tokenTexto = $tokenTexto; // Cambiar
        $this->tokenArchivo = $tokenArchivo; // Cambiar
        $this->urlTexto = $urlTexto;
        $this->urlArchivo = $urlArchivo;
        $this->defaultRegion = $defaultRegion;
    }

    public function handle()
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $formattedNumber = '';

        try {
            if (!preg_match('/^\+?\d+$/', $this->telefono)) {
                $this->telefono = '+' . $this->telefono; 
            }

            $phoneNumber = $phoneUtil->parse($this->telefono, $this->defaultRegion);

            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                throw new Exception('Número no válido');
            }

            $formattedNumber = $phoneUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);

            // Enviar archivo si está adjunto
            if ($this->archivoAdjunto) {
                $responseArchivo = Http::withHeaders([
                    'Authorization' => "Bearer $this->tokenArchivo",
                    'Content-Type' => 'application/json',
                ])->post($this->urlArchivo, [
                    'number' => $formattedNumber,
                    'message' => $this->mensaje,
                    'file' => $this->archivoAdjunto,
                    'filename' => $this->nombreArchivo,
                ]);

                if ($responseArchivo->failed()) {
                    throw new Exception('Error en la API de archivo: ' . $responseArchivo->body());
                }
            } else {
                // Solo enviar mensaje de texto si no hay archivo adjunto
                $responseTexto = Http::withHeaders([
                    'Authorization' => "Bearer $this->tokenTexto", // Cambiar
                    'Content-Type' => 'application/json'
                ])->post($this->urlTexto, [
                    'number' => $formattedNumber,
                    'message' => $this->mensaje,
                ]);

                if ($responseTexto->failed()) {
                    throw new Exception('Error en la API de texto: ' . $responseTexto->body());
                }
            }

        } catch (Exception $e) {
            // Manejar el error según tu lógica (por ejemplo, registrar el error o reintentar)
        }
    }
}
