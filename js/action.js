function berhasil() {
    Swal.fire({
        position: 'center-center',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
      }).then(function() {
          return window.location="../index.php";
      })
}


function gagal() {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong!',
        footer: '<a href="">Why do I have this issue?</a>'
    }).then(function() {
        return window.location="../index.php";
    })
}