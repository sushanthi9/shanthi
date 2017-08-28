//$ sign in jquery is object library
$(document).ready(
    function(){
    //anonymous function will be run when document is loaded
    //onCountryChange is a 
    $("#country").on("change" , onCountryChange);
    }
);

function onCountryChange(evt){
    //console.log("changed");
    //prepare ajax request
    //get selected country
    let selected_country = $(evt.target).val();
    console.log(selected_country);
    let data = {"country": selected_country};
    //send data to ajax handler
    //request to server from  page
    $.ajax({
        type: 'post',
        url: 'ajax/getstates.php',
        data: data,
        dataType: 'json',
        encode: true
    })
    .done(function(returndata){
        console.log(returndata);
        $('#state').empty();
        let count = returndata.length;
        for(let i=0; i<count ; i++){
            let item = returndata[i];
            //create option tag
            let option = document.createElement('OPTION');
            $(option).text(item.name);
            $(option).attr('value',item.code);
            //add it to the states select element
           // console.log(option);
            $('#state').append(option);
            
           // document.createElement('OPTION');
        }
    });
}

