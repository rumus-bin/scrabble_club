<?php

namespace Scrabble\Services\Game;

use Scrabble\Models\Game;
use Scrabble\Repositories\GameRepository;

class GameService
{
    public function __construct(
        private readonly GameRepository $gameRepository
    ) {
    }

    public function createNewGame(GameDto $gameDto): Game
    {
        $gameModel = new Game($gameDto->toArray());

        return $this->gameRepository->store($gameModel);
    }

    public function updateGame(GameDto $gameDto, int $id): Game
    {
        $game = $this->gameRepository->findById($id);
        $game->fill($gameDto->toArray());

        return $this->gameRepository->store($game);
    }

    public function deleteGame(int $id): void
    {
        $game = $this->gameRepository->findById($id);

        $this->gameRepository->delete($game);
    }

}
