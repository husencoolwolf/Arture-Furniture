function copyToClipboard(text) {
  var textField = document.createElement('textarea');
  textField.innerText = text;
  document.body.appendChild(textField);
  textField.select();
  textField.focus(); //SET FOCUS on the TEXTFIELD
  document.execCommand('copy');
  textField.remove();
}