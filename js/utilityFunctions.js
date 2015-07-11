function getValues(functionToExecute){ 
    $('input').each(function(){
        var current=$(this);               
        var id=current.attr('id');
        attributes[id]=current.val();
        if(!isNumeric(attributes[id])){ 
            attributes[id]=Number(current.attr('placeholder'));
        }
        else {
            attributes[id]=Number(attributes[id]);
        }    
        if(functionToExecute){
            functionToExecute(id, attributes, current);
        }        
    });
}
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
} 