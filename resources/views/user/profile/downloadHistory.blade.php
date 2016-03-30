
@extends('user.profile.profileLayout')

    @section('tab-content')

        <div>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Download Size</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($downloadHistoryList as $item)
                        <tr>
                            <th scope="row">{{ $item->title }}</th>
                            <td><span class="download-size">{{ ($item->size / 1024 / 1024 > 0.1)? number_format($item->size / 1024 / 1024, 1) . 'MB' : number_format($item->size / 1024, 1) . 'KB' }}</span></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <hr>

                    <div class="page-control text-center">
                        <?php echo $downloadHistoryList->render(); ?>
                    </div>
                </div>
            </div>
        </div>

    @stop

@stop
