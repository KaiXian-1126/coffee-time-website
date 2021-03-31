function search_function() {
// Declare variables
var search_input;
var filter;
var table;
var tr;
var td;
var i;
var value_name;

search_input  = document.getElementById("search");
filter        = search_input.value.toUpperCase();//convert ur input text to uppercase
table         = document.getElementById("User_table");//get <table>
tr            = table.getElementsByTagName("tr"); //tengok ada brp <tr> inside <table>

// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
  td = tr[i].getElementsByTagName("td")[1];// count from 0, so ur item coloum is = 1, Borrowed Quantity is =2
    console.log(td)
  if (td) {
    value_name = td.textContent || td.innerText; //take the item name
    console.log(value_name);

    if (value_name.toUpperCase().indexOf(filter) > -1) {
      tr[i].style.display = "";
    } else {
      tr[i].style.display = "none";
    }
  }
}
}
function searchItem(){
  var name = document.getElementsByName('search-item')[0].value.toUpperCase();
  var itemNameElem = document.getElementsByClassName('item-name');
  var itemListLength = document.getElementsByClassName('item-info').length;
  for ( i = 0 ; i < itemListLength ; i++){
      if(itemNameElem[i].textContent.toUpperCase().indexOf(name)==-1 || itemNameElem[i].innerText.toUpperCase().indexOf(name) ==-1){
          document.getElementsByClassName('item-info')[i].style.display = "none";
      }else{
          document.getElementsByClassName('item-info')[i].style.display = "";
      }
  }
}