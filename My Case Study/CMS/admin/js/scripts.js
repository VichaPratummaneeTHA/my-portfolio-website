//tinymce.init({selector:'textarea'});


$(document).ready(function(){
    
    //Editor CK editor
    
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error ); 
    });
    
    //Rest of the code
            
    $('#selectAllBoxes').click(function(event){
                               
        if(this.checked) {
        
        $('.checkBoxes').each(function(){
                              
            this.checked = true;
                              
        });
        
    } else{
        
        $('.checkBoxes').each(function(){
            
            this.checked = false;
        });
    }                                                   
});
    
//$("body").prepend("helloWorld");   
    
//var div_box = " <div id='load-screen'><div id='loading'></div></div> ";
//
//$(" body").prepend(div_box);
//    
//$(' #load-screen').delay(700).fadeOut(600, function(){
//    $(this).remove();
//});
//    
    
    
});

//function loadUsersOnline()
//{
//    $.get("/cms/admin/function.php?onlineusers=result", function(data){
//        
//        $(".usersonline").text(data);
//    });   
//}
//
//setInterval(function(){
//    
//  loadUsersOnline();  
//},500);



