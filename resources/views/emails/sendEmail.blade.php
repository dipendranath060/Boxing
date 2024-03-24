<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sendEmail</title>
    <style>
        .text-main{
            color: #99013D;
        }
    </style>
</head>
<body>
    <h2 class="text-main">Hello NPBC Team</h2>
    <h4>Name : {{$data['name']}}</h4>
    <h4>Email : {{$data['email']}}</h4>
    <h4>Phone No : {{$data['phone']}}</h4>
    <h4>Message : {{$data['message']}}</h4>
</body>
</html>