tinymce.init({selector:'textarea'});

/*
var allInputs = document.getElementsByTagName("selectAllBoxes");
for (var i = 0, max = allInputs.length; i < max; i++){
    if (allInputs[i].type === 'checkbox')
        allInputs[i].checked = true;
}
*/

$(document).ready(function(){
    //make when check the first checkbox then select automatically all checkboxes
    $('#selectAllBoxes').click(function(event){
        if(this.checked) {
            $('.checkBoxes').each(function(){
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function(){
                this.checked = false;
            });
        }
    });
});
