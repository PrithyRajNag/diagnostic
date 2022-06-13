</div>

<x-footer-section></x-footer-section>

</div>
</div>

<script src="{{asset('assets/js/jquery-3.5.1.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/js/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('assets/vendors/choices.js/choices.min.js')}}"></script>
<script src="{{asset('assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/js/pages/dashboard.js')}}"></script>
<script src="{{asset('assets/js/highlight.min.js')}}"></script>
<script src="{{asset('assets/js/quill.js')}}"></script>
<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>

<script src="{{asset('assets/js/quillDeltaToHtmlConverter.bundle.js')}}"></script>


<script>
    $("#sidebar .has-sub").on('click',function (e){
        console.log('clicked')
        var $this = $(this);
        // console.log($this.parent().children('.has-sub').children('.submenu'))
        if ($(e.target).parent().find('.submenu').hasClass('active')) {
            $(e.target).parent().find('.submenu').removeClass('active');
        } else {
            $(e.target).parent().find('.submenu').addClass('active');

        }

    })
    $(document).ready(function () {
        $("#alert").fadeTo(5000, 500).slideUp(500, function () {
            $("#alert").slideUp(500);
        });
    });

    $(".select2").select2({
        allowClear: true
    })
    // Validation For Restrict Taking Date
    let dtToday = new Date();

    let month = dtToday.getMonth() + 1;
    let day = dtToday.getDate();
    let year = dtToday.getFullYear();
    if (month < 10)
        month = '0' + month.toString();
    if (day < 10)
        day = '0' + day.toString();

    let prepareDate = year + '-' + month + '-' + day;

    // Validation For Restrict Taking Past Date Only Take Future Date
    $('.take_future_date').attr('min', prepareDate);
    // Validation For Restrict Taking Past Date Only Take Future Date Ends

    // Validation For Restrict Taking Future Date Only Take Past Date
    $('.take_past_date').attr('max', prepareDate);
    // Validation For Restrict Taking Future Date Only Take Past Date Ends
</script>
@stack('customScripts')
</body>
</html>
