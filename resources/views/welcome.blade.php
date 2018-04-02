@extends('layouts.app')

<style>

body {
  margin: 0;
  padding: 0;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
}

#calendar {
  font-size: 14px;
  max-width: 900px;
  margin: 40px auto;
  padding: 0 10px;
}

</style>

@section('content')

    <div id='calendar'></div>

@endsection

@section('js')
  <link href={{ asset('/../calendar/fullcalendar.min.css') }} rel='stylesheet' />
  <link href={{ asset('/../calendar/fullcalendar.print.min.css') }} rel='stylesheet' media='print' />
  <script src={{ asset('/../calendar/lib/moment.min.js') }} ></script>
  <script src={{ asset('/../calendar/lib/jquery.min.js') }} ></script>
  <script src={{ asset('/../calendar/fullcalendar.min.js') }} ></script>
  <script src={{ asset('/../calendar/locale-all.js') }}></script>
  <script>

    $(document).ready(function() {
      var initialLocaleCode = 'en';

      $('#calendar').fullCalendar({
        header: {
          left: 'prev today next',
          center: 'title',
          right: 'month,agendaWeek,agendaDay,listMonth'
        },
        locale: initialLocaleCode,
        buttonIcons: true, // show the prev/next text
        weekNumbers: true,
        navLinks: true, // can click day/week names to navigate views
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: '/getEvents'
      });

      // build the locale selector's options
      $.each($.fullCalendar.locales, function(localeCode) {
        $('#locale-selector').append(
          $('<option/>')
            .attr('value', localeCode)
            .prop('selected', localeCode == initialLocaleCode)
            .text(localeCode)
        );
      });

      // when the selected option changes, dynamically change the calendar option
      $('#locale-selector').on('change', function() {
        if (this.value) {
          $('#calendar').fullCalendar('option', 'locale', this.value);
        }
      });
    });

  </script>
@endsection
