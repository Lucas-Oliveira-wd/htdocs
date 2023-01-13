const body = document.querySelector('body');
const optValue = document.querySelector('#ult_bal_sel')
function showData (val){

    // Create an XMLHttpRequest object
const xhttp = new XMLHttpRequest();

// Define a callback function
xhttp.onload = function() {
  document.querySelector('#table_fund table tbody').innerHTML = this.responseText
}

// Send a request
xhttp.open("GET" ,"show_rank.php?q="+val );
xhttp.send();

}