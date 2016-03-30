
@extends('user.category.categoryLayout')

    @section('tab-content')
        <style>
            .row{
                margin-right: -10px;!important;
            }
            .results-table{
                margin-left: 10px;!important;
            }
        </style>

        <div>
            <div class="row results-table">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>TITLE</th>
                        <th>FILE SIZE</th>
                        <th>POPULARITY</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fileList as $item)
                    <tr>
                        <th scope="row"><a href="{{ URL::route('user.details.details', array($parentItem->slug, $categoryItem->slug, $item->slug, 'details')) }}" class="file_title">{{ $item->title }}</a></th>
                        <td>{{ ($item->file_size / 1024 / 1024 > 0.1)? number_format($item->file_size / 1024 / 1024, 1) . 'MB' : number_format($item->file_size / 1024, 1) . 'KB' }}</td>
                        <td></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <hr>

                <div class="page-control text-center">
                    <?php echo $fileList->render(); ?>
                </div>
            </div>

        </div>
    @stop

@stop
