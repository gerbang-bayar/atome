<?php

namespace GerbangBayar\Atome\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetPayment extends Request
{
    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::GET;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/payments/' . $this->referenceId;
    }

    public function __construct(
        protected string $referenceId,
    ) {
    }
}
