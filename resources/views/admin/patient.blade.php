<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ASSET('css/animations.css')}}">  
    <link rel="stylesheet" href="{{ASSET('css/main.css')}}">  
    <link rel="stylesheet" href="{{ASSET('css/admin.css')}}">
    <link rel="stylesheet" href="{{ASSET('css/patient.css')}}">  
    <title>Patients</title>
</head>
<body>
    <div class="container">
        <div class="menu">
          @include('admin.sidenav');
        </div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td>
                        <form action="" method="post" class="header-search">
                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Patient name or Email" list="patient">&nbsp;&nbsp;
                            <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            {{$currentDate}}
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">All Patients</p>
                    </td>
                    
                </tr>     
                <tr>
                   <td colspan="5">
                       <center>
                        <div class="abc scroll">
                            <table width="93%" class="sub-table scrolldown" style="border-spacing: 5px;">
                                <thead>
                                    <tr>
                                        <th class="table-headin">Name</th>
                                        <th class="table-headin">Telephone</th>
                                        <th class="table-headin">Email</th>
                                        <th class="table-headin">Date of Birth</th>
                                        <th class="table-headin">Address</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patients as $index => $patient)
                                    <tr>
                                        <td>{{$patient->firstName}} {{$patient->lastName}}</td>
                                        <td>{{$patient->number}}</td>
                                        <td>{{$patient->email}}</td>
                                        <td>{{$patient->dob}}</td>
                                        <td>{{$patient->address}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>

</div>

</body>
</html>