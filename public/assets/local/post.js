$('.modal').on('shown.bs.modal', function() {
  $(this).find('[autofocus]').focus();
});

$('#body').summernote({
  placeholder: 'Write here..',
  tabsize: 2,
  height: 350
});

let $selectCategory = $('#category').selectize({
 plugins: ["restore_on_backspace"]
}),
selectCategory = $selectCategory,

$selectTags =  $('#tags').selectize({
 plugins: ["remove_button","restore_on_backspace"],
 preload: true,
 create: true,
 persist:false,
 allowEmptyOption:false,
 maxItems: 5
}),
selectTags = $selectTags;

$('.custom-file-input').on('change', function(){
  let fileName = $(this).val().split('\\').pop();
  $('.custom-file-label').text(fileName);
});

$(document).on('click','#addButton', async () => {
  await removeValidationElem();
  document.getElementById('postForm').reset();
  $('.btn-save').val("add");
  $('.modal-title').text("Add post");
  $('#postsModal').modal('show');
  await setFormValueBeforeAjaxPost();
});

$(document).on('click', '#editButton', async function() {
  await removeValidationElem();
  const id = $(this).val();
  const url = `/posts/${id}/edit`;
  $.get(url, async function(res){
    $('.btn-save').val("update");
    $('#postsModal').modal('show');
    $('.modal-title').text("Update post");
    await setFormValueBeforeAjaxPut(res);
  });
});

const setFormValueBeforeAjaxPost = (res) => {
  $('.btn-save').attr('name', null)
  $('#body').summernote('code', null);
  selectCategory[0].selectize.setValue();
  selectTags[0].selectize.setValue();
  $('.custom-file-label')
  .addClass("selected")
  .html('Choose file');
}

const setFormValueBeforeAjaxPut = (res) => {
  $('.btn-save').attr('name', res.id)
  $('#title').val(res.title);
  $('#body').summernote('code', res.body);
  selectCategory[0].selectize.setValue(res.category_id);
  selectTags[0].selectize.setValue(res.tags.map(value => {
    return value.name;
  }));
  $('.custom-file-label')
  .addClass("selected")
  .html(res.thumb);
}


$('#postsModal form').on('submit', function(e){
  e.preventDefault();
  removeValidationElem();

  const data =  appendFormData(),
  state = $('.btn-save').val(),
  id = $('.btn-save').attr('name');

  if (state == "add") {
    url = "/posts"
  }else{
    url = `/posts/${id}`
    data.append('_method', 'put');
  }

  $.ajax({
    method: 'POST',
    url: url,
    data: data,
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    contentType: false,
    processData: false,
    dataType: 'json',
    success: (res)=>{
      console.log(res)
      successAlert(res.message);
      $('#postsModal').modal('hide');
    },
    error: (xhr)=>{
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

const appendFormData = ()=> {
  const data = new FormData();
  data.append('_token',  $('input[name=_token]').val());
  data.append('title', $('#title').val());
  data.append('body', $('#body').summernote('code'));
  data.append('category', $('#category').val());

  const thumb = $('#thumb')[0].files[0];
  data.append('thumb', thumb ? thumb : '');

  const arr = $('#tags').val();
  for (var i = 0; i < arr.length; i++) {
    data.append('tags[]', arr[i]);
  }

  return data;
}

$(document).on('click','#deleteButton',function(){
  const _token = $('meta[name="csrf-token"]').attr('content'),
  id = $(this).val(),
  url = `/posts/${id}`,
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
        success: (res) => {
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

const formValidate = (xhr) => {
  const res = xhr.responseJSON;
  let keys = "";
  if ($.isEmptyObject(res) == false) {
    $.each(res.errors, (key, value) => {
      if(key.indexOf(".") != -1){
        const arr = key.split(".");
        keys = $(`#${arr[0]}`)
      }else{
        keys = $(`#${key}`)
      }
      keys.closest('.form-control')
      .addClass('is-invalid');
      keys.closest('.form-group')
      .append(`<div class="invalid-feedback">${value}</div>`)
    });
  }
}

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

const removeValidationElem = () => {
  const form = $('#postForm');
  form.find('.invalid-feedback').remove();
  form.find('.form-control').removeClass('is-invalid');
}

// function previewImage(){
//   document.getElementById("FilePreview").style.display = "block";
//   var oFReader = new FileReader();
//   oFReader.readAsDataURL(document.getElementById("image").files[0]);

//   oFReader.onload = function(oFREvent){
//     document.getElementById("FilePreview").src = oFREvent.target.result;
//   }
// }


// data = {
//   _token     : $('input[name=_token]').val(),
//   title      : $('#title').val(),
//   body       : $('#body').summernote('code'), 
//   category   : $('#category').val(),
//   tags       : $('#tags').val(),
//   thumb      :  $("#thumb")[0].files[0]
// };