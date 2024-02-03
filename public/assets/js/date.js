document.addEventListener('DOMContentLoaded', function() {
  var input = document.getElementById('tanggal_lahir');

  // Add event listener for when input loses focus
  input.addEventListener('change', function() {
      // Get selected date
      var date = new Date(input.value);

      // Format the date as dd mm yyyy
      var formattedDate = ("0" + date.getDate()).slice(-2) + ' ' + ("0" + (date.getMonth() + 1)).slice(-2) + ' ' + date.getFullYear();

      // Set the input value to the formatted date
      input.value = formattedDate;
  });
});
