<div class="widget-box">
	<div class="widget-title title-tuvanvien1 "> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien1][tentuvanvien]", !empty($user[$index]["tuvanvien1"]["tentuvanvien"]) ? $user[$index]["tuvanvien1"]["tentuvanvien"] : "", ["id" => "tab[{$tab}][tuvanvien1][tentuvanvien]", "class" => "span10", "readonly" => ""]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien1][date]", !empty($user[$index]["tuvanvien1"]["date"]) ? $user[$index]["tuvanvien1"]["date"] : "", ["id" => "tab[{$tab}][tuvanvien1][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Số viên thuốc đã uống kể từ lần hẹn trước:</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">Con số báo cáo</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][report_number]", !empty($user[$index]["tuvanvien1"]["report_number"]) ? $user[$index]["tuvanvien1"]["report_number"] : "", ["id" => "tab[{$tab}][tuvanvien1][report_number]", "readonly" => ""]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">Con số quan sát được (dựa trên việc đếm số viên còn lại)</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][real_number]", !empty($user[$index]["tuvanvien1"]["real_number"]) ? $user[$index]["tuvanvien1"]["real_number"] : "", ["id" => "tab[{$tab}][tuvanvien1][real_number]", "readonly" => ""]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Bạn có gặp phải các phản ứng phụ không? (Đưa cho bệnh nhân một bản có các phản ứng phụ để xem)</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Tiêu chảy (Mức độ)</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasTieuChay]", !empty($user[$index]["tuvanvien1"]["hasTieuChay"]) ? $user[$index]["tuvanvien1"]["hasTieuChay"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 1, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay", "disabled" => ""]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 2, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay", "disabled" => ""]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 3, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay", "disabled" => ""]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 4, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay", "disabled" => ""]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Mệt mỏi (Mức độ)</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasTired]", !empty($user[$index]["tuvanvien1"]["hasTired"]) ? $user[$index]["tuvanvien1"]["hasTired"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 1, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired", "disabled" => ""]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 2, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired", "disabled" => ""]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 3, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired", "disabled" => ""]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 4, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired", "disabled" => ""]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">c. Nhiễm độc gan (dựa trên kết quả xét nghiệm): (Mức độ)</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasPoisonGan]", !empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) ? $user[$index]["tuvanvien1"]["hasPoisonGan"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 1, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan", "disabled" => ""]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 2, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan", "disabled" => ""]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 3, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan", "disabled" => ""]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 4, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan", "disabled" => ""]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">d. Thay đổi cảm xúc (Mức độ)</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasChangedEmotion]", !empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) ? $user[$index]["tuvanvien1"]["hasChangedEmotion"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 1, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion", "disabled" => ""]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 2, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion", "disabled" => ""]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 3, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion", "disabled" => ""]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 4, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion", "disabled" => ""]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">e. Buồn nôn (Mức độ)</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasBuonNon]", !empty($user[$index]["tuvanvien1"]["hasBuonNon"]) ? $user[$index]["tuvanvien1"]["hasBuonNon"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 1, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon", "disabled" => ""]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 2, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon", "disabled" => ""]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 3, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon", "disabled" => ""]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 4, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon", "disabled" => ""]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">f. Mẩn ngứa (Mức độ)</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasManNgua]", !empty($user[$index]["tuvanvien1"]["hasManNgua"]) ? $user[$index]["tuvanvien1"]["hasManNgua"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 1, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua", "disabled" => ""]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 2, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua", "disabled" => ""]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 3, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua", "disabled" => ""]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 4, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua", "disabled" => ""]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">g. Nôn mửa (Mức độ)</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasNonMua]", !empty($user[$index]["tuvanvien1"]["hasNonMua"]) ? $user[$index]["tuvanvien1"]["hasNonMua"] : "" ) !!}
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 1, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua", "disabled" => ""]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 2, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua", "disabled" => ""]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 3, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua", "disabled" => ""]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 4, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua", "disabled" => ""]) !!}
					4</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Các hành vi nguy cơ:</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Bạn có quan hệ tình dục với bao nhiêu bạn tình nam trong vòng 3 tháng qua?</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][howManySexFriends]", isset($user[$index]["tuvanvien1"]["howManySexFriends"]) ? $user[$index]["tuvanvien1"]["howManySexFriends"] : "", ["id" => "tab[{$tab}][tuvanvien1][howManySexFriends]", "readonly" => ""]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Trong số đó, bạn quan hệ tình dục đường hậu môn với bao nhiêu người trong 3 tháng qua?</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][howManyAssSexFriends]", isset($user[$index]["tuvanvien1"]["howManyAssSexFriends"]) ? $user[$index]["tuvanvien1"]["howManyAssSexFriends"] : "", ["id" => "tab[{$tab}][tuvanvien1][howManyAssSexFriends]", "readonly" => ""]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">c. Bạn có sử dụng bao cao su trong lần quan hệ tình dục gần đây nhất qua đường hậu môn với bạn tình nam không?</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasCondomWhenAssSex]", !empty($user[$index]["tuvanvien1"]["hasCondomWhenAssSex"]) ? $user[$index]["tuvanvien1"]["hasCondomWhenAssSex"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCondomWhenAssSex]", 1, (!empty($user[$index]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCondomWhenAssSex", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCondomWhenAssSex]", 2, (!empty($user[$index]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCondomWhenAssSex", "disabled" => ""]) !!}
					Không</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">d. Bạn có thường xuyên sử dụng bao cao su khi quan hệ tình dục đường hậu môn với bạn tình nam trong 3 tháng qua không?</label>
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", !empty($user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) ? $user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 1, (!empty($user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasAlwaysUseCondomWhenAssSex", "disabled" => ""]) !!}
					Luôn luôn</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 2, (!empty($user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasAlwaysUseCondomWhenAssSex", "disabled" => ""]) !!}
					Thỉnh thoảng</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 3, (!empty($user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasAlwaysUseCondomWhenAssSex", "disabled" => ""]) !!}
					Không bao giờ</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Bạn có sử dụng ma túy tổng hợp (ví dụ: ma túy đá, Thuốc lắc) trong 12 tháng qua không:</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[{$tab}][tuvanvien1][hasCocainInLastYear]", !empty($user[$index]["tuvanvien1"]["hasCocainInLastYear"]) ? $user[$index]["tuvanvien1"]["hasCocainInLastYear"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCocainInLastYear]", 1, (!empty($user[$index]["tuvanvien1"]["hasCocainInLastYear"]) && $user[$index]["tuvanvien1"]["hasCocainInLastYear"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCocainInLastYear", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCocainInLastYear]", 2, (!empty($user[$index]["tuvanvien1"]["hasCocainInLastYear"]) && $user[$index]["tuvanvien1"]["hasCocainInLastYear"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCocainInLastYear", "disabled" => ""]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCocainInLastYear]", 3, (!empty($user[$index]["tuvanvien1"]["hasCocainInLastYear"]) && $user[$index]["tuvanvien1"]["hasCocainInLastYear"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCocainInLastYear", "disabled" => ""]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[{$tab}][tuvanvien1][otherComment]", !empty($user[$index]["tuvanvien1"]["otherComment"]) ? $user[$index]["tuvanvien1"]["otherComment"] : "", ["id" => "tab[{$tab}][tuvanvien1][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5", "readonly" => ""]) !!}
			</div>
		</div>
	</div>
</div>

<div class="widget-box">
	<div class="widget-title title-bacsi"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tên bác sĩ</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][bacsi][tenbacsi]", !empty($user[$index]["bacsi"]["tenbacsi"]) ? $user[$index]["bacsi"]["tenbacsi"]: "", ["id" => "tab[{$tab}][bacsi][tenbacsi]", "class" => "span10", "readonly" => ""]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][bacsi][date]", !empty($user[$index]["bacsi"]["date"]) ? $user[$index]["bacsi"]["date"]: "", ["id" => "tab[{$tab}][bacsi][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Bác sĩ form-->
		<div class="control-group">
			<label class="control-label-custom">1. Kết quả xét nghiệm nhanh HIV</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][fastHIVresultdate]", !empty($user[$index]["bacsi"]["fastHIVresultdate"]) ? $user[$index]["bacsi"]["fastHIVresultdate"] : "", ["id" => "tab[{$tab}][bacsi][fastHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[{$tab}][bacsi][fastHIVresult]", UserHelper::$optionResult, !empty($user[$index]["bacsi"]["fastHIVresult"]) ? $user[$index]["bacsi"]["fastHIVresult"] : "", ["id" => "tab[{$tab}][bacsi][fastHIVresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[{$tab}][bacsi][fastHIVresult]", !empty($user[$index]["bacsi"]["fastHIVresult"]) ? $user[$index]["bacsi"]["fastHIVresult"] : "" ) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Kết quả xét nghiệm khẳng định HIV</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][confirmHIVresultdate]", !empty($user[$index]["bacsi"]["confirmHIVresultdate"]) ? $user[$index]["bacsi"]["confirmHIVresultdate"] : "", ["id" => "tab[{$tab}][bacsi][confirmHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[{$tab}][bacsi][confirmHIVresult]", UserHelper::$optionResult, !empty($user[$index]["bacsi"]["confirmHIVresult"]) ? $user[$index]["bacsi"]["confirmHIVresult"] : "", ["id" => "tab[{$tab}][bacsi][confirmHIVresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[{$tab}][bacsi][confirmHIVresult]", !empty($user[$index]["bacsi"]["confirmHIVresult"]) ? $user[$index]["bacsi"]["confirmHIVresult"] : "" ) !!}
			</div>
		</div>
		@if($tab == 4 || $tab == 6)
		<div class="control-group">
			<label class="control-label-custom">3. Chức năng thận (độ thanh thải creatinine > 60ml/min)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][chucnangthanResultDate]", !empty($user[$index]["bacsi"]["chucnangthanResultDate"]) ? $user[$index]["bacsi"]["chucnangthanResultDate"] : "", ["id" => "tab[{$tab}][bacsi][chucnangthanResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[{$tab}][bacsi][chucnangthanResult]", UserHelper::$optionResult, !empty($user[$index]["bacsi"]["chucnangthanResult"]) ? $user[$index]["bacsi"]["chucnangthanResult"] : "", ["id" => "tab[{$tab}][bacsi][chucnangthanResult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[{$tab}][bacsi][chucnangthanResult]", !empty($user[$index]["bacsi"]["chucnangthanResult"]) ? $user[$index]["bacsi"]["chucnangthanResult"] : "" ) !!}
			</div>
		</div>
		@endif
		<div class="control-group">
			<label class="control-label-custom">{{ $tab != 4 && $tab != 6 ? 3 : 4 }}. Bạn có gặp phải các phản ứng phụ không? (Tham khảo phụ lục III)</label>
			<div class="controls-custom">
				{!! Form::select("tab[{$tab}][bacsi][hasSideEffects]", UserHelper::$optionResult4, !empty($user[$index]["bacsi"]["hasSideEffects"]) ? $user[$index]["bacsi"]["hasSideEffects"] : "", ["id" => "tab[{$tab}][bacsi][hasSideEffects]", "class" => "span3 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[{$tab}][bacsi][hasSideEffects]", !empty($user[$index]["bacsi"]["hasSideEffects"]) ? $user[$index]["bacsi"]["hasSideEffects"] : "" ) !!}
			</div>
		</div>
		@if($tab == 6)
		<div class="control-group">
			<label class="control-label-custom">5. Kết quả xét nghiệm Anti-HCV (Viêm gan C)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm (tháng thứ 12)</span>
				{!! Form::text("tab[{$tab}][bacsi][antiHCVresultdate]", !empty($user[$index]["bacsi"]["antiHCVresultdate"]) ? $user[$index]["bacsi"]["antiHCVresultdate"] : "", ["id" => "tab[{$tab}][bacsi][antiHCVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[{$tab}][bacsi][antiHCVresult]", UserHelper::$optionResult, !empty($user[$index]["bacsi"]["antiHCVresult"]) ? $user[$index]["bacsi"]["antiHCVresult"] : "", ["id" => "tab[{$tab}][bacsi][antiHCVresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[{$tab}][bacsi][antiHCVresult]", !empty($user[$index]["bacsi"]["antiHCVresult"]) ? $user[$index]["bacsi"]["antiHCVresult"] : "" ) !!}
			</div>
		</div>
		@endif
		@if($tab == 6)
		<div class="control-group">
			<label class="control-label-custom">6. Kết quả xét nghiệm VDRL/RPR (syphilis)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm (tháng thứ 12)</span>
				{!! Form::text("tab[{$tab}][bacsi][VDRLRPRresultdate]", !empty($user[$index]["bacsi"]["VDRLRPRresultdate"]) ? $user[$index]["bacsi"]["VDRLRPRresultdate"] : "", ["id" => "tab[{$tab}][bacsi][VDRLRPRresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[{$tab}][bacsi][VDRLRPRresult]", UserHelper::$optionResult, !empty($user[$index]["bacsi"]["VDRLRPRresult"]) ? $user[$index]["bacsi"]["VDRLRPRresult"] : "", ["id" => "tab[{$tab}][bacsi][VDRLRPRresult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[{$tab}][bacsi][VDRLRPRresult]", !empty($user[$index]["bacsi"]["VDRLRPRresult"]) ? $user[$index]["bacsi"]["VDRLRPRresult"] : "" ) !!}
			</div>
		</div>
		@endif
		<?php
		$questionNo = [
			'4' => 5,
			'6' => 7
		];?>
		<div class="control-group">
			<label class="control-label-custom">{{ !empty($questionNo[$tab]) ? $questionNo[$tab] : 3  }}. Nhiễm độc gan: Mức AST và ALT (tại các tháng 3,6,12)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][poisonGanResultDate]", !empty($user[$index]["bacsi"]["poisonGanResultDate"]) ? $user[$index]["bacsi"]["poisonGanResultDate"] : "", ["id" => "tab[{$tab}][bacsi][poisonGanResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
				{!! Form::select("tab[{$tab}][bacsi][poisonGanResult]", UserHelper::$optionResult, !empty($user[$index]["bacsi"]["poisonGanResult"]) ? $user[$index]["bacsi"]["poisonGanResult"] : "", ["id" => "tab[{$tab}][bacsi][poisonGanResult]", "class" => "span2 margin-right5", "disabled" => ""]) !!}
				{!! Form::hidden("tab[{$tab}][bacsi][poisonGanResult]", !empty($user[$index]["bacsi"]["poisonGanResult"]) ? $user[$index]["bacsi"]["poisonGanResult"] : "" ) !!}
			</div>
		</div>
		<?php
		$questionNo = [
			'4' => 6,
			'6' => 8
		];?>
		<div class="control-group">
			<label class="control-label-custom">{{ !empty($questionNo[$tab]) ? $questionNo[$tab] : 4  }}. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[{$tab}][bacsi][otherComment]", !empty($user[$index]["bacsi"]["otherComment"]) ? $user[$index]["bacsi"]["otherComment"] : "", ["id" => "tab[{$tab}][bacsi][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5", "readonly" => ""]) !!}
			</div>
		</div>
	</div>
</div>

<div class="widget-box">
	<div class="widget-title title-tuvanvien3"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien3][tentuvanvien]", !empty($user[$index]["tuvanvien3"]["tentuvanvien"]) ? $user[$index]["tuvanvien3"]["tentuvanvien"]: "", ["id" => "tab[{$tab}][tuvanvien3][tentuvanvien]", "class" => "span10", "readonly" => ""]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien3][date]", !empty($user[$index]["tuvanvien3"]["date"]) ? $user[$index]["tuvanvien3"]["date"]: "", ["id" => "tab[{$tab}][tuvanvien3][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Bệnh nhân nhiễm HIV+</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[{$tab}][tuvanvien3][hasHIV]", !empty($user[$index]["tuvanvien3"]["hasHIV"]) ? $user[$index]["tuvanvien3"]["hasHIV"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][hasHIV]", 1, (!empty($user[$index]["tuvanvien3"]["hasHIV"]) && $user[$index]["tuvanvien3"]["hasHIV"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien3_hasHIV", "disabled" => ""]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][hasHIV]", 2, (!empty($user[$index]["tuvanvien3"]["hasHIV"]) && $user[$index]["tuvanvien3"]["hasHIV"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien3_hasHIV", "disabled" => ""]) !!}
					Không</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Nếu bệnh nhân không nhiễm HIV+, lý do tại sao bệnh nhân chấm dứt điều trị PrEP</label>
			<div class="controls-custom">
				{!! Form::hidden("tab[{$tab}][tuvanvien3][otherReason]", !empty($user[$index]["tuvanvien3"]["otherReason"]) ? $user[$index]["tuvanvien3"]["otherReason"] : "" ) !!}
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][otherReason]", 1, (!empty($user[$index]["tuvanvien3"]["otherReason"]) && $user[$index]["tuvanvien3"]["otherReason"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien3_otherReason", "disabled" => ""]) !!}
					Tác dụng phụ của thuốc</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][otherReason]", 2, (!empty($user[$index]["tuvanvien3"]["otherReason"]) && $user[$index]["tuvanvien3"]["otherReason"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien3_otherReason", "disabled" => ""]) !!}
					Thay đổi nguy cơ</label>
				<label>
					Các lý do khác (Hãy mô tả chi tiết)
					{!! Form::text("tab[{$tab}][tuvanvien3][otherReasonText]", !empty($user[$index]["tuvanvien3"]["otherReasonText"]) ? $user[$index]["tuvanvien3"]["otherReasonText"]:"", ["id" => "tab{$tab}_tuvanvien3_otherReasonText", "class" => "span10", "readonly" => ""]) !!}
				</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Nếu do tác dụng phụ của thuốc, hãy nêu rõ mức độ nào (Xem phụ lục III)</label>
				{!! Form::text("tab[{$tab}][tuvanvien3][sideEffectLevel]", !empty($user[$index]["tuvanvien3"]["sideEffectLevel"]) ? $user[$index]["tuvanvien3"]["sideEffectLevel"]:"", ["id" => "tab[{$tab}][tuvanvien3][sideEffectLevel]", "class" => "span10", "readonly" => ""]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Nếu thay đổi nguy cơ, hãy nêu rõ nguy cơ nào và thay đổi thế nào</label>
				{!! Form::text("tab[{$tab}][tuvanvien3][dangerousChange]", !empty($user[$index]["tuvanvien3"]["dangerousChange"]) ? $user[$index]["tuvanvien3"]["dangerousChange"]:"", ["id" => "tab[{$tab}][tuvanvien3][dangerousChange]", "class" => "span10", "readonly" => ""]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Nếu bệnh nhân nhiễm HIV+, hãy ghi ngày làm xét nghiệm định genotype HIV</label>
			<div class="controls-custom">
				{!! Form::text("tab[{$tab}][tuvanvien3][HIVdate]", !empty($user[$index]["tuvanvien3"]["HIVdate"]) ? $user[$index]["tuvanvien3"]["HIVdate"]: "", ["id" => "tab[{$tab}][tuvanvien3][HIVdate]", "class" => "datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Nếu bệnh nhân nhiễm HIV+, hãy ghi ngày thực hiện đo nồng độ tenofivir trong máu</label>
			<div class="controls-custom">
				{!! Form::text("tab[{$tab}][tuvanvien3][tenofivirDate]", !empty($user[$index]["tuvanvien3"]["tenofivirDate"]) ? $user[$index]["tuvanvien3"]["tenofivirDate"]: "", ["id" => "tab[{$tab}][tuvanvien3][tenofivirDate]", "class" => "datepicker", "data-date-format" => "dd/mm/yyyy", "readonly" => ""]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[{$tab}][tuvanvien3][otherComment]", !empty($user[$index]["tuvanvien3"]["otherComment"]) ? $user[$index]["tuvanvien3"]["otherComment"] : "", ["id" => "tab[{$tab}][tuvanvien3][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5", "readonly" => ""]) !!}
			</div>
		</div>
	</div>
</div>