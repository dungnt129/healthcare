<div class="widget-box">
	<div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Các cuộc hẹn khác</h5>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control">
			{!! Form::textarea("other_visit", !empty($user[27]) ? $user[27] : "", ["id" => "other_visit", "class" => "span12"]) !!}
		</div>
	</div>
</div>