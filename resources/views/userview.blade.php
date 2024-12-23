<div>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Userform</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    </head>

    <body>

        <style>
            /* .form-control
     {
         background-color: #e6f2ff;
     }*/
            .layout {
                /* margin-left: 30%;
            margin-right: 30%;*/
                margin-top: 8%;
                padding: 10px, 10px;
            }

            .error {
                color: red;
            }
        </style>

        <div class="container">
            <div class="col-md-5">
                <div align="center">
                    <h2>{{ $title }}</h2>
                </div>
                <div class="layout">
                    <div style="padding: 20px;border: 1px solid lightgray;">
                        @foreach ($userData as $val)
                            <p>ID : - {{ $val->id }}</p>
                            <p>First Name : - {{ $val->first_name }}</p>
                            <p>Last Name : - {{ $val->last_name }}</p>
                            <p>Email : - {{ $val->email }}</p>
                            <p>Created at:- {{ $val->created_at }}</p>
                            <p><a href="{{ route('userslist') }}" class="btb btn-sm btn-primary">Back</a> </p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


    </body>

    </html>

</div>
