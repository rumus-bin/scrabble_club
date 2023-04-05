<?php

namespace Scrabble\Http\Controllers\Api;

use App\Core\Database\Model\Paginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Scrabble\Http\Requests\Member\MemberStoreRequest;
use Scrabble\Http\Requests\Member\MemberManipulationRequest;
use Scrabble\Http\Resources\Member\MemberJsonResource;
use Scrabble\Http\Resources\Member\MemberProfileJsonResource;
use Scrabble\Models\Filters\Member\MemberProfileQueryFilter;
use Scrabble\Models\Filters\Member\MemberQueryModifire;
use Scrabble\Services\Member\MemberService;
use Scrabble\Repositories\MemberRepository;

class ApiMemberController extends Controller
{
        public function __construct(
            private readonly MemberRepository $memberRepository,
            private readonly MemberService $memberService
        ) {
        }

        public function index(Request $request): JsonResponse
        {
            return response()
                ->json(
                $this->memberRepository->findAllPaginated(
                    new Paginator(
                        (int) $request->get('page', 1),
                        (int) $request->get('per_page', 10)
                    )
                )
            );
        }

        public function show(int $id): JsonResponse
        {
            $queryFilter = new MemberProfileQueryFilter();
            $queryFilter->setMemberId($id);
            $member = $this->memberRepository->firstOrFail(['contacts'], $queryFilter);

            return response()->json(new MemberProfileJsonResource($member));
        }

        public function edit(int $id): JsonResponse
        {
            $queryFilter = new MemberQueryModifire();
            $queryFilter->setMemberId($id);
            $member = $this->memberRepository->firstOrFail(['contacts'], $queryFilter);

            return response()->json(new MemberJsonResource($member));
        }

        public function store(MemberStoreRequest $request): JsonResponse
        {
            $member = $this->memberService->createNew($request->getDto());
            return response()->json($member, 201);
        }

        public function update(MemberManipulationRequest $request, int $id): JsonResponse
        {
            $member = $this->memberService->updateById($request->getDto(), $id);
            return response()->json($member);
        }

        /**
        * @param int $id
        * @return JsonResponse
        */
        public function delete(int $id): JsonResponse
        {
            $this->memberService->deleteById($id);

            return response()->json(null, 204);
        }

}
