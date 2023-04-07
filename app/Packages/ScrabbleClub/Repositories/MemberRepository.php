<?php

namespace Scrabble\Repositories;

use App\Core\Database\Model\Paginator;
use App\Core\Database\QueryModifierInterface;
use Scrabble\Models\Contact;
use Scrabble\Models\Member\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Scrabble\Services\Contact\ContactDto;

/**
 * @method Member findById(int $id, ?array $relations = [])
 * @method Collection|Member[] findAll(?Paginator $paginator = null, ?array $relations = [], ?QueryModifierInterface $queryModifier = null)
 * @method Collection|Member[] findAllPaginated(Paginator $paginator, ?array $relations = [], ?QueryModifierInterface $queryModifier = null)
 * @method Member|null findByFieldOrNull(string $fieldName, mixed $value, ?array $relations = [])
 * @method Member store(Member $member)
 * @method Member delete(Model $member)
 */
class MemberRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Member::class);
    }

    /**
     * @param Member $member
     * @param Collection<ContactDto> $contacts
     */
    public function addContacts(Member $member, Collection $contacts): void
    {
        if ($contacts->isEmpty()) {
            return;
        }

        $newContacts = $contacts->map(function (ContactDto $contactDto) {
            return new Contact($contactDto->toArray());
        });

        $member->contacts()->saveMany($newContacts);
    }
}
