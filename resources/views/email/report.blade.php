<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Report</title>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Website URL</th>
        <th>Short Link</th>
        <th>Tracking Data</th>
        <th>Created Date</th>
    </tr>
    </thead>
    <tbody>
     @foreach($data->links as $val)
         <td>{{$val->website_url}}</td>
         <td>{{$val->short_link}}</td>
         <td>{{$val->tracking_data}}</td>
         <td>{{$val->created_at}}</td>
     @endforeach
    </tbody>
</table>
</body>
</html>
