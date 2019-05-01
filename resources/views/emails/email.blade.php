
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <link href="{{asset('css/email.css')}}" rel="stylesheet" type="text/css">
    <style>
        table{
            width: 95%;
            border: 1px solid #000;
            background: #eee;
            direction: ltr;
        }
        th{
            border-left: 1px solid #000;
        }
        td{
            border-left: 1px solid #000;
            border-top: 1px solid #000;
        }

    </style>
</head>
<body>
<h2>Hi <strong>{{ $name }}</strong>, Please verify This email address</h2>


<p><a href="{{ $activation_link }}">Click here</a> to activate your account.</p>

</body>
</html>