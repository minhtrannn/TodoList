<?php 
namespace App\Repositories;

use App\Models\User;
use Webpatser\Uuid\Uuid;

/**
 * Class BaseRepository.
 */
class UserRepository extends BaseRepository
{
    const MODEL = User::class;

    public function paginated() {

    }

    public function store($request) {
        $user = new User();
        $user->id = (string)Uuid::generate(4);    
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return $user;
    }
}
?>