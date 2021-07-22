<?php
namespace App\Repositories;

use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

interface SessionRepositoryInterface
{
    /**
	 * @param array $filters
	 * @return array
	 */
	public function all(array $filters): Collection;

    /**
	 * @param int $id
	 * @return JsonResponse
	 */
	public function show(int $id): JsonResponse;

    /**
	 * @return JsonResponse
	 */
	public function store(array $request): JsonResponse;

    /**
     * @param int $id
	 * @return JsonResponse
	 */
	public function update(int $id, array $request): JsonResponse;

    /**
     * @param int $id
	 * @return JsonResponse
	 */
	public function destroy(int $id): JsonResponse;
}