<?php
namespace app\components;

use app\dto\ExchangeRatesDto;
use RuntimeException;
use yii\base\Component;
use yii\httpclient\Client;
use yii\base\InvalidConfigException;

class OpenExchangeRatesClient extends Component
{
    public string $appId;
    private string $baseUrl = 'https://openexchangerates.org/api/';

    /**
     * @throws InvalidConfigException
     */
    public function init(): void
    {
        parent::init();
        if (!$this->appId) {
            throw new InvalidConfigException('API ключ (appId) обязателен.');
        }
    }

    public function fetchLatestRates(): ExchangeRatesDto
    {
        return $this->request('latest.json');
    }

    private function request(string $endpoint, array $params = []): ExchangeRatesDto
    {
        $client = new Client(['baseUrl' => $this->baseUrl]);
        $response = $client->get($endpoint, array_merge(['app_id' => $this->appId], $params))->send();

        if (!$response->isOk) {
            throw new RuntimeException('Ошибка запроса к API: ' . $response->content);
        }

        return new ExchangeRatesDto($response->data);
    }
}