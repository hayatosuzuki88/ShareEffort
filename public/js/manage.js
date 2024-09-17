$(function(){
    $("#goal_create_button").click(function(){
        $("#goal_create").css("display", "block");
        $("#calendar").css("display", "none");
        
    });
    
    $("#close_goal_create").click(function(){
        $("#goal_create").css("display", "none");
        $("#calendar").css("display", "block");
    });
    
    $("#plan_create_button").click(function(){
        $("#plan_create").css("display", "block");
        $("#calendar").css("display", "none");
    });
    
    $("#close_plan_create").click(function(){
        $("#plan_create").css("display", "none");
        $("#calendar").css("display", "block");
    });
    

});