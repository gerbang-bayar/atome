<?php

namespace GerbangBayar\Atome\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class RefundPayment extends Request implements HasBody
{
    use HasJsonBody;

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
        return "/payments/{$this->referenceId}/refund";
    }

    public function __construct(
        protected string $referenceId,
        protected int $amount,
        protected ?string $refundId = null,
    ) {
    }

    protected function defaultBody(): array
    {
        $body = [
            'refundAmount' => $this->amount,
        ];

        if ($this->refundId) {
            $body += ['refundId' => $this->refundId];
        }

        return $body;
    }
}
