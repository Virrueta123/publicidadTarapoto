<div class="card-body" id='calendar-container' wire:ignore>
    <div id='calendar'></div> 
</div>

@push('calendar')
    <script>
    document.addEventListener('livewire:load', function() {
        console.log(@this.events)
        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;
        var calendarEl = document.getElementById('calendar');

        var data = @this.events;
        
        var calendar = new Calendar(calendarEl, { 
 
        initialView: 'dayGridWeek',
        eventColor: '#2C3E50',
        locale: 'es',
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: 'dayGridMonth,dayGridWeek,dayGridDay today'
        },
        eventDrop: function(info){
            $("#body").block({ overlayCSS: { backgroundColor: '#00f'} ,message:"Cargando los datos" }); 
         
             @this.eventDrop(info.event, info.oldEvent).then(function(e){
                     $("#body").unblock();
                     if(e){
                        Swal.fire({
                         position: 'top-end',
                         icon: 'success',
                         title: 'Pendiente actualizado correctamente',
                         showConfirmButton: false,
                         timer: 1000                            
                        }) 
                     }else{
                        Swal.fire({
                         position: 'top-end',
                         icon: 'error',
                         title: 'no se actualizada correctamente',
                         showConfirmButton: false,
                         timer: 1000                            
                        }) 
                     }
                     
             })
        },
        eventClick: function(info){
            $("#body").block({ overlayCSS: { backgroundColor: '#00f'} ,message:"Cargando los datos" }); 
            @this.eventInfo(info.event.id).then(function(e){ 
                $("#body").unblock();
                var data = JSON.parse(e)
                if(data.Rz != ""){
                    var cliente = data.Rz;
                }else{
                    var cliente = data.nombres;
                } 
                var url = '{{ route("Pendientes.edit", ":id") }}';
                url = url.replace(':id', data.id);

                var urlDelete = '{{ route("Pendientes.delete", ":id") }}';
                urlDelete = urlDelete.replace(':id', data.id);
                var html = `
                <div class="row col-2"> 
                        <div class="col-6">
                            <a href="${url}" class="text-info"><i class="fa fa-edit"></i></a>
                        </div>
                        <div class="col-6"> 
                             
                            <form method="POST" id="formdeletependientes${data.id}" action="${urlDelete}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit"  onclick="FormDeleteModal('pendientes${data.id}','estas segur@ que deseas eliminar este pendiente',event)" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                            </form> 
                        </div> 
                </div>
                <hr>
                <ul class="list-group bg-white mb-3">
                  <li class="list-group-item">
                    <b>Cliente</b> <a class="float-right">${cliente}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Descipcion</b> <a class="float-right">${data.desc}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Fecha</b> <a class="float-right">${data.start}</a>
                  </li>
                </ul>`;


                console.log(e)
                Swal.fire({
                    title: '<strong>Info <u>Del trabajo pendiente</u></strong>',
                    icon: 'info',
                    html: html,
                    showCloseButton: true,
                    showCancelButton: true,
                    focusConfirm: false,
                   
                    confirmButtonAriaLabel: 'Thumbs up, great!',
                    cancelButtonText:
                        '<i class="fa fa-"></i> cerrar',
                    cancelButtonAriaLabel: 'Thumbs down'
                })
            })
        },
        editable: true,
        events: JSON.parse(data)
        });
        calendar.render();  
    });
    </script>
@endpush