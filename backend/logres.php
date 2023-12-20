<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <link rel="stylesheet" href="logres.css" />
  </head>
  <body>
    <div class="container" id="container">
      <div class="form-container sign-up">
        <form action="register.php" method="POST">
          <h1>Buat Akun</h1>
          <br />
          <label for="nama">Nama</label>
          <input type="text" name="nama" placeholder="Masukkan nama..." />

          <label for="username">Username</label>
          <input type="text" name="username" placeholder="Masukkan username..." />

          <label for="email">Email</label>
          <input type="email" name="email" placeholder="Masukkan email..." />

          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Masukkan password..." />

          <label for="role">Role</label>
          <select name="role" id="role">
            <option value="guru">Guru</option>
            <option value="siswa">Siswa</option>
          </select>
          <button type="submit" name = "register">Daftar</button>
        </form>
      </div>

      <div class="form-container sign-in" id="form_sign-in">
        <form action="login.php" method="POST">
          <h1>Masuk Akun</h1>
          <br />
          <label for="username">Username</label>
          <input type="text" name="username"placeholder="Masukkan username..." />

          <label for="password">Password</label>
          <input type="password" name="password" placeholder="Masukkan password..." />
          <button type="submit">Masuk</button>
        </form>
      </div>
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <img class="left-logo" src="gambar/logo.svg" alt="logo" /><br />
            <h1>Selamat Datang!</h1>
            <p>Jika sudah mempunyai akun, Anda dapat masuk</p>
            <button class="hidden" id="login">Masuk</button>
          </div>
          <div class="toggle-panel toggle-right">
            <img class="right-logo" src="gambar/logo.svg" alt="logo" /><br />
            <h1>Hallo!</h1>
            <p>Jika belum mempunyai akun, Anda dapat daftar terlebih dahulu</p>
            <button class="hidden" id="register">Daftar</button>
          </div>
        </div>
      </div>
    </div>

    <script src="logres.js"></script>
  </body>
</html>
