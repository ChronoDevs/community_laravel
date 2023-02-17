@extends('layouts.admin')
@section('content')
<div class="container mt-5 mb-5">
    <table id="postsTable" class="table table-dark table-striped display text-info">
        <thead>
            <tr>
                <th>Title</th>
                <th>Posted By</th>
                <th>Likes</th>
                <th>Favorites</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td class="text-wrap">{{ $post['title'] }}</td>
                    <td>{{ $post['user']['name'] }}</td>
                    <td>{{ sizeof($post['likes']) }}</td>
                    <td>{{ sizeof($post['favorites']) }}</td>
                    <td>
                        <button class="btn setStatus {{ $post['status'] == 1
                            ? 'btn-primary' : 'btn-secondary' }}" onclick="setStatus(this, {{ $post->id }})">
                            {{ $post['status'] == 1 ? 'Active' : 'Inactive' }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#postsTable').DataTable();
        })

        function setStatus(status, id) {
            $status = $(status).text().trim() != 'Active' ? 1 : 0;
            $data = {
                    status: $status
                };
            $.ajax({
            url: `/admin/posts/edit/${id}`,
            type: 'POST',
            data: $data,
            success: function (data, xhr) {
                if ($status) {
                    $(status).text('Active').removeClass('btn-secondary').addClass('btn-primary');
                } else {
                    $(status).text('InActive').removeClass('btn-primary').addClass('btn-secondary');
                }
            },
            error: function (data, status, error) {
                console.log(data, status, error);
            },
            })
        }
    </script>
@endpush
