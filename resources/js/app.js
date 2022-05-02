/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

// 親カテゴリのselect要素が変更になるとイベントが発生
$('#parent').on('change', function() {
  var cate_val = $(this).val();

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/category',
    type: 'POST',
    data: {
      'category_val': cate_val
    },
    datatype: 'json',
  })
    .done(function(data) {
      // 子カテゴリのoptionを一旦削除
      $('#child option').remove();
      // DBから受け取ったデータを子カテゴリのoptionにセット
      $.each(data, function(key, value) {
        $('#child').append($('<option>').text(value.name).attr('value', value.id));
      })
    })
    .fail(function() {
      console.log('失敗');
    });
});

$('#image_1').on('change', function() {
  var formData = new FormData();
  formData.append('image', $('#image_1')[0].files[0]);
  console.log($('#image_1')[0].files[0]);

  var reader = new FileReader();
  reader.onload = function(event) {
    $('.show_image_1').attr('src', event.target.result).show;
  }
  reader.readAsDataURL($('#image_1')[0].files[0]);
  $('.show_image_1').css('display', 'block');

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: '/image-upload',
    type: 'POST',
    data: formData,
    dataType: 'text',
    processData: false,
    contentType: false,
  })
  .done(function(data) {
    $('#image_1').attr('value', data);
    console.log(data);
  })
  .fail(function() {
    console.log('失敗');
  });
});
