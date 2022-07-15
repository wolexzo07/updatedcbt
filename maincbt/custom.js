$(document).ready(function(){

$(":text").attr("autocomplete" ,"off");

$(".stud_per").click(function(){
$("#student_score").hide();

$("#scor").show();
$(".exam_ins , .per_user , .exam_ass , .exam_pr").show("slower");

});


$(".scor").click(function(){
$("#scor").slideUp();
});

$(".per_user").click(function(){
$("#perso_pro").slideDown();

$("#exam_ass").slideUp();
$("#scor").slideUp();
$(".exam_ins , .per_user , .exam_ass , .exam_pr").hide();


});




$(".exam_ass").click(function(){
$("#student_score").slideDown();

$("#scor").slideUp();
$(".exam_ins , .per_user , .exam_ass , .exam_pr").hide();


});



$(".exam_ins").click(function(){
$("#instru").slideDown();
$("#scor").slideUp();
$(".exam_ins , .per_user , .exam_ass , .exam_pr").hide();

});

$(".instru_per").click(function(){
$("#instru").slideUp();
$("#scor").slideDown();
$(".exam_ins , .per_user , .exam_ass , .exam_pr").fadeIn("slow");


});

$(".pro_per").click(function(){
$("#perso_pro").slideUp();
$(".exam_ins , .per_user , .exam_ass , .exam_pr").slideDown("slow");

$("#scor").slideDown();

});





$(".recheck").mouseover(function(){
$(".recheck").attr("src","img/chkk.png")
$(".recheck").mouseout(function(){
$(".recheck").attr("src","img/chk.png")

});
});






$(".per_user").mouseover(function(){
$(".per_user").attr("src","image/per1.png")
$(".per_user").mouseout(function(){
$(".per_user").attr("src","image/per.png")

});
});

$(".sel1").mouseover(function(){
$(".sel1").attr("src","img/select2.png")
$(".sel1").mouseout(function(){
$(".sel1").attr("src","img/select1.png")

});
});

$(".vewp1").mouseover(function(){
$(".vewp1").attr("src","img/viewp2.png")
$(".vewp1").mouseout(function(){
$(".vewp1").attr("src","img/viewp1.png")

});
});

$(".vewi1").mouseover(function(){
$(".vewi1").attr("src","img/view_ins2.png")
$(".vewi1").mouseout(function(){
$(".vewi1").attr("src","img/view_ins1.png")

});
});

$(".vewe1").mouseover(function(){
$(".vewe1").attr("src","img/view_ex2.png")
$(".vewe1").mouseout(function(){
$(".vewe1").attr("src","img/view_ex1.png")

});
});


$(".logout").mouseover(function(){
$(".logout").attr("src","image/logout.png").attr("style","width:30px").attr("title","Please press this button to logout or press ALT + L")
$(".logout").mouseout(function(){
$(".logout").attr("src","image/logout.png").attr("style","width:20px")

});
});



$(".n1").mouseover(function(){
$(".n1").attr("src","image/n2.png").attr("title","Please press this button to take you to the next question or press ALT + N")
$(".n1").mouseout(function(){
$(".n1").attr("src","image/n1.png")

});
});


$(".p1").mouseover(function(){
$(".p1").attr("src","image/p2.png").attr("title","Please press this button to take you to the previous question or press ALT + P")
$(".p1").mouseout(function(){
$(".p1").attr("src","image/p1.png")

});
});


$(".exam_ass").click(function(){
$("#exam_ass").slideToggle();

$("#perso_pro").slideUp();



});


$(".exam_ass").mouseover(function(){
$(".exam_ass").attr("src","image/exam1.png")
$(".exam_ass").mouseout(function(){
$(".exam_ass").attr("src","image/examm.png")

});
});

$(".lbt").mouseover(function(){
$(".lbt").attr("src","image/lobt.png")
$(".lbt").mouseout(function(){
$(".lbt").attr("src","image/l.png")

});
});

$(".exam_ins").mouseover(function(){
$(".exam_ins").attr("src","image/exam_ins1.png")
$(".exam_ins").mouseout(function(){
$(".exam_ins").attr("src","image/exam_ins.png")

});
});

$(".exam_pr").mouseover(function(){
$(".exam_pr").attr("src","image/pe1.png")
$(".exam_pr").mouseout(function(){
$(".exam_pr").attr("src","image/pe.png")

});
});



});
