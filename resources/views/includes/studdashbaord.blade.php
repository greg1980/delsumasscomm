
<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Failed Courses</div>
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
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Passed Courses</div>
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
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Average Score</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <?php $sum = 0; $avgCount = 0; $count = 0; $total = 1 ;?>
                                @foreach($avgCounts as $key=> $avgCount)
                                    @if (auth()->user()->id === $avgCount->id)
                                        <?php
                                        $sum+= $avgCount->grades;
                                        ?>
                                    @endif
                                    @foreach($counts as $count)
                                        @if (auth()->user()->id === $count->user_id)
                                            <?php   $total = $count->enrollment_count; ?>
                                        @endif
                                    @endforeach
                                @endforeach
                                <div class="h5 mb-0 mr-3 font-weight-bold {{round($sum/$total) <= '50' ? 'text-danger' : 'text-success'}}">{{ round($sum/$total)}}%</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar  bg-info progress-bar-animated" role="progressbar" style="width: {{ round($sum/$total)}}%" aria-valuenow="{{ round($sum/$total)}}%" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                @foreach($counts as $count)
                                        @if (auth()->user()->id === $count->user_id)
                                            {{$count->enrollment_count }}
                                        @endif
                                    @endforeach
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
                     <?php $counter = 0 ?>
                     @foreach($failCounts as $key=> $failCount)
                         @if (auth()->user()->id === $failCount->user_id)
                             @if ($failCount->grades <= 46)
                                 <?php $counter++?>
                             @endif
                         @endif
                     @endforeach
                     <h3 class="{{$counter >= 3 ? 'text-danger' : 'text-success'}} mt-3">
                         {!!  $counter >= 3 ? '<i class="fas fa-praying-hands"></i> You need to work harder to improve on your result !' : '<i class="fas fa-thumbs-up"></i> Good result keep it up.'!!}
                     </h3>
                 </div>
             </div>
         </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    <?php $sum = 0; $avgCount = 0; $count = 0;?>
                    @foreach($avgCounts as $key=> $avgCount)
                        @if (auth()->user()->id === $avgCount->id)
                           <?php
                              $sum+= $avgCount->grades;
                            ?>
                        @endif
                            @foreach($counts as $count)
                                @if (auth()->user()->id === $count->user_id)
                                 <?php   $total = $count->enrollment_count; ?>
                                @endif
                            @endforeach
                    @endforeach
                        <div class="easypiechart" id="{{round($sum/$total) <= 49 ? 'easypiechart-red' : 'easypiechart-teal'}}" data-percent="{{ round($sum/$total) }}" >
                            <span class="percent {{round($sum/$total) <= 49 ? 'text-danger' : 'text-success'}}">
                                {{ round($sum/$total) }}%
                            </span>
                        </div>
                    <small>Total Average Score</small>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3">
            <div class="panel panel-default">
                <div class="panel-body easypiechart-panel">
                    @foreach($maxCounts as $key=> $maxCount)
                        @if (auth()->user()->id === $maxCount->user_id)
                            <div class="easypiechart " id="{{$maxCount->enrollment_count <= 49 ? 'easypiechart-red' : 'easypiechart-blue'}}" data-percent="{{$maxCount->enrollment_count}}" >
                                <span class="percent {{$maxCount->enrollment_count <= 49 ? 'text-danger' : 'text-success'}} ">{{$maxCount->enrollment_count}}%</span>
                            </div>
                            <small>Max Score</small>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
     </div>
</div><!--/.row-->

