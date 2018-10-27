let plusOneHour=(date)=>{
    h=date.substr(11,2);
    h=parseInt(h);
    h+=1;
    if(h<10){
        h='0'+h;
    }
    return date.substring(0,11)+h+date.substr(13);
};

let saveAppointment = ()=>{
    events=cal.fullCalendar('clientEvents',function (legacyEventInstance) {return legacyEventInstance.created == 'now'});
    if(events.length){
        var parametros = {
            "token":token,
            "fecha":events[0].start.format().substr(0,10),
            "horaInicio":events[0].start.format().substr(11,8),
            "horaFin":events[0].end.format().substr(11,8),
            "descripcion":events[0].description,
            "userId":userId,
            "doctorId":doctorId
        };
        $.ajax({
            url : './request/saveAppoinment.php',
            data : parametros,
            type : 'POST',
            success : function(res) {
                console.log(res);
                setTimeout(function(){ window.location.reload(false); },3000);
            },
            error : function(xhr, status) {
                alert('Disculpe, existió un problema');
            },
            complete : function(xhr, status) {
                //console.log('Petición realizada');
            }
        });
    }
};
let event;
$(document).ready(function() {
    $('#addBtn').click(()=>{
        if(cal.fullCalendar('clientEvents',function (legacyEventInstance) {return legacyEventInstance.status == 'pendient'}).length){
            alert('Ya tienes una cita pendiente!');
        }else{
            $('#calendar').fullCalendar('renderEvent',event);
            saveAppointment();
            
        }
    });
$('#my-draggable').draggable({
    revert: true,      // immediately snap back to original position
    revertDuration: 0  //
});


cal=$('#calendar').fullCalendar({
    themeSystem: 'bootstrap4',
    defaultView: 'agendaWeek',
    //selectable: true,
    header: {
        left: 'title',
        center: 'agendaDay,agendaWeek',
        right: 'prev,next today  ',
            close: 'fa-times',
            prev: 'fa-chevron-left',
            next: 'fa-chevron-right',
            prevYear: 'fa-angle-double-left',
            nextYear: 'fa-angle-double-right'
        
    },
    customButtons: {
        save1: {
            text: 'save',
            className:'',
            click: function() {
            //alert('clicked save button!');
            //saveAppointment();
            }
        },
        prev:{
           click:()=>{ 
               if($('#calendar').fullCalendar('getDate').format()<=moment().format()){
                console.log('No Puedes ir mas atras');
               }else{
                   $('#calendar').fullCalendar('prev');
               }
            }
        }
    },
    slotLabelFormat: 'h:mm a',
    views: {
        week: { 
            columnFormat:'ddd D'
                    //titleFormat: 'MMMM '
                // other view-specific options here
                }
    },
    //defaultDate: '2018-10-28',
    weekNumbers: false,
    allDaySlot: false,
    firstDay: 1,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    eventLimit: true, // allow "more" link when too many events
    droppable: true,
    drop: function(date) {
        alert("Dropped on " + date.format());
    },
    dayClick: function(date) {
        dates=new Date();
        lo=dates.getDate()+'-'+(dates.getMonth()+1)+'-'+dates.getFullYear()
        console.log(moment().format()<date.format());
        if(moment().format()<date.format()){
            console.log('motrar');
            $('#modalCitar').modal('toggle');
        }else{
            alert('No puedes seleccionar fechas anteriores a las actual');
        }
        $('#modalCitar .Titulo').html();
        $('#modalCitar .Fecha').html('<p>Tu cita sera programada para el <b>'+date.format('dddd DD')+' de '+date.format('MMMM, YYYY')+'</b> a las <b>'+date.format('h:mm a')+'</b>'+
            ' con el doctor <b>'+doctorName+'</b>. Si deseas dejarle un mensaje puedes hacerlo en el recuadro de abajo</p>');
       event={
            title: 'Patient Name',
            start:date.format(),
            end:plusOneHour(date.format()),
            description:$('#modalCitar .Descripcion').val(),
            color:'green',
            created:'now',
            status:'pendient',
            allDay: false
            };
        //alert('clicked ' + date.format());
    },
    events: {
        url: './request/workDays.php',
        data:{
            token:token,
            id:doctorId,
            userId:userId
        },
        error: function() {
        $('#script-warning').show();
        }
    }
});

});