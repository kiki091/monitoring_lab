<!DOCTYPE html>
<html lang="en">
	@section('pageheadtitle')
		CONTENT MANAGEMENT
	@endsection
	@include('partials.header')
	<body class="login" style="background-image: url('themes/images/bg.jpg'); background-size: cover; ">

		<div>
      		<a class="hiddenanchor" id="signup"></a>
      		<a class="hiddenanchor" id="signin"></a>

<!-- 
  _    ___   ___ ___ _  _  __      _____ ____  _   ___ ___  
 | |  / _ \ / __|_ _| \| | \ \    / /_ _|_  / /_\ | _ \   \ 
 | |_| (_) | (_ || || .` |  \ \/\/ / | | / / / _ \|   / |) |
 |____\___/ \___|___|_|\_|   \_/\_/ |___/___/_/ \_\_|_\___/ 
                                                            
-->
      		<div class="login_wrapper">
          		<div class="animate form login_form" style="background: rgb(244, 244, 244)">
              		<section class="login_content">
                  		<form role="form" method="POST" action="{{ route('users_authenticate') }}">
                    		<h1>MANAGEMENT <br/><br/>LABORATORIUM</h1>
                        	@if (count($errors) > 0)
                              	@foreach ($errors->all() as $key=> $error)
                                  	<span class="form--error--message">{{ $error.', ' }}</span>
                              	@endforeach
                                <br/>
                        	@else
                            	<p>Please enter your username and password to login</p>
                        	@endif

                    		<div class="form-group">
                      			<input type="email" class="form-control" placeholder="Email" value="{{ old('email') }}" name="email" />
                    		</div>
                    				
                    		<div class="form-group">
                      			<input type="password" class="form-control" placeholder="Password" name="password" />
                    		</div>

                        <div class="form-group">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
        			            <button class="full-width btn btn-primary submit" type="submit">Log in</button>
        			        </div>

        			        <div class="clearfix"></div>
                        </form>
              		</section>
          		</div>
        	</div>
    	</div>
    	<div id="custom_notifications" class="custom-notifications dsp_none">
        	<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        	</ul>
        	<div class="clearfix"></div>
        	<div id="notif-group" class="tabbed_notifications"></div>
    	</div>
      @include('slots.vars')
    	@include('partials.js_footer')
	</body>
</html>