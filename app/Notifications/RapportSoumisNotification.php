<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RapportSoumisNotification extends Notification
{
    public $rapport;
    public $station;

    public function __construct($rapport, $station)
    {
        $this->rapport = $rapport;
        $this->station = $station;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // stocker en base + envoyer mail
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nouveau rapport soumis')
            ->greeting('Bonjour !')
            ->line("La station {$this->station?->nom} a soumis un nouveau rapport.")
            ->action('Voir le rapport', url('/admin/dashboard')) // mettre le vrai url
            ->line('Merci de votre collaboration.');
    }

    public function toArray($notifiable)
    {
        return [
            'titre' => 'Nouveau rapport reçu',
            'station' => $this->station?->nom ?? 'Non défini',
            'rapport' => $this->rapport,
            'lien' => url('/admin/dashboard')
        ];
    }
}