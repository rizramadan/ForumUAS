<?php
    
include 'config/data_register.php';
include 'session.php';
include 'config/koneksi.php';
include 'config/index.php';
include 'config/post.php';
$id = $_SESSION['id'];
$username = $_SESSION['username'];
foreach ($qUsers as $data) {
    $id = $data['id_user'];
    $email = $data['email'];
    $username = $data['username'];
    $photoUser = $data['photo'];
  }
?>
<!Doctype html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/tailwind.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

  
  <style>
    .modal {
      transition: opacity 0.25s ease;
    }
    .header {
            padding: 80px;
            text-align: center;
            color: white;
            background-image: url(images/tek2.jpg);
        }

    body.modal-active {
      overflow-x: hidden;
      overflow-y: visible !important;
    }
    p.class{
      color: black;
      font-size: 30px;
    }
      p.class1{
      color: white;
      font-size: 30px;
    }
  </style>
  
        <title>User Forum</title>
         <link rel="stylesheet" href="modul/bootstrap-4.5.3-dist/css/bootstrap.min.css">
         <script language="Javascript" src="modul/bootstrap-4.5.3-dist/js/bootstrap.min.js"> </script>
         <script src="modul/JQuery/jquery.min.js"></script>
    
         <!-- CSS dan JS DataTable -->
        <script src="modul/DataTable/datatables.min.js"></script>
        <script src="modul/DataTable/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>
<div class="header">
        <p class="class1"><marquee>Forum Teknologi</h1></marquee>
        <p class="class1"> <b>Selamat Datang di Forum</b> Teknologi</p>
    </div>
    <nav class="bg-blue-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="images/1.jpg" alt="Forum">
          </div>
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="home.php" class="bg-blue-900 text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href="iuser.php" class="bg-blue-900 text-white px-3 py-2 rounded-md text-sm font-medium">Users</a>
         
          </div>
        </div>
        <div class="ml-4 flex items-center md:ml-6">
          <p class="text-white font-semibold"><?= $username ?></p>
          <div class="ml-3 relative">
            <div>
              <button class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" onclick="showMenuProfile()">
                <?php if ($photoUser == null) : ?>
                  <img class="h-8 w-8 rounded-full" src="images/image.jpg" alt="<?= $username ?>">
                <?php else : ?>
                  <img class="h-8 w-8 rounded-full" src="<?= $photoUser ?>" alt="<?= $username ?>">
                <?php endif; ?>
              </button>
            </div>

            <div class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" id="iconProfile">
              <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Profile</a>
              <a href="config/logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
    <div class="container">
        <table id="dataregister" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Username</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $q->fetch()):
            $id = $row['id_user'];
            $namadepan = $row['nama_depan'];
            $namabelakang = $row['nama_belakang'];
            $namalengkap = $namadepan . " " . $namabelakang;
            $email = $row['email'];
            $username = $row['username'];
            ?>
            <tr>
                <td><?php echo $namalengkap;?></td>
                <td><?php echo $email;?></td>
                <td><?php echo $username;?></td>
                <td>
                <!-- form edit -->
               

                <form action="profile.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <button type="submit" class="btn btn-success">Detail View</button>
                            </form>

                <!-- form hapus -->
            
                </td>
            </tr>
            <?php endwhile;?>
        </tbody>
    </table>
    </div>
    <!-- Footer -->
 <div class="bg-blue-500 flex justify-center py-5">
    <p class="font-bold text-white">@Copyright by 18111146_RIZKY RAMADAN_TIF RP 18 CIDA_UASWEB1</p>
  </div>
</body>
<script>
    $(document).ready(function(){
        $('#dataregister').DataTable(
            {
                "aLengthMenu" : [
                    [5, 10, 25, -1]
                    [5, 10, 25, "All"]
                ],
                "DisplayLength": 5
            }
        );
    });
    </script>
</html>