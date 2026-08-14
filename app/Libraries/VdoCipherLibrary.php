<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\UploadedFile;

class VdoCipherLibrary
{
    protected string $apiSecret;
    protected string $apiUrl;
    protected string $firstName;

    public function __construct()
    {
        $this->apiSecret = env('VDOCIPHER_API_SECRET');
        $this->apiUrl = env('VDOCIPHER_API_URL');
        $this->firstName = env('VDOCIPHER_FIRST_NAME');
    }

    public function get(): array
    {
        $response = Http::withHeaders(['Authorization' => "Apisecret " . $this->apiSecret, 'Accept' => 'application/json',])
            ->get($this->apiUrl);

        if ($response->successful()) {
            return $response->json();
        }
        return [];
    }

    public function findById(string $videoId): array
    {
        $response = Http::withHeaders(['Authorization' => "Apisecret " . $this->apiSecret, 'Accept' => 'application/json',])
            ->get("{$this->apiUrl}/{$videoId}");

        if ($response->successful()) {
            return $response->json();
        }
        return [];
    }

    public function upload(UploadedFile $file): ?string
    {
        $response = Http::withHeaders(['Authorization' => 'Apisecret ' . $this->apiSecret, 'Accept' => 'application/json',])
            ->post($this->apiUrl, ['title' => $this->firstName.date('YmdHis')]);

        if (!$response->successful()) {
            return false;
        }

        $data = $response->json();
        $uploadLink = $data['uploadLink'] ?? null;
        $videoId = $data['videoId'] ?? null;
        if (!$uploadLink || !$videoId) {
            return false;
        }

        $uploadResponse = Http::withOptions(['verify' => false])
            ->attach('file', file_get_contents($file->getPathName()), $file->getClientOriginalName())
            ->post($uploadLink);

        if (!$uploadResponse->successful()) {
            return false;
        }
        return $videoId;
    }

    public function deleteById(string $videoId): bool
    {
        $response = Http::withHeaders(['Authorization' => 'Apisecret ' . $this->apiSecret, 'Accept' => 'application/json',])
            ->delete("{$this->apiUrl}/{$videoId}");
        return $response->successful();
    }

    public function playById(string $videoId): array
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders(['Authorization' => 'Apisecret ' . $this->apiSecret, 'Content-Type' => 'application/json',])
            ->post("$this->apiUrl/$videoId/otp", ['ttl' => 300,]);

        if ($response->successful()) {
            return $response->json();
        }
        return [];
    }
}
