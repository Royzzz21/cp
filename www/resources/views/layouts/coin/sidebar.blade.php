{{--First Table--}}
{{--<table class="table-bordered">--}}
    {{--<thead>--}}
    {{--<tr>--}}
        {{--<th class="head-table">MY PAGE</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--<tr>--}}
        {{--<td class="style3"> Welcome <span>admin</span></td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<th class="sub-title">--}}
            {{--BTC/PHP--}}
        {{--</th>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td>--}}
            {{--1016.50000000 BTC--}}
            {{--10,794 PHP--}}
        {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<th class="sub-title">--}}
            {{--BTC/PHP--}}
        {{--</th>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td>--}}
            {{--0.00000000 BTC--}}
            {{--0 PHP--}}
        {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<th class="sub-title">--}}
            {{--(HEDGE) BTC/PHP--}}
        {{--</th>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td>--}}
            {{--19,753 PHP--}}
            {{--<span style="color: red"> (1.70137812 BTC)</span>--}}
        {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<th class="sub-title">--}}
            {{--PHP--}}
        {{--</th>--}}
    {{--</tr>--}}
    {{--<tr>--}}
        {{--<td>--}}
            {{--11,821,947--}}
            {{---> 30,547 PHP--}}
            {{---> 1016.5 billion BTC--}}
        {{--</td>--}}
    {{--</tr>--}}
    {{--</tbody>--}}
{{--</table>--}}
{{--Second Table--}}

<table class="table-bordered quick-menu">
    <thead>
    <tr>
        <th class="head-quick align=left">Wallet</th>
    </tr>
    </thead>
    <tbody>
    {{--<tr>
        <th class="quick-sub">
            <a href="#">Wallet</a>
        </th>
    </tr>--}}

    <!--
    <tr>
        <td>
            <ul class="quick-list align=left">
                <?

                $all_coins=glo()->coins_obj->coins;
                foreach($all_coins as $k=>$v){

                    ?>
                    <li>
                        <a href="/wallet/<?=$v['coin_id']?>/balance"><?=$v['coin_name_ko']?></a>
                        |
                        <a href="/wallet/<?=$v['coin_id']?>/deposit">deposit</a>
                        |
                        <a href="/wallet/<?=$v['coin_id']?>/withdrawal">withdrawal</a>
                    </li>
                    <?
                } ?>

                {{--<li>►<a href="/wallet/btc/transfer">Transfer</a></li>
                <li>►<a href="/wallet/krw/deposit">Deposit</a></li>
                <li>►<a href="/wallet/krw/withdrawal">Withdrawal</a></li>
                <li>►<a href="/wallet/transactions">Transaction History</a></li>--}}
            </ul>
        </td>
    </tr>

    -->
    <tr>
        <td>

            <div class="card">
                {{--<div class="header">--}}
                {{--<h2>자산별 보유금액</h2>--}}
                {{--</div>--}}
                <table class="table table-hover">
                    <?

                    $all_coins=glo()->coins_obj->coins;
                    foreach($all_coins as $k=>$v){

                    ?>
                    <tr>
                        <th scope="row" class="col-pink"><a href="/wallet/<?=$v['coin_id']?>/balance"><?=$v['coin_name_ko']?></a></th>
                        <td><a href="/wallet/<?=$v['coin_id']?>/deposit">deposit</a></td>
                        <td><a href="/wallet/<?=$v['coin_id']?>/withdrawal">withdrawal</a></td>
                    </tr>
                        <?
                    } ?>
                </table>
            </div>


        </td>
    </tr>
    {{--<tr>
        <th class="quick-sub">
            <a href="#">Exchange</a>
        </th>
    </tr>
    <tr>
        <td>
            <ul class="quick-list">
                <li>►<a href="#">Orders</a></li>
                <li>►<a href="#">Transaction History</a></li>
            </ul>
        </td>
    </tr>--}}
    {{--<tr>
        <th class="quick-sub">
            <a href="#">Customer Service</a>
        </th>
    </tr>--}}
    <tr>
        <td>

            {{--<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">--}}
                <div class="card">
                    {{--<div class="header">--}}
                        {{--<h2>자산별 보유금액</h2>--}}
                    {{--</div>--}}
                    <table class="table table-hover">
                        <?

                        $all_coins=glo()->coins_obj->coins;
                        foreach($all_coins as $k=>$v){
                            if(isset($balance[$v['coin_id']])){
                                ?>
                                <tr>
                                    <th scope="row" class="col-blue-grey"><?=strtoupper($v['coin_id'])?></th>
                                    <td><span><?=tibab_number_format($balance[$v['coin_id']],$v['coin_id']);?></span></td>
                                    <td>{{--≈ 361 KRW--}}</td>
                                </tr>
                                <?
                            }
                        } ?>

                    </table>
                </div>
            {{--</div>--}}



        </td>
    </tr>
    </tbody>
</table>