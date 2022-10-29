<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Website url</th>
        <th scope="col">Short link</th>
        <th scope="col">QR</th>
        <th scope="col">Tracking Data</th>
        <th scope="col">Creation date</th>
        <th scope="col">Creator name</th>
        <th scope="col">Creator email</th>
    </tr>
    </thead>
    <tbody>
    @if(count($links) > 0)
        @foreach($links as $link)
            <tr>
                <th>{{$link->id}}</th>
                <td class="table_width">{{$link->website_url}}</td>
                <td><a target="_blank" href="/short_link/{{ $link->short_link }}">{{ $link->short_link }}</a></td>
                <td>{!! QrCode::size(30)->generate($link->website_url) !!}</td>
                <td>{{ $link->tracking_data }}</td>
                <td>{{ $link->created_at }}</td>
                <td>{{ $link->user->name }}</td>
                <td>{{ $link->user->email }}</td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>
