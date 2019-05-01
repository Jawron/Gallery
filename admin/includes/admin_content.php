



<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
            <div>

                <?php
//                $data = User::findAllUsers();
//
//                while($users = mysqli_fetch_array($data)){
//                    echo "{$users['username']}<br>";
//                }
//
//
//                $user_by_id = User::findUserById(2);
//
//                $user = User::instatiation($user_by_id); // returns an array
//
//                echo $user->id;

                $users = User::findUserById(1);

//                foreach($users as $user){
//                    echo $user->username . "<br>";
//                }
                echo $users->username;


               ?>


                </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->
