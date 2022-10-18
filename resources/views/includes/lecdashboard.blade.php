<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Students Failed
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <h3>
                                <?php use Illuminate\Support\Facades\DB;$counter = 0 ?>
                                @foreach($failCounts as $key=> $failCount)
                                    @if (auth()->user()->id === $failCount->user_id)
                                        @if ($failCount->grades <= 46)
                                            <?php $counter++?>
                                        @endif
                                    @endif
                                @endforeach
                                <span class="badge badge-danger"> {{$counter}}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Student Passed
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php $counter = 0 ?>
                            @foreach($passCounts as  $passCount)
                                @if (auth()->user()->id === $passCount->user_id)
                                    @if ($passCount->grades >= 47)
                                        <?php $counter++?>
                                    @endif
                                @endif
                            @endforeach
                            <h3><span class="badge badge-success">{{$counter}}</span></h3>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Students Average Scores
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                @if ($avgCounts != 0)

                                <div
                                    class="h5 mb-0 mr-3 font-weight-bold {{round($avgCounts/$counts) <= '50' ? 'text-danger' : 'text-success'}}">{{ round($avgCounts/$counts)}}
                                    %
                                </div>
                                @endif
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    @if ($avgCounts != 0)
                                    <div
                                        class="progress-bar {{round($avgCounts/$counts) <= '50' ? 'bg-danger' : ' bg-info'}} progress-bar-animated"
                                        role="progressbar" style="width: {{ round($avgCounts/$counts)}}%"
                                        aria-valuenow="{{ round($avgCounts/$counts)}}%" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Courses</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <h3>
                                <span class="badge badge-warning">
                                    {{count(auth()->user()->courses)}}
                                </span>
                            </h3>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-chalkboard fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of Content Row -->

<div class="alert alert-light border-warning">
    <div class="row">
        <div class="col-xs-6 col-md-6">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart"
                         id="{{count(auth()->user()->courses) <= 5 ? 'easypiechart-red' : 'easypiechart-teal'}}"
                         data-percent="{{count(auth()->user()->courses)}}">
                            <span
                                class="percent {{count(auth()->user()->courses) <= 3 ? 'text-danger' : 'text-success'}}">
                                    {{$counts}} Course
                            </span>
                    </div>
                    <small>Total Semesters Courses</small>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">

                <div class="panel-body easypiechart-panel">
                    @if ($avgCounts != 0)
                    <div class="easypiechart"
                         id="{{round($avgCounts/$counts) <= 49 ? 'easypiechart-red' : 'easypiechart-teal'}}"
                         data-percent="{{ round($avgCounts/$counts) }}">
                            <span class="percent {{round($avgCounts/$counts) <= 49 ? 'text-danger' : 'text-success'}}">
                                {{ round($avgCounts/$counts) }}%
                            </span>
                    </div>
                    @elseif($avgCounts == 0)
                        <div class="easypiechart"
                             id="{{'easypiechart-red'}}"
                             data-percent="{{ 0 }}">
                            <span class="percent {{'text-danger'}}">
                                {{ 0 }}%
                            </span>
                        </div>
                    @endif
                    <small>Total Average Score</small>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <div class="easypiechart"
                         id="{{$maxCounts <= 49 ? 'easypiechart-red' : 'easypiechart-teal'}}"
                         data-percent="{{$maxCounts}}">
                            <span class="percent {{$maxCounts <= 49 ? 'text-danger' : 'text-success'}}">
                                {{$maxCounts}}%
                            </span>
                    </div>
                    <small>Max Score</small>
                </div>
            </div>
        </div>
    </div>
</div><!--/.row-->

