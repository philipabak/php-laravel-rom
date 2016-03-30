
@extends('user.profile.profileLayout')

    @section('tab-content')

        <div id="tab-6">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchaseHistoryList as $item)
                            <tr>
                                <th scope="row">{{ $item->item }}</th>
                                <td><span class="download-size">${{ number_format($item->price, 2) }}</span></td>
                                <td>{{ $item->quantity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <hr>

                    <div class="page-control text-center">
                        <?php echo $purchaseHistoryList->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    @stop

@stop
