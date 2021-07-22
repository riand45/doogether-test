<?php

namespace App\Repositories\Eloquent;

use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Repositories\SessionRepositoryInterface;

class SessionRepository extends BaseRepository implements SessionRepositoryInterface
{

   /**
    * SessionRepository constructor.
    *
    * @param Session $model
    */
   public function __construct(Session $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(array $filters): Collection
   {
        $results = DB::table('session as se')
        ->select([
                'se.ID',
                'se.UserID',
                'se.name',
                'se.description',
                'se.start',
                'se.duration',
                'se.created',
                'se.updated',
                'us.name as user_name',
                'us.email'
            ])
            ->join('user as us', function ($q) {
                $q->on('se.userID', '=', 'us.ID');
            })
        ->when(
            isset($filters['search']) && !is_null($filters['search']),
            function ($q) use ($filters) {
                $q->where(function ($query) use ($filters) {
                    $query->orWhere('se.name', 'like', "%{$filters['search']}%")
                        ->orWhere('se.duration', 'like', "%{$filters['search']}%")
                        ->orWhere('us.name', 'like', "%{$filters['search']}%");
                });
            }
        )
        ->paginate();

        if (isset($filters['sortKey']) && isset($filters['sortValue'])) {
            $results = collect($results);
            if (strtolower($filters['sortValue']) === 'desc') {
                $results = $results->sortByDesc($filters['sortKey'])->all();
            } else {
                $results = $results->sortBy($filters['sortKey'])->all();
            }
        }

        return collect($results);
   }

   /**
    * @return JsonResponse
    */
    public function show(int $id): JsonResponse
    {
        $result = Session::find($id);

       if (is_null($result)){
            return response()->json([
                'message' => 'Session not found',
            ], 404);
        }else {
            return response()->json([
                'message' => 'success',
                'data' => $result,

            ], 200);
        }
    }

    /**
    * @return JsonResponse
    */
    public function store($request): JsonResponse
    {
        $data = Session::create(array_merge($request, ['userID' => auth()->user()->ID]));

        return response()->json([
            'message' => 'success created',
            'data' => $data,

        ], 201);
    }

    /**
    * @param int $id
    * @return JsonResponse
    */
    public function update($id, $request): JsonResponse
    {
        $data = Session::find($id);

        if(is_null($data)) {
            return response()->json([
                'message' => 'Session not found',
            ], 404);
        }

        try{
            $data->update($request);
        } catch (\Exception $e) {
            throw new \Exception('Updated Failed.', 422);
        }

        return response()->json([
            'message' => 'success updated',
            'data' => $data,
        ], 200);
    }

    /**
    * @param int $id
    * @return JsonResponse
    */
    public function destroy($id): JsonResponse
    {
        $data = Session::find($id);

        if(is_null($data)) {
            return response()->json([
                'message' => 'Session not found',
            ], 404);
        }

        try{
            $data->delete();
        } catch (\Exception $e) {
            throw new \Exception('delete Failed.', 422);
        }

        return response()->json([
            'message' => 'success deleted',
        ], 200);
    }
}