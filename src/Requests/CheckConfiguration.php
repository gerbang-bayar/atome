<?php

namespace GerbangBayar\Atome\Requests;

use GerbangBayar\Support\Traits\RequestHelper;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CheckConfiguration extends Request implements HasBody
{
    use HasJsonBody, RequestHelper;

    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/auth';
    }

    public function __construct(
        public string $countryCode,
        public ?string $callbackUrl = null,
    ) {
    }

    protected function defaultBody(): array
    {
        return $this->constructorPropertiesAsBody();
    }
}
