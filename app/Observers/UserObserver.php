<?php

namespace App\Observers;

use App\Http\Controllers\LogController;
use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function created(User $user)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {

            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$USUARIO;

            $name_user = $user->name;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$USUARIO_CRIADO,
                'message' => "
                    <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                    <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                    <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                    <strong class='text-primary'>Usuário: </strong> <strong class='text-danger'>$name_user.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function updated(User $user)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $changes = LogController::getChangesUser($user);

            if (strlen($changes) > 0) {
                $request = Request::capture();
                $category = LogController::$USUARIO;
                $ip = $request->ip();

                $name_user = $user->name;
                $id = Auth::id();
                $name = Auth::user()->name;
                $now = date('d/m/Y H:i:s');

                Log::create([
                    'title' => LogController::$USUARIO_EDITADO,
                    'message' => "
                    <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                    <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                    <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                    <strong class='text-primary'>Usuário: </strong> <strong class='text-danger'>$name_user.</strong><br>
                    <ul>
                        $changes
                    </ul>",
                    'ip' => $ip,
                    'category' => $category,
                    'user_id' => $id
                ]);
            }
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function deleted(User $user)
    {
        if (config()->get('seeding') == null || config()->get('seeding') === false) {
            $request = Request::capture();
            $ip = $request->ip();

            $category = LogController::$USUARIO;

            $name_user = $user->name;
            $id = Auth::id();
            $name = Auth::user()->name;
            $now = date('d/m/Y H:i:s');

            Log::create([
                'title' => LogController::$USUARIO_DELETADO,
                'message' => "
                    <strong class='text-primary'>Data:</strong> <strong class='text-warning'>$now.</strong><br>
                    <strong class='text-primary'>IP:</strong> <strong class='text-warning'>$ip</strong><br>
                    <strong class='text-primary'>Ação Realizada por:</strong> <strong class='text-warning'>$name.</strong><br>
                    <strong class='text-primary'>Usuário: </strong> <strong class='text-danger'>$name_user.</strong>",
                'ip' => $ip,
                'category' => $category,
                'user_id' => $id
            ]);

            $id = $user->id;
            $logs = Log::where('user_id', $id)->get();

            foreach ($logs as $log) {
                $log->delete();
            }

        }
    }

    /**
     * Handle the User "restored" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param \App\Models\User $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
