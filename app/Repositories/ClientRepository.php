<?php

namespace App\Repositories;

use App\Mail\CreateNewClientMail;
use App\Models\Client;
use App\Models\Country;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ClientRepository
 *
 * @version August 6, 2021, 10:17 am UTC
 */
class ClientRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user.first_name',
        'user.last_name',
        'user.email',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return Client::class;
    }

    public function getData(): mixed
    {
        $data['countries'] = Country::toBase()->pluck('name', 'id')->toArray();

        return $data;
    }

    public function store($input): bool
    {
        try {
            DB::beginTransaction();

            if (isset($input['contact'])) {
                $checkUniqueness = checkContactUniqueness($input['contact'], $input['region_code']);
                if ($checkUniqueness) {
                    throw new UnprocessableEntityHttpException('Contact number already exists for another Client.');
                }
            }

            // Create user without password - will generate random password
            $userInput = [
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'contact' => $input['contact'] ?? null,
                'region_code' => $input['region_code'] ?? null,
                'password' => Hash::make(Str::random(16)), // Generate random password
            ];

            /** @var User $user */
            $user = User::create($userInput);
            $user->assignRole(Role::ROLE_CLIENT);

            $clientInput = [
                'user_id' => $user->id,
                'country_id' => $input['country_id'],
            ];
            $client = Client::create($clientInput);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updateClient(array $input, Client $client): bool
    {
        try {
            DB::beginTransaction();
            $user = $client->user;

            // Update user fields
            $userInput = [
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'contact' => $input['contact'] ?? $user->contact,
                'region_code' => $input['region_code'] ?? $user->region_code,
            ];

            $user->update($userInput);

            // Update client fields
            $clientInput = [
                'country_id' => $input['country_id'],
            ];
            $client->update($clientInput);

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
