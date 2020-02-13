<?php

namespace App\Repository;

use App\Models\Messages;
use App\Models\User;
use App\Utils\CustomAuth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class MessageRepository
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Messages
     */
    private $messages;

    /**
     * MessageRepository constructor.
     * @param User $user
     * @param Messages $messages
     */
    public function __construct(User $user , Messages $messages)
    {
        $this->user = $user;
        $this->messages = $messages;
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public function getUsers(int $userId)
    {
        //On récupère tous les utilisateurs autre que celui connecté
        return $this->user
            ->where('id','!=', $userId)
            ->orderBy('name')
            ->get();
    }

    /**
     * @param string $content
     * @param int $from_id
     * @param int $to_id
     * @return Messages
     */
    public function storeMessage(string $content , int $from_id , int $to_id)
    {
        $message = new Messages;
        $message->content = $content;
        $message->from_id = $from_id;
        $message->to_id = $to_id;
        $message->save();
        return $message;
    }

    /**
     * @param int $from
     * @param int $to
     * @return Builder
     */
    public function getMessages(int $from, int $to)
    {
        return $this->messages->newQuery()
            ->whereRaw("((from_id = $from && to_id = $to) || (from_id = $to && to_id = $from))")
            ->orderBy('created_at' , 'DESC');
    }

    /**
     * @param int $userId
     * @return Builder[]|Collection|\Illuminate\Database\Query\Builder[]|\Illuminate\Support\Collection
     */
    public function unreadCount(int $userId)
    {
        return $this->messages->newQuery()
            ->where('to_id' , '=' , $userId)
            ->where('read_at' , '=' , null)
            ->groupBy('from_id')
            ->selectRaw('from_id , count(id) as count')
            ->get()
            ->pluck('count','from_id');
    }

    public function markAllRead(int $me , int $other)
    {
        $this->messages->newQuery()
            ->where('from_id', '=' , $other)
            ->where('to_id' , '=' , $me)
            ->update([
                'read_at' => Carbon::now()
            ]);
    }
}
