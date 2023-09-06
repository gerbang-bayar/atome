<?php

namespace GerbangBayar\Atome;


use GerbangBayar\Atome\Requests\CancelPayment;
use GerbangBayar\Atome\Requests\CheckConfiguration;
use GerbangBayar\Atome\Requests\CreatePayment;
use GerbangBayar\Atome\Requests\GetPayment;
use GerbangBayar\Atome\Requests\RefundPayment;
use GerbangBayar\Support\Contracts\ConnectorInterface;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AcceptsJson;

class Atome extends Connector implements ConnectorInterface
{
    use AcceptsJson;

    public function __construct(
        protected string $username,
        protected string $password,
        protected bool $sandbox = false,
    ) {
        $this->withBasicAuth($this->username, $this->password);
    }

    /**
     * The Base URL of the API
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return $this->sandbox === true ?
            'https://api.apaylater.net/v2'
            : 'https://api.apaylater.com/v2';
    }

    /**
     * Default headers for every request
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Default HTTP client options
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [];
    }

    public function createPayment(array $args): Response
    {
        return $this->send(new CreatePayment(...$args));
    }

    public function checkConfiguration(string $countryCode, ?string $callbackUrl = null): Response
    {
        $request = new CheckConfiguration(countryCode: $countryCode, callbackUrl: $callbackUrl);

        return $this->send($request);
    }

    public function getPayment(string $referenceId): Response
    {
        return $this->send(new GetPayment($referenceId));
    }

    public function cancelPayment(string $referenceId): Response
    {
        return $this->send(new CancelPayment($referenceId));
    }

    public function refundPayment(string $referenceId, int $amount, ?string $refundId = null): Response
    {
        return $this->send(new RefundPayment($referenceId, $amount, $refundId));
    }
}
