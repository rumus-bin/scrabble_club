<?php

namespace Scrabble\Repositories;

use App\Core\Database\Model\Paginator;
use App\Core\Database\QueryModifierInterface;
use Illuminate\Support\Collection;
use Scrabble\Models\Contact;

/**
 * @method Contact findById(int $id, ?array $relations = [])
 * @method Collection|Contact[] findAll(?array $relations = [])
 * @method Collection|Contact[] findAllPaginated(Paginator $paginator, ?array $relations = [], ?QueryModifierInterface $queryModifier = null)
 * @method Contact|null findByFieldOrNull(string $fieldName, mixed $value, ?array $relations = [])
 * @method Contact store(Contact $contact)
 * @method Contact delete(Contact $contact)
 */
class ContactRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Contact::class);
    }
}
