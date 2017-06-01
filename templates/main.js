$(document).ready(function(){
    load_data();
    function load_data(page){
        $.ajax({
            type: "POST",
            data: {page:page},
            url: "pagination",
            dataType: "html",
            async: false,
            success: function(data) {
                $('#pagination').html(data);
            }
        });
    }
    $(document).on('click','.pagination',function(){
       var page = $(this).attr("id");
       console.log(page);
       load_data(page);
    });
    $("#idform").submit(function(e) {
    var url = "form";
    console.log(url);
    $.ajax({
           type: "POST",
           url: url,
           data: $("#idform").serialize(),
           success: function(data)
           {
               console.log(data);
               load_data();
           }
         });
    e.preventDefault();
    });
    $(document).on('click','.update',function(){
        $(".form-update").show();
        var page = $(this).attr("id");
        $("#update").val(page);
       
       console.log(page);
       //load_data(page);
    });
    
    
    $("#updateform").submit(function(e) {
    var url = "update";
    console.log($("#updateform").serialize());
    $.ajax({
           type: "POST",
           url: url,
           data: $("#updateform").serialize(),
           success: function(data)
           {
               console.log(data);
               load_data();
           }
         });
    e.preventDefault();
    });
    
    $(document).on('click','.delete',function(e) {
    var url = "delete";
    var id = $(this).attr("id");
    console.log(id);
    $.ajax({
           type: "POST",
           url: url,
           data: 'id='+id,
           success: function(data)
           {
               console.log(data);
               load_data();
           }
         });
    e.preventDefault();
    });
    
    $(document).on('click','.logout',function(e) {
    var url = "logout";
    $.ajax({
           type: "POST",
           url: url,
           success: function(data)
           {
               console.log('out');
               load_data();
           }
         });
    e.preventDefault();
    });
});

