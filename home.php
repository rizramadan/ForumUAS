<?php
include 'session.php';
include 'config/koneksi.php';
include 'config/index.php';
include 'config/post.php';
$id = $_SESSION['id'];
$username = $_SESSION['username'];
// $photoUser = $_SESSION['photo'];
date_default_timezone_set("Asia/Bangkok");
foreach ($qUsers as $data) {
  $id = $data['id_user'];
  $email = $data['email'];
  $username = $data['username'];
  $photoUser = $data['photo'];
}
?>
<!DOCTYPE html>
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
  <title>Home</title>

</head>
<body class="bg-white">
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
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <!-- END NAVBAR -->
  <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 ">
  <h1><p class="class"><b>All Question</b></p></h1>
    <?php if ($qPost->rowCount()  == 0) : ?>
      <div class="flex justify-center h-screen items-center">
        <button class="modal-open bg-blue-900 border border-gray-200 hover:border-green-900 text-gray-50 hover:text-black font-bold py-2 px-4 rounded-full">
        <i class="zmdi zmdi-plus"></i> Ask Question</button>
      </div>
    <?php else : ?>
      <div class="flex justify-center ">
        <button class="modal-open bg-blue-900 border border-gray-200 hover:border-green-900 text-gray-50 hover:text-black font-bold py-2 px-4 rounded-full">
        <i class="zmdi zmdi-plus"></i> Ask Question</button>
      </div>
    <?php endif; ?>
    <!-- Modal -->
    <div class="modal z-50 opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
      <!-- overlay -->
      <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

      <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Esc -->
        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
          <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
          </svg>
          <span class="text-sm">(Esc)</span>
        </div>
        <div class="modal-content py-4 text-left px-6">
          <!--Title Modal-->

          <div class="modal-content py-4 text-left px-6">
            <!--Title Modal-->
            <div class="flex justify-between items-center pb-3">
              <p class="text-2xl font-bold">Create Post</p>
              <div class="modal-close cursor-pointer z-50">
                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
              </div>
            </div>

            <!--Body Modal-->
            <form action="config/add_post.php" method="POST" enctype="multipart/form-data">
              <input type="text" name="id" value="<?= $id ?>">
              <textarea id="post" name="post" rows="5" cols="50" required class="bg-gray-100 " placeholder="Post everything your mind"></textarea>
              <br>
              <label for="gambar_post">Gambar : </label>
              <input type="file" name="gambar_post" id="gambar_post" accept="image/x-png,image/jpg,image/jpeg">
              <input type="hidden" name="tgl_post_dibuat" value="<?= date("Y-m-d H:i:s") ?>">
              <br>
              <!--Footer Modal-->
              <div class="flex justify-end pt-2">
                <button type="submit" name="posting" class="px-4 bg-green-500 p-3 rounded-lg text-white hover:bg-green-900">Post</button>
              </div>
            </form>

          </div>

        </div>
      </div>
    </div>
    <!-- End Modal -->

