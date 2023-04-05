<?php

namespace Scrabble\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Scrabble\Models\Filters\Dashboard\HighestLowestScoreModifier;
use Scrabble\Models\Filters\Member\LimitedLeadersQueryModifire;
use Scrabble\Repositories\GameRepository;
use Scrabble\Repositories\MemberRepository;

class ApiDashboardController extends Controller
{
    public function __construct(
        private readonly MemberRepository $memberRepository,
        private readonly GameRepository $gameRepository,
    ) {

    }

    public function leadersTable(Request $request): JsonResponse
    {
        $filter = new LimitedLeadersQueryModifire();
        $filter->setLimit($request->get('limit', 10));

        return response()->json(
            [
                'data' => $this->memberRepository->findAll(queryModifier: $filter),
            ]
        );
    }

    public function gamesStatistic(): JsonResponse
    {
        $filter = new HighestLowestScoreModifier();
        return response()->json(
            [
                'data' => $this->gameRepository->findAll(queryModifier: $filter),
            ]
        );
    }
}
