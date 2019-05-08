



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


//                foreach($users as $user){
//                    echo $user->username . "<br>";
//                }
//                $display_users = User::findAllUsers();
//
//                foreach ($display_users as $users) {
//                    echo "<tr>";
//                    echo "<td> $users->id    </td>";
//                    echo "<td> $users->username   </td>";
//                    echo "</tr>";
//                }
                //                $user = User::findUserById(6);
                //             $user->last_name = "Williams";

                //             $user->delete();
//
//              $user = User::findUserById(7);
//              $user->username = "Ultramegasuer";
//               $user->save();

//              $user = new User();
//             $user->username = "sgfdeegteeggegegegesseggseges";
//
//               $user->save();
 //echo $database->theInsertId();



//                $user = new User();
//
//                $user->username = "Alexander the Great";
//                $user->password = "legion";
//                $user->first_name = "Alexandros2";
//                $user->last_name = "Machedonian2";
//
//                $user->save();


                $user = User::findUserById(16);

                $user->username = "Alexander the Great";
                $user->password = "legion";
                $user->first_name = "Alexandros3";
                $user->last_name = "Machedonian3";

                $user->save();














               ?>


                </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->
