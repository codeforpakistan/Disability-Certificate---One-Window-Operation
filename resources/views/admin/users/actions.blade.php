@php
    $id_for_html = str_replace("-", "_",$id);
@endphp
@if( ! $banned_at )
    <a href="#" class="text-red" onclick="event.preventDefault(); banUserAlert{{ $id_for_html }}();" title="Ban User">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-ban" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <circle cx="12" cy="12" r="9"></circle>
            <line x1="5.7" y1="5.7" x2="18.3" y2="18.3"></line>
        </svg>
    </a>
    {!! Form::open(['route' => ['admin.users.ban', [$id]], 'method' => 'PUT', 'style' => "display:none;", 'id' => "ban-row-" . $id_for_html]) !!}
    {!! Form::close() !!}
    <script>
        function banUserAlert{{ $id_for_html }}() {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to ban this user? Once banned this user won't be able to login!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, ban user!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('ban-row-{{ $id_for_html }}').submit()
                } else {
                    Swal.fire(
                        'Canceled!',
                        'You didn\'t ban the user.',
                        'info'
                    )
                }
            });
        }
    </script>
@else
    <a href="#" class="text-green" onclick="event.preventDefault(); unbanUserAlert{{ $id_for_html }}();" title="Unban User">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M9 12l2 2l4 -4"></path>
            <path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"></path>
        </svg>
    </a>
    {!! Form::open(['route' => ['admin.users.unban', [$id]], 'method' => 'PUT', 'style' => "display:none;", 'id' => "unban-row-" . $id_for_html]) !!}
    {!! Form::close() !!}
    <script>
        function unbanUserAlert{{ $id_for_html }}() {
            Swal.fire({
                title: "Are you sure?",
                text: "You want to unban this user? Once the ban is removed this user will be able to login!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, unban user!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('unban-row-{{ $id_for_html }}').submit()
                } else {
                    Swal.fire(
                        'Canceled!',
                        'You didn\'t unban the user.',
                        'info'
                    )
                }
            });
        }
    </script>
@endif