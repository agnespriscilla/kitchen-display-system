<form action="" method="get" class="mb-2">
    <div class="d-flex align-items-center gap-2 flex-wrap">
        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 6px 10px; border-radius: 2px;">
            <i class="fa fa-calendar"></i>&nbsp;
            <span></span> <i class="fa fa-caret-down"></i>
            <input type="hidden" name="awal" id="start_date">
            <input type="hidden" name="akhir" id="end_date">
        </div>
        <button type="submit" name="filter" class="btn btn-primary btn-sm text-white">
            <i class="fas fa-filter"></i> Filter
        </button>
        @if (request()->has('filter'))
        <a href="{{ route('admin.log.akses') }}" class="btn btn-secondary btn-sm text-white">
            <i class="fas fa-rotate-left"></i> Refresh
        </a>
        @endif
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        //inisialisasi $awal dan $akhir di controller
        var start = moment("{{ $awal }}");
        var end = moment("{{ $akhir }}");

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#start_date').val(start.format('YYYY-MM-DD'));
            $('#end_date').val(end.format('YYYY-MM-DD'));
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Hari ini': [moment(), moment()],
                'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                    'month').endOf('month')],
                'Tahun ini': [moment().startOf('year'), moment().endOf('year')],
                'Tahun Kemarin': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1,
                    'year').endOf('year')]
            }
        }, cb);

        cb(start, end);
    });
</script>