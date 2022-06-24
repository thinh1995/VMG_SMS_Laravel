<?php

namespace Lucifer293\VmgSmsLaravel;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class VMG
{
    /** @var Client */
    private $client;

    /** @var int */
    private $timeout;

    /** @var string */
    private $uri;

    /** @var array */
    private $headers;

    /** @var int */
    private $serviceId;

    /** @var int */
    private $retries;

    public function __construct(string $uri, int $timeout = 300, array $headers = [])
    {
        $this->uri = $uri;
        $this->timeout = $timeout;
        $this->headers = $headers;
        $this->retries = 1;

        $this->client = new Client([
            'base_uri' => $this->getUri(),
            'timeout' => $this->getTimeout(),
            'headers' => $this->getHeaders(),
            'verify' => false,
        ]);
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return int
     */
    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    /**
     * @param int $serviceId
     */
    public function setServiceId(int $serviceId): void
    {
        $this->serviceId = $serviceId;
    }

    /**
     * @return int
     */
    public function getRetries(): int
    {
        return $this->retries;
    }

    /**
     * @param array $headers
     */
    public function setHeader(array $headers)
    {
        $this->headers = $headers;
        $this->client = new Client([
            'base_uri' => $this->getUri(),
            'timeout' => $this->getTimeout(),
            'headers' => $this->getHeaders(),
        ]);
    }

    /**
     * @param string $token
     * @return void
     */
    public function setToken(string $token)
    {
        $this->setHeader(['token' => $token]);
    }

    public function sendSMS(string $token, array $data)
    {
        try {
            $this->setToken($token);

            $response = $this->getClient()->put('/SMSBrandname/SendSMS', [
                RequestOptions::JSON => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $exception) {
            return ['message' => $exception->getMessage()];
        }
    }
}
