use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendWelcomeEmail;

protected $listen = [
    Registered::class => [
        SendEmailVerificationNotification::class,
        \App\Listeners\SendWelcomeEmail::class,
    ],
];
