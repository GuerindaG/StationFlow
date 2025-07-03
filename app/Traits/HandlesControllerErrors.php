<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait HandlesControllerErrors
{
    /**
     * Gère les exceptions et retourne une réponse appropriée
     *
     * @param \Exception $e
     * @param string $redirectRoute
     * @param bool $withInput
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleException(\Exception $e, string $redirectRoute, bool $withInput = false)
    {
        // Journalisation de l'erreur
        Log::error($e->getMessage(), [
            'exception' => $e,
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]);

        // Message plus convivial pour l'utilisateur
        $userMessage = 'Une erreur est survenue. Veuillez réessayer.';
        
        if (config('app.debug')) {
            $userMessage .= ' Détails : ' . $e->getMessage();
        }

        // Préparation de la réponse
        $response = redirect()
            ->route($redirectRoute)
            ->with('error', $userMessage);

        // Ajout des anciennes entrées si nécessaire
        return $withInput ? $response->withInput() : $response;
    }

    /**
     * Gère les erreurs de validation
     *
     * @param \Illuminate\Validation\ValidationException $e
     * @param string $redirectRoute
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function handleValidationException(\Illuminate\Validation\ValidationException $e, string $redirectRoute)
    {
        return redirect()
            ->route($redirectRoute)
            ->withErrors($e->errors())
            ->withInput();
    }
}