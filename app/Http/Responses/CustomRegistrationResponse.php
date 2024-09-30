<?php

namespace App\Http\Responses;

use Filament\Http\Responses\Auth\Contracts\RegistrationResponse;

class CustomRegistrationResponse implements RegistrationResponse
{
    protected $redirectUrl;

    public function __construct(string $redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return redirect()->to($this->redirectUrl);
    }
}
