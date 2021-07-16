@php
    $id_for_html = str_replace("-", "_",$id);
@endphp
<a href="#" data-bs-toggle="modal" data-bs-target="#modal-new-user">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3"></path>
        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3"></path>
        <line x1="16" y1="5" x2="19" y2="8"></line>
    </svg>
</a>
{{-- <a href="#" onclick="event.preventDefault(); deleteAlert{{ $id_for_html }}();">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
        <line x1="4" y1="7" x2="20" y2="7"></line>
        <line x1="10" y1="11" x2="10" y2="17"></line>
        <line x1="14" y1="11" x2="14" y2="17"></line>
        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
    </svg>
</a>
{!! Form::open(['route' => ['admin.users.destroy', [$id]], 'method' => 'DELETE', 'style' => "display:none;", 'id' => "delete-row-" . $id_for_html]) !!}
{!! Form::close() !!}
<script>
    function deleteAlert{{ $id_for_html }}() {
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-row-{{ $id_for_html }}').submit()
            } else {
                Swal.fire(
                    'Deletion Canceled!',
                    'You canceled deletion of the record!',
                    'info'
                )
            }
        });
    }
</script> --}}