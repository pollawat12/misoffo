@extends('default.layouts.main')


@section('css')
<!-- Plugin css -->
{{-- <link href="{{url('assets/default')}}/libs/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" /> --}}

<link rel="stylesheet" href="{{ url('assets/js/fullcalendar-5.9.0/lib/main.css') }}">

<style>
    .fc-list-table .fc-list-event-title {
        text-align: left;
    }
    .fc-toolbar-title {
        font-size: 25px !important;
    }
</style>
@endsection


@section('content')

<div class="content">
                    
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">ภาพรวม</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">แดชบอร์ด</a></li>
                            <li class="breadcrumb-item active">ปฏิทินกิจกรรม</li>
                        </ol>
                    </div>
                    <h4 class="page-title">ปฏิทินกิจกรรม</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-lg-12">

                <div class="card-box">
                    <div class="row">
                        

                        <div class="col-lg-12">
                            <div id="calendar"></div>
                        </div> <!-- end col -->
                    </div>  <!-- end row -->
                </div>



             
                <!-- BEGIN MODAL -->
                <div class="modal fade none-border" id="event-modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Add New Event</h4>
                            </div>
                            <div class="modal-body pb-0"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                                <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Add Category -->
                <div class="modal fade none-border" id="add-category" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Add a category</h4>
                            </div>
                            <div class="modal-body pb-0">
                                <form class="form">
                                    <div class="form-group">
                                        <label class="control-label">Category Name</label>
                                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category-name"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Choose Category Color</label>
                                        <select class="form-control form-white" data-placeholder="Choose a color..." name="category-color">
                                            <option value="success">Success</option>
                                            <option value="danger">Danger</option>
                                            <option value="info">Info</option>
                                            <option value="pink">Pink</option>
                                            <option value="primary">Primary</option>
                                            <option value="warning">Warning</option>
                                            <option value="inverse">Inverse</option>
                                        </select>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-danger waves-effect waves-light save-category" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END MODAL -->
            </div>
            <!-- end col-12 -->
        </div> <!-- end row -->

        {{-- @forEach($meeting_lists as $item)
            <P>{{$item->status_approved}}</P>
        @endforeach --}}

        
        
    </div> <!-- end container-fluid -->

</div> <!-- end content -->

@endsection


@section('js')
<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- Vendor js -->
<script src="{{url('assets/default')}}/js/vendor.min.js"></script>

<!-- plugin js -->
<script src="{{url('assets/default')}}/libs/moment/moment.min.js"></script>
<script src="{{url('assets/default')}}/libs/jquery-ui/jquery-ui.min.js"></script>

<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/main.js') }}"></script>
<script src="{{ url('assets/js/fullcalendar-5.9.0/lib/locales-all.js') }}"></script>

{{-- <script src="{{url('assets/default')}}/libs/fullcalendar/fullcalendar.min.js"></script>
<script src="{{ url('assets/js/fullcalendar/lang/langs/th.js') }}"></script>
<!-- Calendar init -->
<script src="{{url('assets/default')}}/js/pages/calendar.init.js"></script> --}}

<!-- Google Charts js -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
    
      var initialLocaleCode = 'th';
      var localeSelectorEl = document.getElementById('locale-selector');
      var calendarEl = document.getElementById('calendar');

      var meetingRoom = <?php echo json_encode($meeting_lists) ?>;
         console.log(meetingRoom);

      var meetingCar = <?php echo json_encode($meeting_car) ?>;
         console.log(meetingCar);  


    
    let arrRoom = [];

    let arrCar = [];



    meetingRoom.forEach(data_room => {   
        var valueToPush = { }; // or "var valueToPush = new Object();" which is the same
        valueToPush["title"] = data_room.title;
        valueToPush["start"] = data_room.date_start;
        valueToPush["end"] = data_room.date_end;
        valueToPush["color"] = '#6495ED';

        arrRoom.push(valueToPush);
                });
        console.log(arrRoom);


    meetingCar.forEach(data_car => {   
        var valueToPush = { }; // or "var valueToPush = new Object();" which is the same
        valueToPush["title"] = data_car.title;
        valueToPush["start"] = data_car.date_start;
        valueToPush["end"] = data_car.date_end;
        valueToPush["color"] = '#FA8072';

        arrCar.push(valueToPush);
                });
        console.log(arrCar);


      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'listMonth',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        initialDate: "{{ date('Y-m-d') }}",
        locale: initialLocaleCode,
        buttonIcons: false, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        dayMaxEvents: true, // allow "more" link when too many event
        events: arrCar.concat(arrRoom)
      });
  
      calendar.render();
  
      // build the locale selector's options
      calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
        var optionEl = document.createElement('option');
        optionEl.value = localeCode;
        optionEl.selected = localeCode == initialLocaleCode;
        optionEl.innerText = localeCode;
        // localeSelectorEl.appendChild(optionEl);
      });
  
      // when the selected option changes, dynamically change the calendar option
    //   localeSelectorEl.addEventListener('change', function() {
    //     if (this.value) {
    //       calendar.setOption('locale', this.value);
    //     }
    //   });
  
    });
  
</script>
@endsection