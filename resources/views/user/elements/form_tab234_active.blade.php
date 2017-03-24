<div class="widget-box">
	<div class="widget-title title-tuvanvien1"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien1][tentuvanvien]", !empty($user[$index]["tuvanvien1"]["tentuvanvien"]) ? $user[$index]["tuvanvien1"]["tentuvanvien"] : "", ["id" => "tab[{$tab}][tuvanvien1][tentuvanvien]", "class" => "span10"]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien1][date]", !empty($user[$index]["tuvanvien1"]["date"]) ? $user[$index]["tuvanvien1"]["date"] : "", ["id" => "tab[{$tab}][tuvanvien1][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Số viên thuốc đã uống kể từ lần hẹn trước:</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">Con số báo cáo</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][report_number]", !empty($user[$index]["tuvanvien1"]["report_number"]) ? $user[$index]["tuvanvien1"]["report_number"] : "", ["id" => "tab[{$tab}][tuvanvien1][report_number]"]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">Con số quan sát được (dựa trên việc đếm số viên còn lại)</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][real_number]", !empty($user[$index]["tuvanvien1"]["real_number"]) ? $user[$index]["tuvanvien1"]["real_number"] : "", ["id" => "tab[{$tab}][tuvanvien1][real_number]"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Bạn có gặp phải các phản ứng phụ không? (Đưa cho bệnh nhân một bản có các phản ứng phụ để xem)</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Tiêu chảy (Mức độ)</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 1, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay"]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 2, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay"]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 3, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay"]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTieuChay]", 4, (!empty($user[$index]["tuvanvien1"]["hasTieuChay"]) && $user[$index]["tuvanvien1"]["hasTieuChay"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTieuChay"]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Mệt mỏi (Mức độ)</label>
				 <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 1, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired"]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 2, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired"]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 3, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired"]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasTired]", 4, (!empty($user[$index]["tuvanvien1"]["hasTired"]) && $user[$index]["tuvanvien1"]["hasTired"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasTired"]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">c. Nhiễm độc gan (dựa trên kết quả xét nghiệm): (Mức độ)</label>
				 <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 1, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan"]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 2, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan"]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 3, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan"]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasPoisonGan]", 4, (!empty($user[$index]["tuvanvien1"]["hasPoisonGan"]) && $user[$index]["tuvanvien1"]["hasPoisonGan"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasPoisonGan"]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">d. Thay đổi cảm xúc (Mức độ)</label>
				 <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 1, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion"]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 2, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion"]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 3, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion"]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasChangedEmotion]", 4, (!empty($user[$index]["tuvanvien1"]["hasChangedEmotion"]) && $user[$index]["tuvanvien1"]["hasChangedEmotion"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasChangedEmotion"]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">e. Buồn nôn (Mức độ)</label>
				 <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 1, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon"]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 2, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon"]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 3, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon"]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasBuonNon]", 4, (!empty($user[$index]["tuvanvien1"]["hasBuonNon"]) && $user[$index]["tuvanvien1"]["hasBuonNon"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasBuonNon"]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">f. Mẩn ngứa (Mức độ)</label>
				 <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 1, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua"]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 2, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua"]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 3, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua"]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasManNgua]", 4, (!empty($user[$index]["tuvanvien1"]["hasManNgua"]) && $user[$index]["tuvanvien1"]["hasManNgua"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasManNgua"]) !!}
					4</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">g. Nôn mửa (Mức độ)</label>
				 <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 1, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua"]) !!}
					1</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 2, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua"]) !!}
					2</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 3, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua"]) !!}
					3</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasNonMua]", 4, (!empty($user[$index]["tuvanvien1"]["hasNonMua"]) && $user[$index]["tuvanvien1"]["hasNonMua"] == 4) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasNonMua"]) !!}
					4</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Các hành vi nguy cơ:</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Câu hỏi 1: Bạn có quan hệ tình dục với bao nhiêu bạn tình nam trong vòng 3 tháng qua?</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][howManySexFriends]", isset($user[$index]["tuvanvien1"]["howManySexFriends"]) ? $user[$index]["tuvanvien1"]["howManySexFriends"] : "", ["id" => "tab{$tab}_tuvanvien1_howManySexFriends"]) !!}
			</div>
			<div class="controls-custom {{ empty($user[$index]["tuvanvien1"]["howManySexFriends"]) ? "sub-question" : "" }}" id="question_tab{{$tab}}_tuvanvien1_howManyAssSexFriends">
				<label class="control-sublabel-custom">b. Câu hỏi 2: Trong số đó, bạn quan hệ tình dục đường hậu môn hay âm đạo giả với bao nhiêu người trong 3 tháng qua?</label>
                {!! Form::text("tab[{$tab}][tuvanvien1][howManyAssSexFriends]", isset($user[$index]["tuvanvien1"]["howManyAssSexFriends"]) ? $user[$index]["tuvanvien1"]["howManyAssSexFriends"] : "", ["id" => "tab{$tab}_tuvanvien1_howManyAssSexFriends"]) !!}
			</div>
			<div class="controls-custom {{ empty($user[$index]["tuvanvien1"]["howManyAssSexFriends"]) ? "sub-question" : "" }}" id="question_tab{{$tab}}_tuvanvien1_hasCondomWhenAssSex">
				<label class="control-sublabel-custom">c. Câu hỏi 3: Bạn có sử dụng bao cao su trong lần quan hệ tình dục gần đây nhất qua đường hậu môn hay âm đạo giả với bạn tình nam không?</label>
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCondomWhenAssSex]", 1, (!empty($user[$index]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCondomWhenAssSex"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCondomWhenAssSex]", 2, (!empty($user[$index]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCondomWhenAssSex"]) !!}
					Không</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">d. Bạn có thường xuyên sử dụng bao cao su khi quan hệ tình dục đường hậu môn hay âm đạo giả với bạn tình nam trong 3 tháng qua không?</label>
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 1, (!empty($user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasAlwaysUseCondomWhenAssSex"]) !!}
					Luôn luôn</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 2, (!empty($user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasAlwaysUseCondomWhenAssSex"]) !!}
					Thường xuyên</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 3, (!empty($user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[$index]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasAlwaysUseCondomWhenAssSex"]) !!}
					Không bao giờ</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Bạn có sử dụng ma túy tổng hợp (ma túy đá, Speed, Thuốc lắc) trong năm qua không:</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCocainInLastYear]", 1, (!empty($user[$index]["tuvanvien1"]["hasCocainInLastYear"]) && $user[$index]["tuvanvien1"]["hasCocainInLastYear"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCocainInLastYear"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCocainInLastYear]", 2, (!empty($user[$index]["tuvanvien1"]["hasCocainInLastYear"]) && $user[$index]["tuvanvien1"]["hasCocainInLastYear"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCocainInLastYear"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien1][hasCocainInLastYear]", 3, (!empty($user[$index]["tuvanvien1"]["hasCocainInLastYear"]) && $user[$index]["tuvanvien1"]["hasCocainInLastYear"] == 3) ? true : null, ["class" => "tab{$tab}_tuvanvien1_hasCocainInLastYear"]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[{$tab}][tuvanvien1][otherComment]", !empty($user[$index]["tuvanvien1"]["otherComment"]) ? $user[$index]["tuvanvien1"]["otherComment"] : "", ["id" => "tab[{$tab}][tuvanvien1][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
			</div>
		</div>
	</div>
	<div class="form-actions">
		<input type="submit" value="Save" class="btn btn-success">
	</div>
</div>

<div class="widget-box">
	<div class="widget-title title-bacsi"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tên bác sĩ</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][bacsi][tenbacsi]", !empty($user[$index]["bacsi"]["tenbacsi"]) ? $user[$index]["bacsi"]["tenbacsi"]: "", ["id" => "tab[{$tab}][bacsi][tenbacsi]", "class" => "span10"]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][bacsi][date]", !empty($user[$index]["bacsi"]["date"]) ? $user[$index]["bacsi"]["date"]: "", ["id" => "tab[{$tab}][bacsi][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Bác sĩ form-->
		<div class="control-group">
			<label class="control-label-custom">1. Kết quả xét nghiệm nhanh HIV</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][fastHIVresultdate]", !empty($user[$index]["bacsi"]["fastHIVresultdate"]) ? $user[$index]["bacsi"]["fastHIVresultdate"] : "", ["id" => "tab[{$tab}][bacsi][fastHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
				{!! Form::text("tab[{$tab}][bacsi][fastHIVresult]", !empty($user[$index]["bacsi"]["fastHIVresult"]) ? $user[$index]["bacsi"]["fastHIVresult"] : "", ["id" => "tab[{$tab}][bacsi][fastHIVresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Kết quả xét nghiệm khẳng định HIV</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][confirmHIVresultdate]", !empty($user[$index]["bacsi"]["confirmHIVresultdate"]) ? $user[$index]["bacsi"]["confirmHIVresultdate"] : "", ["id" => "tab[{$tab}][bacsi][confirmHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
				{!! Form::text("tab[{$tab}][bacsi][confirmHIVresult]", !empty($user[$index]["bacsi"]["confirmHIVresult"]) ? $user[$index]["bacsi"]["confirmHIVresult"] : "", ["id" => "tab[{$tab}][bacsi][confirmHIVresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Chức năng thận (độ thanh thải creatinine > 60ml/min) (Các tháng 3,6,12)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][chucnangthanResultDate]", !empty($user[$index]["bacsi"]["chucnangthanResultDate"]) ? $user[$index]["bacsi"]["chucnangthanResultDate"] : "", ["id" => "tab[{$tab}][bacsi][chucnangthanResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
				{!! Form::text("tab[{$tab}][bacsi][chucnangthanResult]", !empty($user[$index]["bacsi"]["chucnangthanResult"]) ? $user[$index]["bacsi"]["chucnangthanResult"] : "", ["id" => "tab[{$tab}][bacsi][chucnangthanResult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Bạn có gặp phải các phản ứng phụ không? (Tham khảo phụ lục III)</label>
			<div class="controls-custom">
				{!! Form::text("tab[{$tab}][bacsi][hasSideEffects]", !empty($user[$index]["bacsi"]["hasSideEffects"]) ? $user[$index]["bacsi"]["hasSideEffects"] : "", ["id" => "tab[{$tab}][bacsi][hasSideEffects]"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Kết quả xét nghiệm Anti-HCV (Viêm gan C)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm (tháng thứ 12)</span>
				{!! Form::text("tab[{$tab}][bacsi][antiHCVresultdate]", !empty($user[$index]["bacsi"]["antiHCVresultdate"]) ? $user[$index]["bacsi"]["antiHCVresultdate"] : "", ["id" => "tab[{$tab}][bacsi][antiHCVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
				{!! Form::text("tab[{$tab}][bacsi][antiHCVresult]", !empty($user[$index]["bacsi"]["antiHCVresult"]) ? $user[$index]["bacsi"]["antiHCVresult"] : "", ["id" => "tab[{$tab}][bacsi][antiHCVresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">6. Kết quả xét nghiệm VDRL/RPR (syphilis)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm (tháng thứ 12)</span>
				{!! Form::text("tab[{$tab}][bacsi][VDRLRPRresultdate]", !empty($user[$index]["bacsi"]["VDRLRPRresultdate"]) ? $user[$index]["bacsi"]["VDRLRPRresultdate"] : "", ["id" => "tab[{$tab}][bacsi][VDRLRPRresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
				{!! Form::text("tab[{$tab}][bacsi][VDRLRPRresult]", !empty($user[$index]["bacsi"]["VDRLRPRresult"]) ? $user[$index]["bacsi"]["VDRLRPRresult"] : "", ["id" => "tab[{$tab}][bacsi][VDRLRPRresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">7. Nhiễm độc gan: Mức AST và ALT (tại các tháng 3,6,12)</label>
			<div class="controls-custom">
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[{$tab}][bacsi][poisonGanResultDate]", !empty($user[$index]["bacsi"]["poisonGanResultDate"]) ? $user[$index]["bacsi"]["poisonGanResultDate"] : "", ["id" => "tab[{$tab}][bacsi][poisonGanResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
				{!! Form::text("tab[{$tab}][bacsi][poisonGanResult]", !empty($user[$index]["bacsi"]["poisonGanResult"]) ? $user[$index]["bacsi"]["poisonGanResult"] : "", ["id" => "tab[{$tab}][bacsi][poisonGanResult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">8. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[{$tab}][bacsi][otherComment]", !empty($user[$index]["bacsi"]["otherComment"]) ? $user[$index]["bacsi"]["otherComment"] : "", ["id" => "tab[{$tab}][bacsi][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
			</div>
		</div>
	</div>
	<div class="form-actions">
		<input type="submit" value="Save" class="btn btn-success">
	</div>
</div>

<div class="widget-box">
	<div class="widget-title title-tuvanvien3"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien3][tentuvanvien]", !empty($user[$index]["tuvanvien3"]["tentuvanvien"]) ? $user[$index]["tuvanvien3"]["tentuvanvien"]: "", ["id" => "tab[{$tab}][tuvanvien3][tentuvanvien]", "class" => "span10"]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[{$tab}][tuvanvien3][date]", !empty($user[$index]["tuvanvien3"]["date"]) ? $user[$index]["tuvanvien3"]["date"]: "", ["id" => "tab[{$tab}][tuvanvien3][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Bệnh nhân nhiễm HIV+</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][hasHIV]", 1, (!empty($user[$index]["tuvanvien3"]["hasHIV"]) && $user[$index]["tuvanvien3"]["hasHIV"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien3_hasHIV"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][hasHIV]", 2, (!empty($user[$index]["tuvanvien3"]["hasHIV"]) && $user[$index]["tuvanvien3"]["hasHIV"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien3_hasHIV"]) !!}
					Không</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Nếu bệnh nhân không nhiễm HIV+, lý do tại sao bệnh nhân chấm dứt điều trị PrEP</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][otherReason]", 1, (!empty($user[$index]["tuvanvien3"]["otherReason"]) && $user[$index]["tuvanvien3"]["otherReason"] == 1) ? true : null, ["class" => "tab{$tab}_tuvanvien3_otherReason"]) !!}
					Tác dụng phụ của thuốc</label>
				<label>
					{!! Form::checkbox("tab[{$tab}][tuvanvien3][otherReason]", 2, (!empty($user[$index]["tuvanvien3"]["otherReason"]) && $user[$index]["tuvanvien3"]["otherReason"] == 2) ? true : null, ["class" => "tab{$tab}_tuvanvien3_otherReason"]) !!}
					Thay đổi nguy cơ</label>
				<label>
					Các lý do khác (Hãy mô tả chi tiết)
					{!! Form::text("tab[{$tab}][tuvanvien3][otherReasonText]", !empty($user[$index]["tuvanvien3"]["otherReasonText"]) ? $user[$index]["tuvanvien3"]["otherReasonText"]:"", ["id" => "tab{$tab}_tuvanvien3_otherReasonText", "class" => "span10"]) !!}
				</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Nếu do tác dụng phụ của thuốc, hãy nêu rõ mức độ nào (Xem phụ lục III)</label>
				{!! Form::text("tab[{$tab}][tuvanvien3][sideEffectLevel]", !empty($user[$index]["tuvanvien3"]["sideEffectLevel"]) ? $user[$index]["tuvanvien3"]["sideEffectLevel"]:"", ["id" => "tab[{$tab}][tuvanvien3][sideEffectLevel]", "class" => "span10"]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Nếu thay đổi nguy cơ, hãy nêu rõ nguy cơ nào và thay đổi thế nào</label>
				{!! Form::text("tab[{$tab}][tuvanvien3][dangerousChange]", !empty($user[$index]["tuvanvien3"]["dangerousChange"]) ? $user[$index]["tuvanvien3"]["dangerousChange"]:"", ["id" => "tab[{$tab}][tuvanvien3][dangerousChange]", "class" => "span10"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Nếu bệnh nhân nhiễm HIV+, hãy ghi ngày làm xét nghiệm định genotype HIV</label>
			<div class="controls-custom">
				{!! Form::text("tab[{$tab}][tuvanvien3][HIVdate]", !empty($user[$index]["tuvanvien3"]["HIVdate"]) ? $user[$index]["tuvanvien3"]["HIVdate"]: "", ["id" => "tab[{$tab}][tuvanvien3][HIVdate]", "class" => "datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Nếu bệnh nhân nhiễm HIV+, hãy ghi ngày thực hiện đo nồng độ tenofivir trong máu</label>
			<div class="controls-custom">
				{!! Form::text("tab[{$tab}][tuvanvien3][tenofivirDate]", !empty($user[$index]["tuvanvien3"]["tenofivirDate"]) ? $user[$index]["tuvanvien3"]["tenofivirDate"]: "", ["id" => "tab[{$tab}][tuvanvien3][tenofivirDate]", "class" => "datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[{$tab}][tuvanvien3][otherComment]", !empty($user[$index]["tuvanvien3"]["otherComment"]) ? $user[$index]["tuvanvien3"]["otherComment"] : "", ["id" => "tab[{$tab}][tuvanvien3][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
			</div>
		</div>
	</div>
</div>