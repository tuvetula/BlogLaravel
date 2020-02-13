<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\User;
use App\Notifications\NewMessageReceived;
use App\Repository\MessageRepository;
use App\Utils\CustomAuth;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MessagesController extends Controller
{
    /**
     * @var MessageRepository
     */
    private $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $users = $this->messageRepository->getUsers(CustomAuth::id());
        $unread = $this->messageRepository->unreadCount(CustomAuth::id());
        return view('Pages/messages/messagesIndex' , compact('users' , 'unread'));
    }

    /**
     * @param User $user
     * @return Factory|View
     */
    public function show(User $user)
    {
        $messages = $this->messageRepository->getMessages(CustomAuth::id(),$user->id)->paginate(10);
        $unread = $this->messageRepository->unreadCount(CustomAuth::id());
        if(isset($unread[$user->id])){
            $this->messageRepository->markAllRead(CustomAuth::id(),$user->id);
            unset($unread[$user->id]);
        }
        $this->messageRepository->markAllRead(CustomAuth::id() , $user->id);
        return view('Pages/messages/messagesShow' , [
            'users' => $this->messageRepository->getUsers(CustomAuth::id()),
            'user' => $user,
            'messages' => $messages,
            'unread' => $unread
        ]);
    }

    /**
     * @param MessageRequest $messageRequest
     * @param User $user
     * @return RedirectResponse
     */
    public function store(MessageRequest $messageRequest , User $user)
    {
        $message = $this->messageRepository->storeMessage($messageRequest->messageContent , CustomAuth::id() , $user->id);
        $user->notify(new NewMessageReceived($message));
        return redirect()->route('messages.show' , $user->id);
    }



}
