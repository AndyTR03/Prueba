<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use libphonenumber\PhoneNumberUtil;
use Exception;
use Illuminate\Support\Facades\Http;

class EnviarMensajeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $telefono;
    protected $mensaje;
    protected $token;
    protected $url;
    protected $defaultRegion;

    public function __construct($telefono, $mensaje, $token, $url, $defaultRegion)
    {
        $this->telefono = $telefono;
        $this->mensaje = $mensaje;
        $this->token = $token;
        $this->url = $url;
        $this->defaultRegion = $defaultRegion;
    }

    public function handle()
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            if (!preg_match('/^\+?\d+$/', $this->telefono)) {
                $this->telefono = '+51' . $this->telefono; // Ajusta el código de país según corresponda
            }

            $phoneNumber = $phoneUtil->parse($this->telefono, $this->defaultRegion);

            if (!$phoneUtil->isValidNumber($phoneNumber)) {
                throw new Exception('Número no válido');
            }

            $formattedNumber = $phoneUtil->format($phoneNumber, \libphonenumber\PhoneNumberFormat::E164);

            $response = Http::withHeaders([
                'Authorization' => "Bearer {$this->token}",
                'Content-Type' => 'application/json',
            ])->post($this->url, [
                'number' => $formattedNumber,
                'message' => $this->mensaje,
            ]);

            if (!$response->successful()) {
                throw new Exception('Error en la API: ' . $response->body());
            }
        } catch (Exception $e) {
        }
    }
}
