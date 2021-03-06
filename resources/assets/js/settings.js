var ajax = require('./ajax.js');
var alerts = require('./alerts.js');

function changePasswordEvent() {
  let button = document.getElementById('update_password');
  if(button == null) return;
  button.addEventListener('click', function(){
    let old_password = document.getElementById("old_password").value;
    let new_password = document.getElementById("new_password").value;
    let repeat_new_password = document.getElementById("repeat_new_password").value;

    if(new_password != repeat_new_password) {
      alerts.addTimedError("The new passwords don't match.");
      return;
    }

    ajax.sendAjaxRequest('POST', '/users/settings/change_password',
      { old_password: old_password, new_password: new_password, new_password_confirmation: repeat_new_password },
      function() {
        if(this.status == 200)
          alerts.addTimedSuccess('Password changed!')
        else alerts.addTimedError(this.responseText);
      });
  });
}

changePasswordEvent();
