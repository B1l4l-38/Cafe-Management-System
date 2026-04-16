function validateFields() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const submitButton = document.getElementById('submitButton');
  
    if (username.trim() !== '' && password.trim() !== '') {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
  }
  
  document.getElementById('username').addEventListener('input', validateFields);
  document.getElementById('password').addEventListener('input', validateFields);