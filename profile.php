<?php
include 'session.php';
$id = $_SESSION['id'];


require_once 'config/koneksi.php';

try {
  $sql = "SELECT u.id_user,u.nama_depan,u.nama_belakang,u.email,u.username,u.password,
  b.id_biodata,b.jns_kelamin,b.no_tel,b.alamat,b.photo
   FROM biodata b RIGHT JOIN users u on u.id_user = u.id_user WHERE u.id_user = ?";
  $q = $database_connection->prepare($sql);
  $q->execute([$id]);
} catch (PDOException $err) {
  die($err->getMessage());
}
foreach ($q as $data) {
  $id = $data['id_user'];
  $nama_depan = $data['nama_depan'];
  $nama_belakang = $data['nama_belakang'];
  $fullName = $nama_depan . ' ' . $nama_belakang;
  $email = $data['email'];
  $username = $data['username'];
  $password = $data['password'];
  $idBiodata = $data['id_biodata'];
  $jns_kelamin = $data['jns_kelamin'];
  $notel = $data['no_tel'];
  $alamat = $data['alamat'];
  $photoUser = $data['photo'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/tailwind.css" rel="stylesheet">
  
  
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
        p.class1{
      color: white;
      font-size: 30px;
    }

    body.modal-active {
      overflow-x: hidden;
      overflow-y: visible !important;
    }
  </style>
  <title>Profile</title>
</head>

<body class="bg-blue-400">
<div class="header">
        <p class="class1"><marquee>Forum Teknologi</h1></marquee>
        <p class="class1"> <b>Selamat Datang di Forum</b> Teknologi</p>
    </div>

  <!-- NAVBAR -->
  <nav class="bg-blue-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <img class="h-8 w-8" src="images/1.jpg" alt="Forum">
          </div>
          <div class="ml-10 flex items-baseline space-x-4">
            <a href="home.php" class="bg-blue-900 text-white px-3 py-2 rounded-md text-sm font-medium">Home</a>
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
              <a href="profile.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"> Profile</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav><!-- END NAVBAR -->
  <!-- Profile -->
  <div class="flex items-center h-screen w-full justify-center">
    <div class="max-w-xs">
      <div class="bg-white shadow-xl rounded-lg py-3">
        <div class="photo-wrapper p-2">
          <?php if ($photoUser == null) : ?>
            <img class="w-32 h-32 rounded-full mx-auto" src="images/image.jpg" alt="<?= $username ?>">
          <?php else : ?>
            <img class="w-32 h-32 rounded-full mx-auto" src="<?= $photoUser ?>" alt="<?= $username ?>">
          <?php endif; ?>
        </div>
        <div class="p-2">
          <h3 class="text-center text-xl text-gray-900 font-medium leading-8"><?= $fullName ?></h3>
          <div class="text-center text-gray-400 text-xs font-semibold">
            <p><?= $username ?></p>
          </div>
          <table class="text-xs my-3">
            <tbody>
            <tr>
                <td class="px-2 py-2 text-gray-500 font-semibold">Jenis Kelamin</td>
                <td class="px-2 py-2"><?= $jns_kelamin ?></td>
              </tr>
              <tr>
                <td class="px-2 py-2 text-gray-500 font-semibold">Notel</td>
                <td class="px-2 py-2"><?= $notel ?></td>
              </tr>
              <tr>
                <td class="px-2 py-2 text-gray-500 font-semibold">Alamat</td>
                <td class="px-2 py-2"><?= $alamat ?></td>
              </tr>

              <tr>
                <td class="px-2 py-2 text-gray-500 font-semibold">Email</td>
                <td class="px-2 py-2"><?= $email ?></td>
              </tr>
            </tbody>
          </table>

          <div class="text-center my-3">
            <button class="modal-open bg-transparent border border-green-900 hover:border-blue-500 text-green-900 hover:text-blue-500 font-bold py-1 px-2 rounded-full">Edit Profile</button>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End Profile -->
  <!-- Modal -->
  <div class="modal z-50 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

    <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

      <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
        <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
          <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
        </svg>
        <span class="text-sm">(Esc)</span>
      </div>

      <div class="modal-content py-4 text-left px-6">
        <!--Title-->
        <div class="flex justify-between items-center pb-3">
          <p class="text-2xl font-bold">Edit Profile</p>
          <div class="modal-close cursor-pointer z-50">
            <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
          </div>
        </div>

        <!--Body-->
        <form action="config/update_profile.php" method="POST" enctype="multipart/form-data">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="namadepan" class="block text-sm font-medium text-gray-700">Nama Depan</label>
                  <input type="text" name="namadepan" id="namadepan" value="<?= $nama_depan ?>" required autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="namabelakang" class="block text-sm font-medium text-gray-700">Nama Belakang</label>
                  <input type="text" name="namabelakang" id="namabelakang" value="<?= $nama_belakang ?>" required autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                  <input type="text" name="username" id="username" value="<?= $username ?>" required autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6 sm:col-span-4">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="text" name="email" id="email" value="<?= $email ?>" readonly class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                </div>
                <div class="col-span-6">
                  <label for="jeniskelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                  <input type="text" name="jeniskelamin" id="jeniskelamin" value="<?= $jns_kelamin ?>" required autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6">
                  <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                  <input type="text" name="alamat" id="alamat" value="<?= $alamat ?>" required autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6">
                  <label for="notel" class="block text-sm font-medium text-gray-700">Notel</label>
                  <input type="number" name="notel" id="notel" value="<?= $notel ?>" required autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                  <label for="photo" class="block text-sm font-medium text-gray-700">Photo : </label>
                  <input type="file" accept="image/x-png,image/jpg,image/jpeg" name="photo" id="photo" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6">
                  <label for="password" class="block text-sm font-medium text-gray-700">Old Password</label>
                  <input type="password" name="password" id="password" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="col-span-6">
                  <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                  <input type="password" name="new_password" id="new_password" autocomplete="off" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <input type="hidden" name="current_password" value="<?= $password ?>">
                <input type="hidden" name="id_user" value="<?= $id ?>">
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button type="submit" class="px-4 bg-green-500 p-3 rounded-lg text-white hover:bg-green-900">
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- End Modal -->

  <!-- Footer -->
  <div class="bg-black flex justify-center py-5">
    <p class="font-bold text-white">@Copyright by 18111146_RIZKY RAMADAN_TIF RP 18 CIDA_UASWEB1</p>
  </div>
  <script>
    function showMenuProfile() {
      document.getElementById("iconProfile").classList.toggle('hidden');
    }
    var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event) {
        event.preventDefault()
        toggleModal()
      })
    }

    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)

    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }

    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
        isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
        toggleModal()
      }
    };


    function toggleModal() {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }
  </script>
</body>

</html>