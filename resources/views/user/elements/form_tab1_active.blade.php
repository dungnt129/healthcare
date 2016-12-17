<div class="widget-box">
	<div class="widget-title title-tuvanvien1"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien1][tentuvanvien]", $user[8]["tuvanvien1"]["tentuvanvien"], ["id" => "tab[1][tuvanvien1][tentuvanvien]", "class" => "span10"]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien1][date]", $user[8]["tuvanvien1"]["date"], ["id" => "tab[1][tuvanvien1][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Khách hàng đồng ý ký phiếu đồng ý tham gia trả lời một số câu hỏi riêng tư và đồng ý làm một số xét nghiệm sàng lọc để đánh giá tiêu chuẩn tham gia chương trình (Tư vấn viên giới thiệu
				mẫu phiếu đồng ý tham gia và hướng dẫn khách hàng đánh dấu ô CÓ)</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][accept]", 1, !empty($user[8]["tuvanvien1"]["accept"]) ? true : null) !!}
					Có</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Năm sinh</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][tuvanvien1][birthyear]", $user[8]["tuvanvien1"]["birthyear"], ["id" => "tab[1][tuvanvien1][birthyear]"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Giới tính</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][sex]", 1, (!empty($user[8]["tuvanvien1"]["sex"]) && $user[8]["tuvanvien1"]["sex"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_sex"]) !!}
					Nam</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][sex]", 2, (!empty($user[8]["tuvanvien1"]["sex"]) && $user[8]["tuvanvien1"]["sex"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_sex"]) !!}
					Chuyển giới</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Bạn có phải là người Việt Nam không?</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][isVietnamese]", 1, (!empty($user[8]["tuvanvien1"]["isVietnamese"]) && $user[8]["tuvanvien1"]["isVietnamese"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_isVietnamese"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][isVietnamese]", 2, (!empty($user[8]["tuvanvien1"]["isVietnamese"]) && $user[8]["tuvanvien1"]["isVietnamese"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_isVietnamese"]) !!}
					Không</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Bạn có bạn tình là người nhiễm HIV không?</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 1, (!empty($user[8]["tuvanvien1"]["hasHIVfriend"]) && $user[8]["tuvanvien1"]["hasHIVfriend"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 2, (!empty($user[8]["tuvanvien1"]["hasHIVfriend"]) && $user[8]["tuvanvien1"]["hasHIVfriend"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 3, (!empty($user[8]["tuvanvien1"]["hasHIVfriend"]) && $user[8]["tuvanvien1"]["hasHIVfriend"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend"]) !!}
					Không biết</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasHIVfriend]", 4, (!empty($user[8]["tuvanvien1"]["hasHIVfriend"]) && $user[8]["tuvanvien1"]["hasHIVfriend"] == 4) ? true : null, ["class" => "tab1_tuvanvien1_hasHIVfriend"]) !!}
					Không phù hợp</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">6. Bạn có nhận tiền hoặc hiện vật để đổi lấy quan hệ tình dục trong năm qua:</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasSexForCash]", 1, (!empty($user[8]["tuvanvien1"]["hasSexForCash"]) && $user[8]["tuvanvien1"]["hasSexForCash"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasSexForCash"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasSexForCash]", 2, (!empty($user[8]["tuvanvien1"]["hasSexForCash"]) && $user[8]["tuvanvien1"]["hasSexForCash"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasSexForCash"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasSexForCash]", 3, (!empty($user[8]["tuvanvien1"]["hasSexForCash"]) && $user[8]["tuvanvien1"]["hasSexForCash"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasSexForCash"]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">7. Bạn có mắc bệnh lây truyền qua đường tình dục trong năm qua không?</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Giang mai</label>
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasGiangMaiInLastYear]", 1, (!empty($user[8]["tuvanvien1"]["hasGiangMaiInLastYear"]) && $user[8]["tuvanvien1"]["hasGiangMaiInLastYear"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasGiangMaiInLastYear"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasGiangMaiInLastYear]", 2, (!empty($user[8]["tuvanvien1"]["hasGiangMaiInLastYear"]) && $user[8]["tuvanvien1"]["hasGiangMaiInLastYear"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasGiangMaiInLastYear"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasGiangMaiInLastYear]", 3, (!empty($user[8]["tuvanvien1"]["hasGiangMaiInLastYear"]) && $user[8]["tuvanvien1"]["hasGiangMaiInLastYear"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasGiangMaiInLastYear"]) !!}
					Không trả lời</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Lậu</label>
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasLauInLastYear]", 1, (!empty($user[8]["tuvanvien1"]["hasLauInLastYear"]) && $user[8]["tuvanvien1"]["hasLauInLastYear"] == 1) ? true : null, ["class" => "tab_1_tuvanvien1_hasLauInLastYear"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasLauInLastYear]", 2, (!empty($user[8]["tuvanvien1"]["hasLauInLastYear"]) && $user[8]["tuvanvien1"]["hasLauInLastYear"] == 2) ? true : null, ["class" => "tab_1_tuvanvien1_hasLauInLastYear"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasLauInLastYear]", 3, (!empty($user[8]["tuvanvien1"]["hasLauInLastYear"]) && $user[8]["tuvanvien1"]["hasLauInLastYear"] == 3) ? true : null, ["class" => "tab_1_tuvanvien1_hasLauInLastYear"]) !!}
					Không trả lời</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">c. Chlamydia</label>
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasChlamydiaInLastYear]", 1, (!empty($user[8]["tuvanvien1"]["hasChlamydiaInLastYear"]) && $user[8]["tuvanvien1"]["hasChlamydiaInLastYear"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasChlamydiaInLastYear"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasChlamydiaInLastYear]", 2, (!empty($user[8]["tuvanvien1"]["hasChlamydiaInLastYear"]) && $user[8]["tuvanvien1"]["hasChlamydiaInLastYear"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasChlamydiaInLastYear"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasChlamydiaInLastYear]", 3, (!empty($user[8]["tuvanvien1"]["hasChlamydiaInLastYear"]) && $user[8]["tuvanvien1"]["hasChlamydiaInLastYear"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasChlamydiaInLastYear"]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">8. Các hành vi nguy cơ:</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Câu hỏi 1: Bạn có quan hệ tình dục với bao nhiêu bạn tình nam trong vòng 3 tháng qua?</label>
                {!! Form::text("tab[1][tuvanvien1][howManySexFriends]", $user[8]["tuvanvien1"]["howManySexFriends"], ["id" => "tab1_tuvanvien1_howManySexFriends"]) !!}
			</div>
			<div class="controls-custom {{ empty($user[8]["tuvanvien1"]["howManySexFriends"]) ? "sub-question" : "" }}" id="question_tab1_tuvanvien1_howManyAssSexFriends">
				<label class="control-sublabel-custom">b. Câu hỏi 2 (nếu Q1 > 0): Trong số đó, bạn quan hệ tình dục đường hậu môn hay âm đạo giả với bao nhiêu người trong 3 tháng qua?</label>
                {!! Form::text("tab[1][tuvanvien1][howManyAssSexFriends]", $user[8]["tuvanvien1"]["howManyAssSexFriends"], ["id" => "tab1_tuvanvien1_howManyAssSexFriends"]) !!}
			</div>
			<div class="controls-custom {{ empty($user[8]["tuvanvien1"]["howManyAssSexFriends"]) ? "sub-question" : "" }}" id="question_tab1_tuvanvien1_hasCondomWhenAssSex">
				<label class="control-sublabel-custom">c. Câu hỏi 3 (nếu Q2 > 0): Bạn có sử dụng bao cao su trong lần quan hệ tình dục gần đây nhất qua đường hậu môn hay âm đạo giả với bạn tình nam không?</label>
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCondomWhenAssSex]", 1, (!empty($user[8]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[8]["tuvanvien1"]["hasCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasCondomWhenAssSex"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCondomWhenAssSex]", 2, (!empty($user[8]["tuvanvien1"]["hasCondomWhenAssSex"]) && $user[8]["tuvanvien1"]["hasCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasCondomWhenAssSex"]) !!}
					Không</label>
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">d. Bạn có thường xuyên sử dụng bao cao su khi quan hệ tình dục đường hậu môn hay âm đạo giả với bạn tình nam trong 3 tháng qua không?</label>
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 1, (!empty($user[8]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[8]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex"]) !!}
					Luôn luôn</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 2, (!empty($user[8]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[8]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex"]) !!}
					Thường xuyên</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasAlwaysUseCondomWhenAssSex]", 3, (!empty($user[8]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"]) && $user[8]["tuvanvien1"]["hasAlwaysUseCondomWhenAssSex"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasAlwaysUseCondomWhenAssSex"]) !!}
					Không bao giờ</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">9. Bạn có sử dụng ma túy tổng hợp (ma túy đá, Speed, Thuốc lắc) trong năm qua không:</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCocainInLastYear]", 1, (!empty($user[8]["tuvanvien1"]["hasCocainInLastYear"]) && $user[8]["tuvanvien1"]["hasCocainInLastYear"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasCocainInLastYear"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCocainInLastYear]", 2, (!empty($user[8]["tuvanvien1"]["hasCocainInLastYear"]) && $user[8]["tuvanvien1"]["hasCocainInLastYear"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasCocainInLastYear"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasCocainInLastYear]", 3, (!empty($user[8]["tuvanvien1"]["hasCocainInLastYear"]) && $user[8]["tuvanvien1"]["hasCocainInLastYear"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasCocainInLastYear"]) !!}
					Không trả lời</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">10. Bạn có sử dụng ma túy nào khác trong năm qua không?</label>
			<div class="controls-custom">
                {!! Form::text("tab[1][tuvanvien1][hasAnotherCocainLastYear]", $user[8]["tuvanvien1"]["hasAnotherCocainLastYear"], ["id" => "tab[1][tuvanvien1][hasAnotherCocainLastYear]"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">11. Bạn có sẵn sàng tự trả tiền thuốc PrEP sau 1 năm sử dụng không?</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasPaidForPrEP]", 1, (!empty($user[8]["tuvanvien1"]["hasPaidForPrEP"]) && $user[8]["tuvanvien1"]["hasPaidForPrEP"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_hasPaidForPrEP"]) !!}
					Có</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasPaidForPrEP]", 2, (!empty($user[8]["tuvanvien1"]["hasPaidForPrEP"]) && $user[8]["tuvanvien1"]["hasPaidForPrEP"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_hasPaidForPrEP"]) !!}
					Không</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][hasPaidForPrEP]", 3, (!empty($user[8]["tuvanvien1"]["hasPaidForPrEP"]) && $user[8]["tuvanvien1"]["hasPaidForPrEP"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_hasPaidForPrEP"]) !!}
					Không biết</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">12. Chúng tôi có thể liên lạc với bạn như thế nào?</label>
			<div class="controls-custom">
				<label class="control-sublabel-custom">a. Email:</label>
                {!! Form::text("tab[1][tuvanvien1][email]", $user[8]["tuvanvien1"]["email"], ["id" => "tab[1][tuvanvien1][email]"]) !!}
			</div>
			<div class="controls-custom">
				<label class="control-sublabel-custom">b. Số di động:</label>
                {!! Form::text("tab[1][tuvanvien1][mobile]", $user[8]["tuvanvien1"]["mobile"], ["id" => "tab[1][tuvanvien1][mobile]"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">13. Bạn nghe nói về PrEP qua kênh nào?</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien1][howDoYouKnowPrep]", 1, (!empty($user[8]["tuvanvien1"]["howDoYouKnowPrep"]) && $user[8]["tuvanvien1"]["howDoYouKnowPrep"] == 1) ? true : null, ["class" => "tab1_tuvanvien1_howDoYouKnowPrep"]) !!}
					Nhân viên xét nghiệm không chuyên</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][howDoYouKnowPrep]", 2, (!empty($user[8]["tuvanvien1"]["howDoYouKnowPrep"]) && $user[8]["tuvanvien1"]["howDoYouKnowPrep"] == 2) ? true : null, ["class" => "tab1_tuvanvien1_howDoYouKnowPrep"]) !!}
					Tự đến (có thông tin qua chiến dịch và website của CARMAH)</label>
				<label>
					{!! Form::checkbox("tab[1][tuvanvien1][howDoYouKnowPrep]", 3, (!empty($user[8]["tuvanvien1"]["howDoYouKnowPrep"]) && $user[8]["tuvanvien1"]["howDoYouKnowPrep"] == 3) ? true : null, ["class" => "tab1_tuvanvien1_howDoYouKnowPrep"]) !!}
					CBO giới thiệu đến</label>
				<label>
					Từ các kênh khác
					{!! Form::text("tab[1][tuvanvien1][howDoYouKnowPrepText]", $user[8]["tuvanvien1"]["howDoYouKnowPrepText"], ["id" => "tab1_tuvanvien1_howDoYouKnowPrepText"]) !!}
				</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">14. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[1][tuvanvien1][otherComment]", $user[8]["tuvanvien1"]["otherComment"], ["id" => "tab[1][tuvanvien1][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
			</div>
		</div>
	</div>
</div>

<div class="widget-box">
	<div class="widget-title title-bacsi"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tên bác sĩ</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][bacsi][tenbacsi]", $user[8]["bacsi"]["tenbacsi"], ["id" => "tab[1][bacsi][tenbacsi]", "class" => "span10"]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][bacsi][date]", $user[8]["bacsi"]["date"], ["id" => "tab[1][bacsi][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Bác sĩ form-->
		<div class="control-group">
			<label class="control-label-custom">1. Kết quả xét nghiệm nhanh HIV</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][fastHIVresult]", $user[8]["bacsi"]["fastHIVresult"], ["id" => "tab[1][bacsi][fastHIVresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][fastHIVresultdate]", $user[8]["bacsi"]["fastHIVresultdate"], ["id" => "tab[1][bacsi][fastHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Kết quả xét nghiệm khẳng định HIV</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][confirmHIVresult]", $user[8]["bacsi"]["confirmHIVresult"], ["id" => "tab[1][bacsi][confirmHIVresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][confirmHIVresultdate]", $user[8]["bacsi"]["confirmHIVresultdate"], ["id" => "tab[1][bacsi][confirmHIVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Kết quả xét nghiệm Viêm gan B & C</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][viemGanBresult]", $user[8]["bacsi"]["viemGanBresult"], ["id" => "tab[1][bacsi][viemGanBresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][viemGanBresultdate]", $user[8]["bacsi"]["viemGanBresultdate"], ["id" => "tab[1][bacsi][viemGanBresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">4. Kết quả xét nghiệm HBsAg (Sàng lọc viêm gan B)</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][sangLocViemGanBresult]", $user[8]["bacsi"]["sangLocViemGanBresult"], ["id" => "tab[1][bacsi][sangLocViemGanBresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][sangLocViemGanBresultdate]", $user[8]["bacsi"]["sangLocViemGanBresultdate"], ["id" => "tab[1][bacsi][sangLocViemGanBresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">5. Kết quả xét nghiệm anti-HBs (Kháng thể viêm gan B)</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][antiHBsresult]", $user[8]["bacsi"]["antiHBsresult"], ["id" => "tab[1][bacsi][antiHBsresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][antiHBsresultdate]", $user[8]["bacsi"]["antiHBsresultdate"], ["id" => "tab[1][bacsi][antiHBsresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">6. Kết quả xét nghiệm Anti-HCV (viêm gan C)</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][antiHCVresult]", $user[8]["bacsi"]["antiHCVresult"], ["id" => "tab[1][bacsi][antiHCVresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][antiHCVresultdate]", $user[8]["bacsi"]["antiHCVresultdate"], ["id" => "tab[1][bacsi][antiHCVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">7. Kết quả xét nghiệm Anti-HAV (viêm gan A)</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][antiHAVresult]", $user[8]["bacsi"]["antiHAVresult"], ["id" => "tab[1][bacsi][antiHAVresult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][antiHAVresultdate]", $user[8]["bacsi"]["antiHAVresultdate"], ["id" => "tab[1][bacsi][antiHAVresultdate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">8. Kết quả xét nghiệm VDRL/RPR (giang mai)</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][giangmaiResult]", $user[8]["bacsi"]["giangmaiResult"], ["id" => "tab[1][bacsi][giangmaiResult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][giangmaiResultDate]", $user[8]["bacsi"]["giangmaiResultDate"], ["id" => "tab[1][bacsi][giangmaiResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">9. Chức năng thận (độ thanh thải creatinine > 60ml/min)</label>
			<div class="controls-custom">
				{!! Form::text("tab[1][bacsi][chucnangthanResult]", $user[8]["bacsi"]["chucnangthanResult"], ["id" => "tab[1][bacsi][chucnangthanResult]", "class" => "span2 margin-right5", "placeholder" => "Kết quả"]) !!}
				<span>Ngày xét nghiệm</span>
				{!! Form::text("tab[1][bacsi][chucnangthanResultDate]", $user[8]["bacsi"]["chucnangthanResultDate"], ["id" => "tab[1][bacsi][chucnangthanResultDate]", "class" => "span2 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">10. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[1][bacsi][otherComment]", $user[8]["bacsi"]["otherComment"], ["id" => "tab[1][bacsi][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
			</div>
		</div>
	</div>
</div>

<div class="widget-box">
	<div class="widget-title title-tuvanvien3"> <span class="icon"><i class="icon-th"></i></span>
		<h5>Tư vấn viên</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien3][tentuvanvien]", $user[8]["tuvanvien3"]["tentuvanvien"], ["id" => "tab[1][tuvanvien3][tentuvanvien]", "class" => "span10"]) !!}
		</div>
		<h5>Ngày</h5>
		<div class="span3" style="margin: 3px 0px 0px;float: left;">
			{!! Form::text("tab[1][tuvanvien3][date]", $user[8]["tuvanvien3"]["date"], ["id" => "tab[1][tuvanvien3][date]", "class" => "span10 datepicker", "data-date-format" => "dd/mm/yyyy"]) !!}
		</div>
	</div>
	<div class="widget-content nopadding">
		<!--Tư vấn viên form-->
		<div class="control-group">
			<label class="control-label-custom">1. Bạn có đồng ý tham gia dự án PrEP không? (Tư vấn viên giới thiệu mẫu phiếu đồng ý tham gia và hướng dẫn khách hàng đánh dấu ô CÓ)</label>
			<div class="controls-custom">
                <label>
					{!! Form::checkbox("tab[1][tuvanvien3][accept_prep]", 1, (!empty($user[8]["tuvanvien3"]["accept_prep"]) && $user[8]["tuvanvien3"]["accept_prep"] == 1) ? true : null, ["class" => "tab1_tuvanvien3_accept_prep"]) !!}
					Có</label>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">2. Mã bệnh nhân (Tư vấn viên đưa cho khách hàng thẻ khách hàng và ghi lại số mã bệnh nhân)</label>
			<div class="controls-custom">
                {!! Form::text("tab[1][tuvanvien3][maBenhNhan]", $user[8]["tuvanvien3"]["maBenhNhan"], ["id" => "tab[1][tuvanvien3][maBenhNhan]"]) !!}
			</div>
		</div>
		<div class="control-group">
			<label class="control-label-custom">3. Các nhận xét khác</label>
			<div class="controls-custom">
				{!! Form::textarea ("tab[1][tuvanvien3][otherComment]", $user[8]["tuvanvien3"]["otherComment"], ["id" => "tab[1][tuvanvien3][otherComment]", "class" => "span6", "cols" => "5", "rows" => "5"]) !!}
			</div>
		</div>
	</div>
</div>