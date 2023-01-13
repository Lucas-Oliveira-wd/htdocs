// Create an XMLHttpRequest object
const xhttp = new XMLHttpRequest();

// Define a callback function
xhttp.onload = function() {
  document.querySelector('#table_fund table tbody').innerHTML = this.responseText
}

// Send a request
xhttp.open("GET" ,"show_rank.php" );
xhttp.send();

