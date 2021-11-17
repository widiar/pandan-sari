$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $(".actionz").on('submit', '.deleted', function(e){
        e.preventDefault()
        var form = $(this);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                  url: $(form).attr("action"),
                  method: "DELETE",
                  dataType: "json",
                  success: function(data){
                      if (data == "Sukses"){
                        Swal.fire(
                            'Deleted!',
                            'The data has been deleted.',
                            'success'
                          ).then((result) => {
                              if (result.isConfirmed) window.location.href = "";
                          }) 
                      }else{
                        Swal.fire("Oops", "Something Wrong!", "error");
                      }
                  }
              })
            }
          })
    })
    $(".logout").click(function(e){
        e.preventDefault()
        Swal.fire({
            title: 'Are you sure?',
            text: "You will be loged out",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = $(this).attr('href')
            }
          })
    })
})