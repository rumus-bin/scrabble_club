<?php

namespace Scrabble\Http\Controllers\Api;

use App\Core\Database\Model\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Scrabble\Http\Requests\Game\GameStoreRequest;
use Scrabble\Http\Requests\Game\GameUpdateRequest;
use Scrabble\Http\Resources\Game\GameCollection;
use Scrabble\Http\Resources\Game\GameJsonResource;
use Scrabble\Services\Game\GameService;
use Scrabble\Repositories\GameRepository;

class ApiGamesController extends Controller
{
    public function __construct(
        private readonly GameRepository $gameRepository,
        private readonly GameService $gameService
    ) {
    }

    public function index(): JsonResponse
    {
        try {
            return response()->json(new GameCollection($this->gameRepository->findAll()));
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            return response()->json(new GameJsonResource($this->gameRepository->findById($id)));
        } catch (\Exception $e) {
            return response()->json(
                [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function store(GameStoreRequest $newGameRequest): JsonResponse
    {
        DB::beginTransaction();
        try {
            $member = $this->gameService->createNewGame($newGameRequest->getDto());
            DB::commit();

            return response()->json(
                [
                    'code' => 201,
                    'data' => $member
                ]
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'code' => 500,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function update(GameUpdateRequest $gameUpdateRequest, int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $game = $this->gameService->updateGame($gameUpdateRequest->getDto(), $id);
            DB::commit();
            return response()->json($game);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'code' => 400,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    public function delete(int $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $this->gameService->deleteGame($id);
            DB::commit();
            return response()->json(status: 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'code' => 400,
                    'message' => $e->getMessage()
                ]
            );
        }
    }
}
