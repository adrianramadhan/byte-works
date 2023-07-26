function validateLogin(event) {
    event.preventDefault(); // Mencegah perilaku default dari event form submission.
    
    // Ambil input dari form login
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const alertContainer = document.getElementById("alert-container");
  
    // Validasi input
    if (username.trim() == "") {
      alertContainer.innerHTML = '<div class="alert alert-danger" role="alert">Username tidak boleh kosong</div>';
    }
    if (password.trim() == "") {
      alertContainer.innerHTML = '<div class="alert alert-danger" role="alert">Password tidak boleh kosong</div>';
    }

    // Memeriksa apakah username dan password cocok dengan nilai yang diharapkan.
    if (username == "admin" && password == "admin") { 
      alertContainer.innerHTML = '<div class="alert alert-success" role="alert">Login sukses</div>';
      // Mengarahkan ke halaman setelah login sukses.
      window.location.href = "http://localhost/rinjani-aquarium/adminpanel/index.php";
    } else {
      alertContainer.innerHTML = '<div class="alert alert-danger" role="alert">Username atau password salah</div>';
    }
    
  }
