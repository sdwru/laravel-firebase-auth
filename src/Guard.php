<?php
namespace sdwru\LaravelFirebaseAuth;

use Kreait\Firebase\Auth;
use Firebase\Auth\Token\Exception\InvalidToken;

class Guard
{

    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    
    public function user($request)
    {
        $token = $request->bearerToken();
        try {
            
            $verifiedToken = $this->auth->verifyIdToken($token);
            return new User($verifiedToken->getClaims());
 
        } catch (\InvalidArgumentException $e) {
            //echo $e->getMessage();
            return;
 
        } catch (InvalidToken $e) {
            //echo 'The token is invalid: ' . $e->getMessage();
            return;
        }
    }
}
