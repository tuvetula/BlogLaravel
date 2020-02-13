<div class="col-md-4">
    <ul class="list-group">
        @foreach($users as $user)
            <li class="list-group-item">
                <a class="stretched-link text-dark text-decoration-none" href="{{ route('messages.show' , $user->id) }}">{{$user->name}} {{ $user->first_name }}
                    @if(isset($unread[$user->id]))
                    <span class="badge badge-primary ml-1 float-right">{{ $unread[$user->id] }}</span>
                        @endif
                </a>
            </li>
        @endforeach
    </ul>
</div>
