<?php

declare(strict_types=1);

namespace Modules\Ticket\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;

use function Safe\json_decode;

use Webmozart\Assert\Assert;

trait JiraHelper
{
    public function connectToJira(string $host, string $username, string $token): ?Client
    {
        return new Client([
            'base_uri' => $host,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic '.base64_encode($username.':'.$token),
            ],
        ]);
    }

    public function getJiraProjects(Client $client): ?array
    {
        try {
            $response = $client->get('/rest/api/2/project');

            Assert::isArray($res = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR));

            return $res;
        } catch (GuzzleException $guzzleException) {
            Log::error($guzzleException->getTraceAsString());

            return null;
        }
    }

    public function getJiraTicketsByProject(Client $client, array $projectKeys): ?array
    {
        try {
            $formatIssues = static function ($issues): array {
                $results = [];
                foreach ($issues as $issue) {
                    $results[] = [
                        'code' => $issue->key,
                        'name' => $issue->fields->summary,
                        'data' => $issue,
                    ];
                }

                return $results;
            };
            $results = [];
            foreach ($projectKeys as $projectKey) {
                $response = $client->get('/rest/api/2/search?jql=project='.$projectKey);
                // $data = json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
                $data = json_decode($response->getBody()->getContents(), true);
                $results[$projectKey] = [
                    'total' => $data['total'],
                    'issues' => $formatIssues($data['issues']),
                ];
            }

            return $results;
        } catch (GuzzleException $guzzleException) {
            Log::error($guzzleException->getTraceAsString());

            return null;
        }
    }

    public function getJiraTicketDetails(string $host, string $username, string $token, string $url): mixed
    {
        try {
            Assert::notNull($client = $this->connectToJira($host, $username, $token));
            $url = explode('/', $url);
            $response = $client->get('/rest/api/2/issue/'.$url[\count($url) - 1]);

            return json_decode($response->getBody()->getContents(), false, 512, JSON_THROW_ON_ERROR);
        } catch (GuzzleException $guzzleException) {
            Log::error($guzzleException->getTraceAsString());

            return null;
        }
    }
}
