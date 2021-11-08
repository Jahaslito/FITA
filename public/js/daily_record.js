$(document).ready(function() {
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv','excel','pdf',
        ]
    });
});


var date= $("#date");
var symptom= $("#symptom");
var answer= $("#answer");
var question= $("#question");



function questionFilterChange() {
    if(question.val()!="none"){
        $(".answer").show();
    }else{
        $(".answer").hide();
    }
    console.log("called 2");
}

function checkSelected() {
   
    let dateData= (date.val()!="") ? date.val(): null;
    let symptomData= (symptom.val()!="not-selected") ? symptom.val(): null;
    let questionData= (question.val()!="none") ? question.val(): null;
    let answerData= (question.val()!="none") ? answer.val(): null;
    
    let postData= {
        dateData: dateData,
        symptomData: symptomData,
        questionData: questionData,
        answerData: answerData
    }
    return postData;
}
//Adding the csrf tkoen in ajax request

$(document).ready(function() {    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("select, #date").change(function() {
        questionFilterChange();
        let formData= (checkSelected());
        $.ajax(
        {
            processData: true,
            url:'/filter_table',
            type:'post',
            data:formData,
            success: function(result) {
                $("#tbody").html(result);

            },
            error: function(result) {
                console.log(result);
            }
        });
       
    });
});
