<?php

declare(strict_types=1);

namespace ZerosDev\LinkQu;

use Exception;
use Closure;
use ZerosDev\LinkQu\Exceptions\SendableException;

class Transfer extends Base
{
    /**
     * HTTP Requestor client.
     *
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Inquiry/account number validity check.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function inquiry(Closure $closure)
    {
        $closure($this);
		

        $params = [
            'username'      => $this->client->username(),
            'pin'           => $this->client->pin(),
            'bankcode'      => $this->bankCode(),
            'accountnumber' => $this->accountNumber(),
            'amount'        => $this->amount(),
            'partner_reff'  => $this->partnerRef()
        ];
		 

        return $this->client->post('linkqu-partner/transaction/withdraw/inquiry', $params);
    }

    /**
     * Transfer to bank account number.
     * Make an inquiry before processing to ensure the destination account is valid.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function send(Closure $closure)
    {
        $closure($this);

        $params = [
            'username'      => $this->client->username(),
            'pin'           => $this->client->pin(),
            'bankcode'      => $this->bankCode(),
            'accountnumber' => $this->accountNumber(),
            'amount'        => $this->amount(),
            'partner_reff'  => $this->partnerRef(),
            'inquiry_reff'  => $this->inquiryRef()
        ];

        return $this->client->post('linkqu-partner/transaction/withdraw/payment', $params);
    }

    /**
     * Transfer to bank account number without inquiry process.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function queue(Closure $closure)
    {
        $closure($this);

        $params = [
            'username'      => $this->client->username(),
            'pin'           => $this->client->pin(),
            'bankcode'      => $this->bankCode(),
            'accountnumber' => $this->accountNumber(),
            'amount'        => $this->amount(),
            'partner_reff'  => $this->partnerRef(),
        ];

        return $this->client->post('linkqu-partner/transaction/withdraw/payment/queue', $params);
    }

    /**
     * Inquiry/account number validity check for e-Wallet/e-Money.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function inquiryEmoney(Closure $closure)
    {
        $closure($this);

        $params = [
            'username'      => $this->client->username(),
            'pin'           => $this->client->pin(),
            'bankcode'      => $this->bankCode(),
            'accountnumber' => $this->accountNumber(),
            'amount'        => $this->amount(),
            'partner_reff'  => $this->partnerRef(),
        ];

        return $this->client->post('linkqu-partner/transaction/reload/inquiry', $params);
    }

    /**
     * Transfer to e-Wallet/e-Money.
     * Make an inquiry before processing to ensure the destination account is valid.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function sendEmoney(Closure $closure)
    {
        $closure($this);

        $params = [
            'username'      => $this->client->username(),
            'pin'           => $this->client->pin(),
            'bankcode'      => $this->bankCode(),
            'accountnumber' => $this->accountNumber(),
            'amount'        => $this->amount(),
            'partner_reff'  => $this->partnerRef(),
            'inquiry_reff'  => $this->inquiryRef()
        ];

        return $this->client->post('linkqu-partner/transaction/reload/payment', $params);
    }

    /**
     * Transfer to bank account number without inquiry process.
     *
     * @param Closure $closure
     *
     * @return \stdClass|false
     */
    public function queueEmoney(Closure $closure)
    {
        $closure($this);

        $params = [
            'username'      => $this->client->username(),
            'pin'           => $this->client->pin(),
            'bankcode'      => $this->bankCode(),
            'accountnumber' => $this->accountNumber(),
            'amount'        => $this->amount(),
            'partner_reff'  => $this->partnerRef(),
        ];

        return $this->client->post('linkqu-partner/transaction/reload/payment/queue', $params);
    }
}
