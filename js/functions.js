/**
 * Created by lahiru on 9/20/2015.
 */
var flimit = 3;
var counter = 0;
function createCopy(){
    if(counter<flimit-1){
        counter++;
        var itm = document.getElementById("subjectDet");
        var cln = itm.cloneNode(true);
        document.getElementById("container").appendChild(cln);
    }
    if(counter==flimit-1){
        alert('You have reached the maximum limit of '+flimit+' forms.');
    }
}

function removeCopy(){
    if(counter>0){
        document.getElementById("subjectDet").remove();
        counter--;
    }
    if(counter==0){
        alert('You have reached the minimum number of forms');
    }
}

function addSubjectCount(){
    var $newDiv = $("<div><h3>Subject Details number "+counter+" </h3></div>");
    $newDiv.appendTo($("#container"));
}
/////////////////////////////////////////////////////////////////////////////


////////////////////////


function showElement(id){
    document.getElementById(id).style.display = "inline";
    //$('#'+id).show();
}

function hideElement(id){
    document.getElementById(id).style.display = "none";
}

//to toggle a div element
function toggleDiv(id) {
    $("#" + id).toggle();
}

////////////////// auto suggestions function ///////////////////
function autoSuggest(dID,phpFile){
    //searchVal -> variable name to catch $_POST['searchVal']
    //phpFile -> where the searching done
    //dID -> display location
    var searchText = $("input[name = 'search']").val();
    $.post(phpFile,{searchVal:searchText},function(output){
        $('#'+dID).html(output);
    });
}


