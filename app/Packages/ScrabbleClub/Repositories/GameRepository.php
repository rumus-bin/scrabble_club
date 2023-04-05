<?php

namespace Scrabble\Repositories;

use App\Core\Database\Model\Paginator;
use App\Core\Database\QueryModifierInterface;
use Scrabble\Models\Game;

/**
 * @method Game findById(int $id, ?array $relations = [])
 * @method Game[] findAll(?Paginator $paginator = null, ?array $relations = [], ?QueryModifierInterface $queryModifier = null)
 * @method Game[] findAllPaginated(Paginator $paginator, ?array $relations = [], ?QueryModifierInterface $queryModifier = null)
 * @method Game|null findByFieldOrNull(string $fieldName, mixed $value, ?array $relations = [])
 * @method Game store(Game $game)
 * @method Game delete(Game $game)
 */
class GameRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Game::class);
    }
}
