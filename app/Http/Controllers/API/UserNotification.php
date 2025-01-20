<?php
namespace App\Http\Controllers\API;
use App\Models\User;
use App\Traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserNotification extends Controller
{
    use ResponseJsonTrait;
    public function userReservations(string $id)
    {
        $user = User::findOrFail($id);
        if (Auth::guard('api')->id() != $user->id) {
            return $this->sendError('Unauthorized', [], 403);
        }
        $userReserveNotifications = $user->notifications->map(function ($notification) {
            return [
                'id' => $notification->id,
                'type' => $notification->type,
                'data' => $notification->data,
                'read_at' => $notification->read_at,
                'created_at' => $notification->created_at,
            ];
        });
        if ($userReserveNotifications->isEmpty()) {
            return $this->sendSuccess('No Notifications Found', []);
        }
        return $this->sendSuccess('user Notifications Retrieved Successfully', $userReserveNotifications->toArray());
    }
}
