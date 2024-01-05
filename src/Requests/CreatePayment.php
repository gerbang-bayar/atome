<?php

namespace GerbangBayar\Atome\Requests;

use GerbangBayar\Support\Traits\RequestHelper;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class CreatePayment extends Request implements HasBody
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
        return '/payments';
    }

    public function __construct(
        public string $referenceId,
        public string $currency,
        public int $amount,
        public string $callbackUrl,
        public string $paymentResultUrl,
        public array $items,
        public array $customerInfo,
        public array $shippingAddress,
        public int $expirationTime = 43200, // default is 12 hours
        public ?string $paymentCancelUrl = null,
        public ?string $merchantReferenceId = null,
        public ?array $billingAddress = null,
        public ?int $taxAmount = null,
        public ?int $shippingAmount = null,
        public ?int $originalAmount = null,
        public ?string $voucherCode = null,
        public ?array $additionalInfo = null,
    ) {
    }

    protected function defaultBody(): array
    {
        return $this->constructorPropertiesAsBody();
    }
}
