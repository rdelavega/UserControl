$(document).ready(function() {
  $('.sidenav').sidenav();
  $('select').formSelect();
  $('.tooltipped').tooltip();
  $('.materialboxed').materialbox();
  $('.fixed-action-btn').floatingActionButton();

  if ($('#user_save')) {
    $('#user_save').append('<i class="material-icons right">send</i>');
  }
  if ($('#department_save')) {
    $('#department_save').append('<i class="material-icons right">send</i>');
  }
})