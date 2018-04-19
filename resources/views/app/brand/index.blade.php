@extends('layouts.admin')

@section('title')
    <?php echo setting('admin.title') ?>
@endsection

@section('meta')
    <meta name="description" content="<?php echo setting('admin.description') ?>">
@endsection

@section('styles')
    <style>
        @media (max-width: 991px) {
            .sidebar {
                display: none !important;
            }
        }

        @media (min-width: 991px) {
            .mobile-nav {
                display: none;
            }
        }

        .main .card-body {
            min-height: 150px !important;
        }
    </style>
@endsection

@section('content')

    <main class="col-sm-12 col-md-12 col-lg-10 offset-lg-2 pt-3">
        <div class="main col-md-12" style="background:none;margin-top:25px;">
            <div class="col-md-12">
                <h5 style="margin-bottom:25px;"><?php if ($request->input('group') !== null) {
                        echo ucfirst($request->input('group')) . ' ';
                    } ?>Brand Settings
                </h5>
            </div>
            <div class="col-md-12">



                    <table class="table clickable">
                        <thead class="hiddenOnMobile">
                        <tr>
                            <th scope="col" class="hiddenOnMobile updated_at_column">Last Updated</th>
                            <th scope="col" class="status_column">Status</th>
                            <th scope="col">Info</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($settings as $setting)
                            <tr>
                                <td class="hiddenOnMobile updated_at_column"><span
                                            class="badge badge-date">{{ \Carbon\Carbon::createFromTimeStamp(strtotime($setting->updated_at))->diffForHumans() }}</span>
                                </td>
                                <td scope="col" class="hiddenOnMobile status_column"><span
                                            class="badge badge-status<?php if ($setting->status !== "PUBLISHED") {
                                                echo "-disabled";
                                            } ?>">{{ $setting->status }}</span></td>
                                <td>{{ $setting->display_name }}
                                </td>
                                <td align="right">
                                    <a href="/app/edit/setting/{{ $setting->id }}"
                                       class="btn btn-sm btn-secondary-outline defaultClick" style="">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </main>

@endsection