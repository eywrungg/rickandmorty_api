<?php

namespace App\Services;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class RickAndMortyApiService
{
    private string $baseUrl = 'https://rickandmortyapi.com/api';

    public function getStats(): array
    {
        return Cache::remember('rm.stats', now()->addHour(), function () {
            $responses = Http::pool(fn (Pool $pool) => [
                $pool->as('characters')->get($this->baseUrl . '/character'),
                $pool->as('locations')->get($this->baseUrl . '/location'),
                $pool->as('episodes')->get($this->baseUrl . '/episode'),
            ]);

            return [
                'characters' => data_get($responses['characters']?->json(), 'info.count', 0),
                'locations' => data_get($responses['locations']?->json(), 'info.count', 0),
                'episodes' => data_get($responses['episodes']?->json(), 'info.count', 0),
            ];
        });
    }

    public function getCharacterPage(int $page = 1, ?string $name = null): ?array
    {
        $cacheKey = 'rm.characters.page.' . $page . '.' . md5($name ?? '');

        return Cache::remember($cacheKey, now()->addHour(), function () use ($page, $name) {
            $query = ['page' => $page];

            if ($name) {
                $query['name'] = $name;
            }

            $response = Http::get($this->baseUrl . '/character', $query);

            return $response->successful() ? $response->json() : null;
        });
    }

    public function getCharacter(int $id): ?array
    {
        return Cache::remember('rm.character.' . $id, now()->addDay(), function () use ($id) {
            $response = Http::get($this->baseUrl . "/character/{$id}");

            return $response->successful() ? $response->json() : null;
        });
    }

    public function getCharactersByIds(array $ids): array
    {
        $ids = collect($ids)
            ->filter(fn ($id) => is_numeric($id))
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values()
            ->all();

        if ($ids === []) {
            return [];
        }

        $cacheKey = 'rm.characters.batch.' . implode('.', $ids);

        return Cache::remember($cacheKey, now()->addHour(), function () use ($ids) {
            $response = Http::get($this->baseUrl . '/character/' . implode(',', $ids));

            if (! $response->successful()) {
                return [];
            }

            return $this->normalizeList($response->json());
        });
    }

    public function getEpisode(int $id): ?array
    {
        return Cache::remember('rm.episode.' . $id, now()->addDay(), function () use ($id) {
            $response = Http::get($this->baseUrl . "/episode/{$id}");

            return $response->successful() ? $response->json() : null;
        });
    }

    public function getAllEpisodes(): array
    {
        return Cache::remember('rm.episodes.all', now()->addHour(), function () {
            $episodes = [];
            $url = $this->baseUrl . '/episode';

            do {
                $response = Http::get($url);

                if ($response->failed()) {
                    break;
                }

                $data = $response->json();
                $episodes = array_merge($episodes, $data['results'] ?? []);
                $url = data_get($data, 'info.next');
            } while ($url);

            return $episodes;
        });
    }

    public function getCharactersFromUrls(array $urls): array
    {
        $ids = collect($urls)
            ->map(fn ($url) => (int) basename($url))
            ->filter()
            ->values()
            ->all();

        return $this->getCharactersByIds($ids);
    }

    private function normalizeList(mixed $payload): array
    {
        if (! is_array($payload)) {
            return [];
        }

        if (array_is_list($payload)) {
            return $payload;
        }

        return [$payload];
    }
}