<?php foreach ($qPost as $data) : ?>
  <?php
  $username = $data['username'];
  $idPost = $data['id_post'];
  $photo = $data['photo'];
  $idUser = $data['id_user'];
  $post = $data['post'];
  $gambarPost = $data['gambar_post'];
  $tgl = $data['tgl_post_dibuat'];

  ?>
  <!-- POST -->
  <section class="text-blue-200 mt-10 ">
    <div class="max-w-6xl mx-auto px-5 mb-20 ">
      <div class="flex sm:-m-4 ">
        <div class="md:w-1/2 md:mb-0">

          <div class="rounded bg-blue-400 p-4 flex-col  ">
            <div class="flex items-right">
              <div class="flex items-center space-x-4">
                <?php if ($photo == null) : ?>
                  <img class="w-16 h-16 rounded-full" src="images/image.jpg" alt="<?= $username ?>">
                <?php else : ?>
                  <img class="w-16 h-16 rounded-full bg-white" src="<?= $photo ?>" alt="<?= $username ?>">
                <?php endif; ?>
              </div>
              <h2 class=" m-5 text-xl title-font font-medium mb-3"><?= $username ?></h2>
            </div>

            
            <div class="flex-grow mt-5 relative">
              <p class="leading-relaxed text-sm text-justify font-bold"><?= $post ?></p>
              <?php if ($gambarPost != null) : ?>
                <img src="<?= $gambarPost ?>" alt="image post">
              <?php endif; ?>
              <p class="absolute -right-0 font-thin"><?= $tgl ?></p>
            </div>
            <!-- END POSTINGAN -->
            <!-- Detail Post -->
            <div class="flex-grow mt-8 grid grid-cols-12 gap-4">

              <div class="col-span-6 flex justify-center ">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" fill="white">
                  <path d="M20 15c0 .552-.448 1-1 1s-1-.448-1-1 .448-1 1-1 1 .448 1 1m-3 0c0 .552-.448 1-1 1s-1-.448-1-1 .448-1 1-1 1 .448 1 1m-3 0c0 .552-.448 1-1 1s-1-.448-1-1 .448-1 1-1 1 .448 1 1m5.415 4.946c-1 .256-1.989.482-3.324.482-3.465 0-7.091-2.065-7.091-5.423 0-3.128 3.14-5.672 7-5.672 3.844 0 7 2.542 7 5.672 0 1.591-.646 2.527-1.481 3.527l.839 2.686-2.943-1.272zm-13.373-3.375l-4.389 1.896 1.256-4.012c-1.121-1.341-1.909-2.665-1.909-4.699 0-4.277 4.262-7.756 9.5-7.756 5.018 0 9.128 3.194 9.467 7.222-1.19-.566-2.551-.889-3.967-.889-4.199 0-8 2.797-8 6.672 0 .712.147 1.4.411 2.049-.953-.126-1.546-.272-2.369-.483m17.958-1.566c0-2.172-1.199-4.015-3.002-5.21l.002-.039c0-5.086-4.988-8.756-10.5-8.756-5.546 0-10.5 3.698-10.5 8.756 0 1.794.646 3.556 1.791 4.922l-1.744 5.572 6.078-2.625c.982.253 1.932.407 2.85.489 1.317 1.953 3.876 3.314 7.116 3.314 1.019 0 2.105-.135 3.242-.428l4.631 2-1.328-4.245c.871-1.042 1.364-2.384 1.364-3.75" />
                </svg><?= getJumlahKomen($database_connection, $idPost) ?>

              </div>


               
            <!-- End Detail Post -->
            <!-- Form comment -->
            <div class="flex justify-center">
              <form class="flex  mt-8 mb-4" action="config/komentar.php" method="POST">
                <input type="hidden" name="id_post" value="<?= $idPost ?>">
                <input type="hidden" name="id_user" value="<?= $id ?>">
                <input class="rounded-l-lg  border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" placeholder="Jawab Pertanyaan" type="text" name="komen" id="komen" autocomplete="off" required />
                <button class="px-2 rounded-r-lg bg-gray-400  text-gray-800 font-bold px-2 uppercase border-gray-500 border-t border-b border-r" type="submit" name="add_comment">Kirim</button>
              </form>
            </div>
          </div>
          <?php if ($id == $idUser) : ?>
            <div class="float-right">
              <form action="config/hapus_post.php" method="POST">
                <input type="hidden" name="id_post" value="<?= $idPost ?>">
                <input type="hidden" name="gambar_post" value="<?= $gambarPost ?>">
                <button type="submit" name="delete_post"><img src="https://img.icons8.com/fluent-systems-regular/24/000000/trash.png" /></button>
              </form>
            </div>
          <?php endif; ?>

        </div>
        <!-- Comment -->
        <div class="container mx-auto max-w-sm flex flex-col justify-center items-center">
          <?php
          try {
            $sql = "SELECT u.username,k.komentar,b.photo
          FROM `users` u 
          JOIN `komentar_post` k
          JOIN `biodata` b
          WHERE u.id_user = k.id_user AND k.id_post = ?  AND u.id_user = b.id_user
          ORDER BY `id_comment` ASC";
            $query = $database_connection->prepare($sql);
            $query->execute([$idPost]);
          } catch (PDOException $err) {
            die($err->getMessage());
          }
          ?>
          <?php foreach ($query as $dataKomen) : ?>
            <?php
            $username = $dataKomen['username'];
            $komentar = $dataKomen['komentar'];
            $photoKomen = $dataKomen['photo'];
            ?>
            <div class="bg-black w-full flex items-center p-2 rounded-xl shadow border my-2">
              <div class="flex items-center space-x-4">
                <?php if ($photoKomen == null) : ?>
                  <img class="w-16 h-16 rounded-full" src="images/image.jpg" alt="<?= $username ?>">
                <?php else : ?>
                  <img class="w-16 h-16 rounded-full" src="<?= $photoKomen ?>" alt="<?= $username ?>">
                <?php endif; ?>

              </div>
              <div class="flex-grow p-3">
                <div class="font-semibold text-gray-800 ">
                  <p><?= $username ?></p>
                </div>
                <div class="text-sm text-gray-800 ">
                  <p><?= $komentar ?></p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>

        </div>
        <!-- End Comment -->
      </div>
    </div>
  <?php endforeach; ?>
  <!-- END POST -->
</div>
 <!-- Footer -->
 <div class="bg-blue-500 flex justify-center py-5">
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