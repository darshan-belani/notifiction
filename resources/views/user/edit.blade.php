@extends('layouts.adminHeader')

@section('content')
    <style>
        .boxes {
            width: 217px;
            height: 125px;
            border: 1px solid;
            float: left;
            margin: 0px 0px 0px 85px;
            border-radius: 14px;
            background-color: #2a3f54;
        }
        .boxes h4 {
            color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            margin: 40px 0px 0px 0px;
        } .boxes h2 {
              color: #f0f0f0;
              font-weight: bold;
              font-size: 45px;
              text-align: center;
          }
    </style>
    <div class="container body">
        <div class="main_container">
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="margin: 14px 0px 0px 390px;font-weight: bolder;font-size: 35px;">Edit User</h2>
                                </div>
                                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" action="{{url('/user/update',$editPost->id)}}">
                                    <div class="x_content">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="user_name" class="control-label col-md-3 col-sm-3 col-xs-12">User Name <span class="required">*</span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="user_name" class="form-control col-md-7 col-xs-12" type="text" name="user_name" value="{{$editPost->name}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="email" class="form-control col-md-7 col-xs-12" type="text" name="email" value=" {{$editPost->description}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="role" class="control-label col-md-3 col-sm-3 col-xs-12">Role</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input id="role" class="form-control col-md-7 col-xs-12" type="text" name="role" value=" {{$editPost->description}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                    <button type="submit" class="btn btn-success">Submit</button>
                                                    <a href="{{url('/posts')}}"> <button class="btn btn-primary" type="button">Cancel</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
@endsection
