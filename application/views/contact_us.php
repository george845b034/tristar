<script src="js/contact_us.js"></script>
<div class="container">
	<div class="col-md-8">
		<h1>Contact Us!聯絡我們</h1>
		<address>
			<strong>三星蘭園</strong><br>
			台灣宜蘭縣三星鄉月眉街92-1號<br>
			<abbr title="Phone">TEL:</abbr> (03)9891766 &nbsp;&nbsp;
			<abbr title="Mobil">Mobil:</abbr> 0937831165 <br>
			<abbr title="Postal Transfer">Postal Transfer:</abbr> 郵政劃撥：14128001 張文賢
		</address>
		<address>
			<strong>Email</strong><br>
			<a href="mailto:#">tristar_orchid@yahoo.com.tw</a>
		</address>
	</div><!--end hero unit -->
	
	<div class="col-md-6" ng-app="formApp" ng-controller="contactUsController">

		<form ng-submit="messageForm.$valid && processForm(messageForm)" name="messageForm" class="css-form" novalidate>
			<span class="label label-success" ng-show="message">{{ message }}</span>
			<span class="label label-danger" ng-show="errorMessage">{{ errorMessage }}</span>
			<br/>
			<div class="form-group">
				<label ><span class="glyphicon glyphicon-user"></span> Full Name(姓名)</label>
				<input type="text" class="form-control" name="cu_name" ng-model="formData.cu_name" placeholder="Cool Person" required/>

				<div style="color:red;" ng-show="messageForm.cu_name.$dirty && messageForm.cu_name.$invalid">Invalid:
		          <span ng-show="messageForm.cu_name.$error.required">required.</span>
		        </div>
			</div>

			<div class="form-group">
				<label ><span class="glyphicon glyphicon-envelope"></span> Email</label>
				<input type="email" name="cu_mail" class="form-control" ng-model="formData.cu_mail" placeholder="you@yourdomain.com" required/>

				<div style="color:red;" ng-show="messageForm.cu_mail.$dirty && messageForm.cu_mail.$invalid">Invalid:
		          <span ng-show="messageForm.cu_mail.$error.required">Tell us your email.</span>
		          <span ng-show="messageForm.cu_mail.$error.email">This is not a valid email.</span>
		        </div>
			</div>

			<div class="form-group">
				<label ><span class="glyphicon glyphicon-question-sign"></span> Subject(標題)</label>
				<input type="text" class="form-control" name="cu_title" ng-model="formData.cu_title" placeholder="what's up?" required/>

				<div style="color:red;" ng-show="messageForm.cu_title.$dirty && messageForm.cu_title.$invalid">Invalid:
		          <span ng-show="messageForm.cu_title.$error.required">required.</span>
		        </div>
			</div>

			<div class="form-group">
				<label ><span class="glyphicon glyphicon-pencil"></span> Message(內容)</label>
				<textarea rows="6" class="form-control" name="cu_message" ng-model="formData.cu_message" placeholder="What's on your mind?" required></textarea>
			</div>

			<div class="form-group">
				<ul class="list-inline">
				  <li><input type="text" class="form-control" name="captcha" ng-model="formData.captcha" placeholder="input captcha" required/></li>
				  <li><?php echo $captcha;?></li>
				</ul>
				<div style="color:red;" ng-show="messageForm.captcha.$dirty && messageForm.captcha.$invalid">Invalid:
		          <span ng-show="messageForm.captcha.$error.required">required.</span>
		        </div>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-success" ng-click="submitted=true">Send Message</button>
				<br class="clear">
			</div>
		</form>

			<!-- <div ng-controller="Controller">
					      <form  name="form" novalidate class="css-form">
					        Name:
					          <input type="text" ng-model="user.name" required /><br />
					        E-mail: <input type="email" ng-model="user.mail" name="mail" required /><br />
					        Gender: <input type="radio" ng-model="user.gender" value="male" />male
					        <input type="radio" ng-model="user.gender" value="female" />female<br />
					        <button ng-click="reset()">RESET</button>
					        <button ng-click="update(user)">SAVE</button>
					      </form>
			<pre>form = {{user | json}}</pre>
			<pre>form = {{form.mail.$invalid}}</pre>
					    </div> -->
	</div><!-- end left -->
	
    

	<div class="col-md-6">
		<div class="well">
			<iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src=http://maps.google.com.tw/maps?f=q&hl=zh-TW&geocode=&q=宜蘭縣三星鄉月眉街92號&z=15&output=embed&t=></iframe>
		</div><!--end well -->
	</div><!--end right --> 
</div>
<div class="height50 clear"></div>