@extends('layouts.app-semanticui')
@section('content')
    <div class="ui grid sixteen wide">
        <div class="sixteen wide column" align="center">

                <p class="header" style="margin-bottom:35px;padding-bottom:0px;">Popular Pages for the last 30 days</p>
                <table class="ui  table">
                    <thead>
                    <tr>
                        <th>Page</th>
                        <th >Views</th>
                        <th >Minutes On Page</th>
                        <th >Entrances</th>
                        <th >Exits</th>
                        <th >Bounces</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($popular->rows as $post) { ?>
                    <tr>
                        <td><a href="<?php echo $post[0]; //ga:pagePath?>" target="_blank"><?php echo $post[1]; //ga:pageTitle ?></a></td>
                        <td ><?php echo $post[2]; //ga:pageViews ?></td>
                        <td ><?php echo round($post[4]/60); //ga:timeOnPage ?></td>
                        <td ><?php echo $post[6]; //ga:entrances ?></td>
                        <td ><?php echo $post[7]; //ga:exits ?></td>
                        <td ><?php echo $post[5]; //ga:bounces ?></td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>

        </div>
    </div>
@endsection