<?php

namespace AlexLimon404\TgInfoBugs;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class TgInfoBugs
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getConfig(string $key, string $default = null)
    {
        return Arr::get($this->config, $key, $default);
    }

    public function client(): PendingRequest
    {
        return Http::timeout(5)
            ->withToken($this->getConfig('api_token'))
            ->baseUrl($this->getConfig('api_url'));
    }

    public function ping()
    {
        return $this->client()->get('ping');
    }

    public function messages(string $message, $channels = [])
    {
        if (count($channels) === 0) {
            if ($this->getConfig('channels')) {
                $channels = explode(',', $this->getConfig('channels') ?? '');
            }
        }

        $data = array_merge(compact('message'), compact('channels'));

        $response = $this->client()->acceptJson()->post('messages', $data);

        $response->throw();

        return $response->json();
    }

    public function render(\Throwable $throwable)
    {
        $message = $throwable->getMessage();
        $trace = $throwable->getTrace();

        $result = "Message: {$message}" . PHP_EOL
            . "Trace {$trace[0]}";

        return $this->messages($result);
    }
}
