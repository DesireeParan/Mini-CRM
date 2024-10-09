<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $user->last_login_at = now();
        $user->device = $this->getDevice();
        $user->browser = $this->getBrowser(Request::header('User-Agent'));
        $user->save();
    }

    /**
     * Get the device type.
     *
     * @return string
     */
    protected function getDevice()
    {
        $agent = new \Jenssegers\Agent\Agent();
        if ($agent->isDesktop()) {
            return 'Desktop';
        } elseif ($agent->isTablet()) {
            return 'Tablet';
        } elseif ($agent->isMobile()) {
            return 'Mobile';
        }

        return 'Unknown';
    }

    /**
     * Get the browser name from the user agent.
     *
     * @param  string  $userAgent
     * @return string
     */
    protected function getBrowser($userAgent)
    {
        if (strpos($userAgent, 'Firefox') !== false) {
            return 'Firefox';
        } elseif (strpos($userAgent, 'Chrome') !== false) {
            return 'Chrome';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            return 'Safari';
        } elseif (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) {
            return 'Internet Explorer';
        }

        return 'Other';
    }
}
