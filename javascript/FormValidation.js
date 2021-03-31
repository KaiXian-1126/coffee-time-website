function ItemFormValidation(){
    var itemname = document.getElementsByName('itemname')[0].value;
    var brand = document.getElementsByName('brand')[0].value;
    var price = document.getElementsByName('price')[0].value;
    var image = document.getElementsByName('image')[0].value;
    if( itemname == ""){
        alert('Item name field cannot be blanked.');
        return false;
    }else{
        if(brand == ""){
            alert('Item brand field cannot be blanked.');
            return false;
        }else{
            if(price == ""){
                alert('Price field cannot be blanked.');
                return false;
            }else{
                if(image == ""){
                    alert('Please upload a image file');
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
}
function UpdateFormValidation(){
    var itemname = document.getElementsByName('itemname')[0].value;
    var brand = document.getElementsByName('brand')[0].value;
    var price = document.getElementsByName('price')[0].value;
    if( itemname == ""){
        alert('Item name field cannot be blanked.');
        return false;
    }else{
        if(brand == ""){
            alert('Item brand field cannot be blanked.');
            return false;
        }else{
            if(price == ""){
                alert('Price field cannot be blanked.');
                return false;
            }else{
                    return true;
            }
        }
    }
}
function AdvertisementFormValidation(id){
    var image = document.getElementsByName('advertisement')[id].value;
    if(image == ""){
        alert('Please upload a image file');
        return false;
    }else{
        return true;
    }
}
function AdvertisementFormValidation(){
    var image = document.getElementsByName('advertisement')[0].value;
    if(image == ""){
        alert('Please upload a image file');
        return false;
    }else{
        return true;
    }
}
function signUpValidation(){

    if(document.getElementsByName('firstname')[0].value == ''||document.getElementsByName('lastname')[0].value == ''){
        alert("Name field cannot be blanked.");
        return false;
    }

    else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementsByName("email")[0].value)){

      alert("Please enter valid email address");
      return false;
    }

    else if(document.getElementsByName('password')[0].value==""){
      alert("Please enter your password");
    }

    else if(document.getElementsByName('password')[0].value!=document.getElementsByName('cpassword')[0].value){
      alert("The confirm password is no match.");
      return false;
    }

    else if(document.getElementsByName('birthday')[0].value==""){
      alert("Please enter your birthday");
    }
    else{
      document.getElementById("sign_up_form").submit();
    }

}
function updatevalidation(){
    var table;
    var tr;
    
    table= document.getElementById("User_table");
    tr= table.getElementsByTagName("tr");
    
      for(i=0;i<(tr.length-1);i++){
        if(document.getElementsByName("fname[]")[i].value==""){
          alert("Please fill in the first name at row "+(i+1));
          return false;
        }
        else if(document.getElementsByName("lname[]")[i].value==""){
          alert("Please fill in the last name at row"+(i+1));
          return false;
        }
        else if(document.getElementsByName("email[]")[i].value==""){
          alert("Please fill in email at row"+(i+1));
          return false;
        }
        else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementsByName("email[]")[i].value)){
          alert("Enter valid email at row"+(i+1));
          return false;
        }
    
        else if(document.getElementsByName("birthday[]")[i].value==""){
          alert("Please fill in the birthday at row"+(i+1));
          return false;
        }
        for(j=0;j<i;j++){
          
          if(document.getElementsByName("email[]")[i].value==document.getElementsByName("email[]")[j].value){
            alert("The email already used at row "+(i+1));
            return false;
          }
        }
        }
        document.getElementById("update_form").submit();
      }
    