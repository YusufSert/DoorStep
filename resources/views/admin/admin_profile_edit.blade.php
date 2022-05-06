@extends('admin.admin_master')
@section('admin')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<div class="container-full">

<section class="content">

<!-- Basic Forms -->
<div class="box">
<div class="box-header with-border">
    <h4 class="box-title">Admin Profile</h4>
    
</div>
<!-- /.box-header -->
<div class="box-body">
    <div class="row">
    <div class="col">
        <form method="post" action="{{ route('admin.profile.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-12">						
                


            <div class="row">
                <div class="col-md-6">

                <div class="form-group">
                    <h5>Admin User Name <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="name" class="form-control" required="" value="{{ $editData->name}}">
                    </div>
                </div>
                </div>



              <!--end col md 6-->


                <div class="col-md-6">

                <div class="form-group">
                    <h5>Admin E-mail <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="email" name="email" class="form-control" required="" value="{{ $editData->email}}"></div></div>
                </div>


                </div>



                </div> <!--end col md 6-->
            </div> <!-- end row --> 

            <div class="row"> 

                <div class="col-md-6"> <!-- end-cold-md6-->

                <div class="form-group">
                    <h5>Image <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="file" name="profile_photo_path" class="form-control" required="" id="image" ></div>
                </div>

                </div> <!-- end cold md 6-->

                <div class="col-md-6">
                    <img id="showImage" src="{{ (!empty( $editData->profile_photo_path)) ? url('upload/admin_images/'.$editData->profile_photo_path):url('upload/kyojuro_rengoku_render_png_by_shinobi_weapon_dev2isl-pre.png')}}" style=" width:100px; height:100px" alt="">
                </div> <!-- end col-->

            </div>  <!-- end row -->



                
                <!-- <div class="form-group">
                    <h5>Password Input Field <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Repeat Password Input Field <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="password" name="password2" data-validation-match-match="password" class="form-control" required=""> <div class="help-block"></div></div>
                </div>
                 -->
                <!-- <div class="form-group">
                    <h5>Input with Icon <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Addon To Right" data-validation-required-message="This field is required"> <span class="input-group-addon" id="basic-addon1"><i class="fa fa-dollar"></i></span> </div>
                    <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Maximum Character Length <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="maxChar" class="form-control" required="" data-validation-required-message="This field is required" maxlength="10">
                    <div class="help-block"></div></div>
                    <div class="form-control-feedback"><small>Add <code>maxlength='10'</code> attribute for maximum number of characters to accept. </small></div>
                </div>
                <div class="form-group">
                    <h5>Minimum Character Length <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="minChar" class="form-control" required="" data-validation-required-message="This field is required" minlength="6">
                    <div class="help-block"></div></div>
                    <div class="form-control-feedback"><small>Add <code>minlength="6"</code> attribute for minimum number of characters to accept.</small></div>
                </div>
                <div class="form-group">
                    <h5>Only Numbers <span class="text-danger">*</span></h5>
                    <div class="input-group"> <span class="input-group-addon">$</span>
                        <input type="number" name="onlyNum" class="form-control" required="" data-validation-required-message="This field is required"> <span class="input-group-addon">.00</span> </div>
                </div>
                <div class="form-group">
                    <h5>Maximum Number <span class="text-danger">*</span></h5>
                    <input type="number" name="maxNum" class="form-control" required="" data-validation-required-message="This field is required" max="25">
                    <div class="form-control-feedback"> <small><i>Must be lower than 25</i></small> - <small>Add <code>max</code> attribute for maximum number to accept. Also use <code>data-validation-max-message</code> attribute for max failure message</small> </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <h5>Minimum Number <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="number" name="minNum" class="form-control" required="" data-validation-required-message="This field is required" min="10">
                    <div class="help-block"></div></div>
                    <div class="form-control-feedback"><small><i>Must be higher than 10</i></small> - <small>Add <code>min</code> attribute for minimum number to accept. Also use <code>data-validation-min-message</code> attribute for min failure message</small></div>
                </div>
                <div class="form-group">
                    <h5>Text Input Range <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="text" class="form-control" required="" data-validation-required-message="This field is required" minlength="10" maxlength="20" placeholder="Enter number between 10 &amp; 20"> <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Input with Button <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" required=""> 
                            <span class="input-group-append">
                                <button class="btn btn-info btn-sm" type="button">Go!</button>
                            </span> </div>
                    <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>No Characters, Only Numbers <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="noChar" class="form-control" required="" data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers"> <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Pattern <span class="text-danger">*</span> <small><i>Must start with 'a' and end with 'z'</i></small></h5>
                    <div class="controls">
                        <input type="text" name="pattern" pattern="a.*z" data-validation-pattern-message="Must start with 'a' and end with 'z'" class="form-control" required="">
                        <div class="form-control-feedback"><small>Add <code>pattern</code> attribute to set input pattern. Also use <code>data-validation-pattern-message</code> attribute for pattern failure message</small></div>
                    <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Enter URL <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" class="form-control" placeholder="Add URL" data-validation-regex-regex="((http[s]?|ftp[s]?):\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*" data-validation-regex-message="Only Valid URL's">
                        <div class="form-control-feedback"><small>Add <code>data-validation-regex-regex</code> attribute for regular expression. Also use <code>data-validation-regex-message</code> attribute for regex failure message</small></div>
                    <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Enter Email Address <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" class="form-control" placeholder="Email Address" data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="Enter Valid Email"> <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Enter Date <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="date" name="date" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                    <div class="form-control-feedback"><small>Add <code>required</code> attribute to field for required validation.</small></div>

                </div>
                <div class="form-group">
                    <h5>Basic Select <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="select" id="select" required="" class="form-control">
                            <option value="">Select Your City</option>
                            <option value="1">India</option>
                            <option value="2">USA</option>
                            <option value="3">UK</option>
                            <option value="4">Canada</option>
                            <option value="5">Dubai</option>
                        </select>
                    <div class="help-block"></div></div>
                </div>
                <div class="form-group">
                    <h5>Textarea <span class="text-danger">*</span></h5>
                    <div class="controls">
                        <textarea name="textarea" id="textarea" class="form-control" required="" placeholder="Textarea text"></textarea>
                    <div class="help-block"></div></div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Checkbox <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="checkbox" id="checkbox_1" required="" value="single">
                            <label for="checkbox_1">Check this custom checkbox</label>
                        <div class="help-block"></div></div>								
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Checkbox Group <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <fieldset>
                                <input type="checkbox" id="checkbox_2" required="" value="x">
                                <label for="checkbox_2">I am unchecked Checkbox</label>
                            </fieldset>
                            <fieldset>
                                <input type="checkbox" id="checkbox_3" value="y">
                                <label for="checkbox_3">I am unchecked too</label>
                            </fieldset>
                        <div class="help-block"></div></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Select Max 2 Checkbox<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <fieldset>
                                <input type="checkbox" id="checkbox_4" data-validation-maxchecked-maxchecked="2" data-validation-maxchecked-message="Don't be greedy!" required="">
                                <label for="checkbox_4">I am unchecked Checkbox</label>
                            </fieldset>
                            <fieldset>
                                <input type="checkbox" id="checkbox_5">
                                <label for="checkbox_5">I am unchecked too</label>
                            </fieldset>
                            <fieldset>
                                <input type="checkbox" id="checkbox_6">
                                <label for="checkbox_6">You can check me</label>
                            </fieldset>
                        <div class="help-block"></div></div> <small>Select any 2 options</small> </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Minimum 2 Checkbox selection<span class="text-danger">*</span></h5>
                        <div class="controls">
                            <fieldset>
                                <input type="checkbox" id="checkbox_7" value="1" data-validation-minchecked-minchecked="2" data-validation-minchecked-message="Choose at least two" name="styled_min_checkbox" required="">
                                <label for="checkbox_7">I am unchecked Checkbox</label>
                            </fieldset>
                            <fieldset>
                                <input type="checkbox" id="checkbox_8" value="2">
                                <label for="checkbox_8">I am unchecked too</label>
                            </fieldset>
                            <fieldset>
                                <input type="checkbox" id="checkbox_9" value="3">
                                <label for="checkbox_9">You can check me</label>
                            </fieldset>
                        <div class="help-block"></div></div> <small>Select any 2 options</small> </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Radio Buttons <span class="text-danger">*</span></h5>
                        <fieldset class="controls">
                            <input name="group1" type="radio" id="radio_1" value="1" required="">
                            <label for="radio_1">Check Me</label>
                        <div class="help-block"></div></fieldset>
                        <fieldset>
                            <input name="group1" type="radio" id="radio_2" value="2">
                            <label for="radio_2">Or Me</label>									
                        </fieldset>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Inline Radio Buttons <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <fieldset>
                                <input name="group2" type="radio" id="radio_3" value="Yes" required="">
                                <label for="radio_3">Check Me</label>
                            </fieldset>
                            <fieldset>
                                <input name="group2" type="radio" id="radio_4" value="No">
                                <label for="radio_4">Or Me</label>
                            </fieldset>
                        <div class="help-block"></div></div>
                    </div>
                </div>
            </div> -->
            <div class="text-xs-right">
                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
            </div>
        </form>

    </div>
    <!-- /.col -->
    </div>
    <!-- /.row -->
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->

</section>

</div>


<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection