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
        <div class="col-md-4">
            <div align="center">
                <h2>{{ $title }}</h2>
            </div>
            <div class="layout">
                <div style="padding: 20px;border: 1px solid lightgray;">
                    <form id="registerForm" action="{{ route('adduser') }}" method="post">
                        @csrf <!-- MUST PASS  (@ csrf) WHEN FORM SUBMIT  -->
                        <div class="form-group">
                            <label for="firstname">First Name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname"
                                value="{{ isset($singleUserData->first_name) && !empty($singleUserData->first_name) ? $singleUserData->first_name : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Last Name:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname"
                                value="{{ isset($singleUserData->last_name) && !empty($singleUserData->last_name) ? $singleUserData->last_name : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ isset($singleUserData->email) && !empty($singleUserData->email) ? $singleUserData->email : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="lname">Password:</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <label><input type="radio" class="gender" name="gender"
                                    value="Male"checked>&nbsp;Male</label>&nbsp;&nbsp;
                            <label><input type="radio" class="gender" name="gender"
                                    value="Female">&nbsp;Female</label>
                        </div>

                        <div class="form-group">
                            <label for="lname">Other Details:</label>
                            <textarea name="od" id="od" rows="5" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" id="submit" class="btn btn-primary">
                            @if (!isset($singleUserData) && empty($singleUserData))
                                <input type="button" id="reset" class="btn btn-primary" value="Reset">
                            @else
                                <a href="{{ route('userslist') }}" class="btn btn-primary">Back</a>
                            @endif
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if (isset($userData) && !empty($userData))
                <div align="center">
                    <h2>User Details</h2>
                </div>
                <div class="layout">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">

                            @foreach ($userData as $val)
                                <tr>
                                    <td>{{ $val->id }}</td>
                                    <td>{{ $val->first_name }}</td>
                                    <td>{{ $val->last_name }}</td>
                                    <td>{{ $val->email }}</td>
                                    <td>{{ $val->created_at }}</td>
                                    <td><div class="btn-group">
                                        <a href="{{ route('viewuser', $val->id) }}" class="btn btn-sm  btn-primary">Edit</a>
										<a href="{{ route('deleteuser', $val->id) }}"class="btn btn-sm btn-danger">Delete</a>
										</div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                    <div> <button class="cl_all btn btn-block btn-primary">Clear All</button></div>
                </div>
            @endif
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#firstname").focus();

            $("#firstname,#lastname").focusout(function() {
                let fname = $("#firstname").val();
                let lname = $("#lastname").val();
                $("#firstname").val(fname.charAt(0).toUpperCase() + fname.slice(1));
                $("#lastname").val(lname.charAt(0).toUpperCase() + lname.slice(1));
            })
            $("#reset").click(function() {
                $("input[type=text] , input[type=email] , input[type=password],textarea").val("");
                $("#error_message").html("");
            });
        });

        $('#registerForm').validate({
            rules: {
                firstname: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    rangelength: [5, 10]
                }
                //confirmpassword: {
                //equalTo: password

                //}
            },
            messages: {
                firstname: {
                    required: "Enter First Name"

                },
                email: {
                    required: "Enter Email Address"

                },
                password: {
                    required: "Enter Password"
                },

            },
        });
    </script>

</body>

</html>
