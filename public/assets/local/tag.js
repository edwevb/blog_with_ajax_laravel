$('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});

$(document).on('click','#addButton', () => {
  removeFormValidation();
  document.getElementById('categoryForm').reset();
  $('.btn-save').val("add");
  $('#tagModal').modal('show');
  $('.modal-title').text("Add Tag");
  $('.btn-save').attr('name', null)
});

$(document).on('click', '#editButton',  function() {
  removeFormValidation();
  const id = $(this).val(),
  url = `/tags/${id}/edit`;
  $.get(url, function(res){
    console.log(res)
    $('.btn-save').attr('name', res.id)
    $('.btn-save').val("update");
    $('#tagModal').modal('show');
    $('.modal-title').text("Update Category");
    $('#name').val(res.name);
  });
});

$('#tagModal form').on('submit', (e) => {
  e.preventDefault();
  removeFormValidation();

  const state = $('.btn-save').val(),
  id = $('.btn-save').attr('name'),
  data = {
    _token: $('input[name="_token"]').val(),
    name: $('#name').val()
  };

  if (state == "add") {
    url = "/tags"
    type = "POST"
  }else{
    url = '/tags/'+id
    type = "PUT"
  }

  $.ajax({
    type: state,
    method: type,
    url: url,
    data: data,
    dataType:'json',
    success: (res) => {
      console.log(res)
      successAlert(res.message);
      $('#tagModal').modal('hide');
    },
    error: (xhr) => {
      console.log(xhr.responseText)
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something error, please check your input!',
        showCloseButton: true
      }).then(()=>{
        formValidate(xhr);
      });
    }
  });
});

$(document).on('click','#deleteButton',function(){
  const _token = $('meta[name="csrf-token"]').attr('content'),
  id = $(this).val(),
  url = '/tags/'+id,
  data = {
    id : id,
    _token:_token
  };

  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((res) => {
    if (res.isConfirmed) {
      $.ajax({
        type: "DELETE",
        url: url,
        data: data,
        dataType: 'json',
        success: function (res) {
          console.log(res)
          successAlert(res.message);
        },
        error: (xhr) => {
          console.log(xhr.responseText);
        }
      });
    }
  });
});


const successAlert = (msg) => {
  Swal.fire({
    title: 'Loading..',
    timer: 2000,
    timerProgressBar: true,
    allowOutsideClick:false,
    allowEscapeKey:false,
    allowEnterKey:false,
    didOpen: () => {
      Swal.showLoading()
    }
  }).then(() => {
    Swal.fire({
      icon: 'success',
      iconColor:'#38C172',
      title: msg,
      showCloseButton: true,
    }).then(()=>{
      table.draw();
    });
  });
}

const formValidate = (xhr) => {
  const res = xhr.responseJSON;
  if ($.isEmptyObject(res) == false) {
    $.each(res.errors, (key, value) => {
      $('#'+key)
      .closest('.form-control')
      .addClass('is-invalid')
      .closest('.form-group')
      .append(`<div class="invalid-feedback">${value}</div>`);
    });
  }
}

const removeFormValidation = () => {
  const form = $('#categoryForm');
  form.find('.invalid-feedback').remove();
  form.find('.form-control').removeClass('is-invalid');
}