<?php

namespace App\Extensions;

use Illuminate\Session\DatabaseSessionHandler as BaseDatabaseSessionHandler;

class DatabaseSessionHandler extends BaseDatabaseSessionHandler
{
    protected function performInsert($sessionId, $payload)
    {
        // if we're not in the portal domain and we're trying to create a session, we redirect to the portal
        // that way, we are preventing all domains except the portal from creating sessions
        
        if (request()->getHost() != config('app.portal_domain')) {
            // assuming the portal's route is in the same app
            return redirect()->route('session', ['origin' => request()->fullUrl()])->send();
        }
      
        parent::performInsert($sessionId, $payload);
    }
}