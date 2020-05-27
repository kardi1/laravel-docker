<div class="col-sm-12">
    <table class="table table-striped">
        <thead>
        <tr>
            <td>ID</td>
            <td id="name-ordenation" style="cursor: pointer"><span>Name</span>
                <i id="name-order-icon" class="glyphicon glyphicon-menu-down" style="font-size: 10px; padding-left: 10%"></i></td>
            <td>Email</td>
            <td>User's Accesses</td>
            <td>Active</td>
        </tr>
        </thead>
        <tbody >
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->usersaccesses_count}}</td>
                    <td>{{$user->active}}</td>
                    {{--<td>
                        <a href="{{ route('users.show',$user->id)}}" class="btn btn-primary">View</a>
                    </td>
                    <td>
                        <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>--}}
                </tr>
            @endforeach
        </tbody>
    </table>
    @if(method_exists($users, 'links'))
        {{ $users->links() }}
    @endif
<div>
