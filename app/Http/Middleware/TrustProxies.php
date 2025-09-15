<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class TrustProxies extends Middleware
{
    protected $proxies = '*'; // Percaya semua proxy (atau bisa IP tertentu)

    protected $headers = 
    SymfonyRequest::HEADER_X_FORWARDED_FOR |
    SymfonyRequest::HEADER_X_FORWARDED_HOST |
    SymfonyRequest::HEADER_X_FORWARDED_PORT |
    SymfonyRequest::HEADER_X_FORWARDED_PROTO;

}
