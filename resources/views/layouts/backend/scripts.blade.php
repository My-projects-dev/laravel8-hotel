<!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="{{asset('assets/backend/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('assets/backend/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('assets/backend/vendor/jquery-nice-select/js/jquery.nice-select.min.js')}}"></script>

	<!-- Chart piety plugin files -->
    <script src="{{asset('assets/backend/vendor/peity/jquery.peity.min.js')}}"></script>

	<!-- Apex Chart -->
	<script src="{{asset('assets/backend/vendor/apexchart/apexchart.js')}}"></script>

	<script src="{{asset('assets/backend/vendor/bootstrap-datetimepicker/js/moment.js')}}"></script>
	<script src="{{asset('assets/backend/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>

	<!-- Dashboard 1 -->
	<script src="{{asset('assets/backend/js/dashboard/dashboard-1.js')}}"></script>
    <script src="{{asset('assets/backend/js/custom.min.js')}}"></script>
	<script src="{{asset('assets/backend/js/deznav-init.js')}}"></script>

    <!-- Datatable -->
	<script src="{{asset('assets/backend/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
{{--	<script src="{{asset('assets/backend/js/plugins-init/datatables.init.js')}}"></script>--}}


	<script>
		$(function () {
			$('#datetimepicker').datetimepicker({
				inline: true,
			});
		});

		$(document).ready(function(){
			$(".booking-calender .fa.fa-clock-o").removeClass(this);
			$(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
		});
	</script>
