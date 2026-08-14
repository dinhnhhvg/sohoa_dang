<?php

namespace App\Libraries;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class BunnyLibrary
{
    protected string $apiUrl;
    protected string $apiKey;
    protected string $libraryId;

    public function __construct()
    {
        $this->apiUrl = env('BUNNY_API_URL');
        $this->apiKey = env('BUNNY_API_KEY');
        $this->libraryId = env('BUNNY_LIBRARY_ID');
    }

    public function get(): array
    {
        $response = Http::withHeaders(['AccessKey' => $this->apiKey,])
            ->get("{$this->apiUrl}/{$this->libraryId}/videos");

        if ($response->successful()) {
            return $response->json();
        }
        return [];
    }

    public function findById(string $videoId): array
    {
        $response = Http::withHeaders(['AccessKey' => $this->apiKey,])
            ->get("{$this->apiUrl}/{$this->libraryId}/videos/{$videoId}");

        if ($response->successful()) {
            return $response->json();
        }
        return [];
    }

    public function upload(UploadedFile $file): ?string
    {
        $response = Http::withHeaders(['AccessKey' => $this->apiKey,])
            ->attach('file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post("{$this->apiUrl}/{$this->libraryId}/videos");

        if (!$response->successful()) {
            return false;
        }
        $data = $response->json();
        return $data['guid'];
    }

    public function deleteById(string $videoId): bool
    {
        $response = Http::withHeaders(['AccessKey' => $this->apiKey,])
            ->delete("{$this->apiUrl}/{$this->libraryId}/videos/{$videoId}");

        return $response->successful();
    }
}
