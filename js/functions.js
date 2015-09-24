/**
 * Created by lahiru on 9/20/2015.
 */

////////////////////// add username input field ///////////////////////
var counterText = 0;
var counterLimit = 1;
function addUsernameTextField(divName){
    var field = document.createElement('div');
    if (counterText != counterLimit) {
        field.innerHTML = "<input type='text' name='username' placeholder='Username'>";
        counterText++;
    }
    document.getElementById(divName).appendChild(field);
    field.disabled();
}

//////////////////////////////////// end of function ///////////////////////////////////////


//// This is the event handler to check the registered OTHER PERSON s/////
$(document).ready(function(){
    $('#cb1').click(function(){
        if($(this).prop("checked") == true){
            alert("Checked");
            $('#cb1_feedback').html('Get username only');
        }
        else if($(this).prop("checked") == false){
            alert("Unchecked");
            $('#cb1_feedback').html('Get all details');
        }
    });
});
/////// END ///////